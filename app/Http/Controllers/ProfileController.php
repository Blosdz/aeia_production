<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\ProfileRepository;
use App\Models\Profile;
use App\Models\User;
use App\Models\Notification;
use App\Models\RejectionHistory;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Session;
use PDF;
use Illuminate\Support\Facades\Auth;
use Monarobase\CountryList\CountryListFacade;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Traits\MakeFile;
use App\Traits\BellTrait;
use App\Models\Document;

class ProfileController extends AppBaseController
{
    /** @var  ProfileRepository */
    private $profileRepository;
    use MakeFile;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the Profile.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $profiles = Profile::orderBy('verified')
                  ->filterByNameOrLastName($request['name'])
                  ->filterByStatus($request['status'])
                  ->get();

        return view('profiles.index')
            ->with('profiles', $profiles);
    }

    public function indexSubscribers(Request $request)
    {
        $profiles = Profile::orderBy('verified')
                  ->filterByNameOrLastName($request['name'])
                  ->filterByStatus($request['status'])
                  ->whereHas('user', function($query) {
                      $query->where('rol', 2);
                  })
                  ->get();

        return view('profiles.index')
            ->with(compact('profiles'));
    }
    public function verified()
    {
        return view('profiles.verified');
    }
    /**
     * Show the form for creating a new Profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created Profile in storage.
     *
     * @param CreateProfileRequest $request
     *
     * @return Response
     */
    public function store(CreateProfileRequest $request)
    {
        $input = $request->all();

        $profile = $this->profileRepository->create($input);

        Flash::success('Profile saved successfully.');

        return redirect(route('profiles.index'));
    }

    /**
     * Display the specified Profile.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified Profile.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //$profile = $this->profileRepository->find($id);
        $profile = Profile::where('id', $id)->with('user')->first();
        
        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified Profile in storage.
     *
     * @param int $id
     * @param UpdateProfileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfileRequest $request)
    {
        $profile = $this->profileRepository->find($id);
        //dd($profile);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $data = $request->all();
        //dd($data);

        if(!$data["obs"] && $request['verified'] == 3){
            Flash::error("Tiene que ingresar observacion.");
            return redirect()->back();
        }

        $profile = $this->profileRepository->update($request->all(), $id);
        $user = User::where("id", $profile->user_id);
        if ($profile->verified == 2) {
            $user->update(['validated' => 1]);
            $notification = Notification::create([
                'title' => "Validación de información",
                'body' => "Su informacion ha sido validado Correctamente",
                'user_id' => $profile->user_id,
            ]);
            BellTrait::verifyNotification($profile->user_id, 'notification', true);
        } else {

            if ($profile->verified == 3) {
                $notification = Notification::create([
                    'title' => "Validación de información",
                    'body' => $data["obs"],
                    'user_id' => $profile->user_id,
                ]);
                RejectionHistory::create([
                    'user_id'   => $profile->user_id,
                    'comment'   => $data["obs"],
                    'date'      => Carbon::now()
                ]);
                BellTrait::verifyNotification($profile->user_id, 'notification', true);
            }
            $user->update(['validated' => 0]);

        }
        //dd($user);

		$filePath = 'pdfs/';
	
	    // Almacenar el archivo PDF si está presente en la solicitud
	    if ($request->hasFile('pdf_file')) {
	        // Generar un nombre único para el archivo PDF
	        $name = uniqid().'.'.$request->file('pdf_file')->getClientOriginalExtension();
	        // Ruta completa donde se guardará el archivo PDF
	        $path = $filePath.$name;

	        // Almacenar el archivo PDF
	        $request->file('pdf_file')->storeAs('public/'.$filePath, $name);
	        $pdfFile = Document::create(['user_name' => $profile ->id, 'filename'=>uniqid(),'document_type' => 'kyc', 'file_path' => '/storage/'.$path]);
	        // Devolver una respuesta JSON con la URL del archivo y un mensaje de éxito
	
        	Flash::success('Verificacion de informacion guardado correctamente.');

	        return redirect(route('profiles.index'));
	    } else {
	        // Si no se encuentra ningún archivo PDF en la solicitud, devolver un mensaje de error
		    //
        	Flash::success('Verificacion de informacion guardado correctamente.');
	        return redirect(route('profiles.index'))->withErrors(['pdf_file' => 'No se ha proporcionado ningún archivo para cargar.']);
    		}


    }

    /**
     * Remove the specified Profile from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = $this->profileRepository->find($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success('Profile deleted successfully.');

        return redirect(route('profiles.index'));
    }

    public function edit2()
    {
        	//$profile = $this->profileRepository->find($id);
        $profile = Profile::where("user_id", Auth::user()->id)->first();

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }
		
        return view('profiles.edit2')->with('profile', $profile);
    }

    public function update2($id, UpdateProfileRequest $request)
    {
    // Obtener el user_id del formulario
    	
            $userId = $request->input('user_id');
            $profile = $this->profileRepository->find($id);
	    $data=$request->all();
	    $profile->verified = 1; // Otra forma de actualizar el campo "verified" del perfil	
	    $profile=$this->profileRepository->update($data,$id);
		
//	    return redirect()->route('show-form-pdf');
	    return redirect(route('profiles.user'));
    }

    public function upload_file(Request $request){

        $profile = Profile::where("user_id", Auth::user()->id)->first();

        $file_fields;
        $file_fields[0] = "dni";
        $file_fields[1] = "dni_r"; 
        $file_fields[2] = "profile_picture"; 
        $file_fields[3] = "dni2";
        $file_fields[4] = "dni2_r"; 
        $file_fields[5] = "profile_picture2"; 
        $file_fields[6] = "dni3";
        $file_fields[7] = "dni3_r"; 
        $file_fields[8] = "profile_picture3"; 

        $file_fields[9] = "business_file"; 
        $file_fields[10] = "power_file"; 
        $file_fields[11] = "taxes_file"; 

        $path;
        $name;

        for ( $i = 0; $i < sizeof($file_fields); $i++)
        {
            if ($request->hasFile($file_fields[$i])) {
                $filePath = 'profile/';

                if (!file_exists(storage_path($filePath))) {
                    Storage::makeDirectory('public/'.$filePath, 0777, true);
                }
                $name = uniqid().'.'.$request->file($file_fields[$i])->getClientOriginalExtension();
                $path = $filePath.$name;

                if (is_file(storage_path('/app/public/'.$profile[$file_fields[$i]]))){   
                   unlink(storage_path('/app/public/'.$profile[$file_fields[$i]]));
                }
                $request->file($file_fields[$i])->storeAs('public/'.$filePath, $name);
                $profile->update([$file_fields[$i] => $path]);
            }
        }
        return response()->json(
        [
            'url'=> url('/storage/'.$path),
            'message'=> $name.' subido',
            'file_name'=> $name
        ], 200);
    }
}
