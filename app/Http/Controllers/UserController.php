<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;

use Str;
use Flash;
use Response;
use Hash;

class UserController extends AppBaseController
{
    /** @var $userRepository UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::whereIn("rol", [2,3,4])->get();
        //$users = $this->userRepository->all();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $input =  $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function invite(Request $request)
    {
        $hasPaid = Auth::user()->payments()
                         ->where('status','PAGADO')
                         ->orderBy('created_at', 'DESC')
                         ->first();

        //TODO make suscription per year, month, etc
        // $currentDate = Carbon::now()->parse('Y-m-s H:i:s');
        // if($currentDate->greaterThan($hasPaid['transact_code']))

        if(!$hasPaid){
            abort(403, 'No autorizado');
        }

        $user = $this->userRepository->find(Auth::user()->id);

        return view('users.invite')->with('user', $user);
    }

    public function link(Request $request)
    {

        $input =  $request->all();

        $exist = User::where("link", $input["link"])->first();
        if ($exist) {
            Flash::error('El codigo ('.$input["link"].') ya ha sido usado.');
        } else {
            $user = $this->userRepository->update($input, Auth::user()->id);
            if ($user) {
                Flash::success('Enlace de invitacion guardado correctamente.');
            }
        }

        return redirect(route('invite.user'));
    }

    public function confirmationEmail($token, Request $request)
    {

        $user = User::where("remember_token", $token)->get()->first();
        // dd($user->email_verified_at);
        if($user && !$user->email_verified_at){
            $data = [
                'email_verified_at' => Carbon::now()
            ];
            //dd($data);
            $user = $this->userRepository->update($data, $user->id);

            $data = [
                "email_send" => $user->email,
                "view" => "emails.welcome",
                "subject" => "AEIA EMPIEZA A INVERTIR [Bienvenido]",
            ];
            $MailCustom = MailCustom::to($data['email_send'])->queue(new SendMail($data));
        }

        return redirect(route('login'));
    }

    public function send_invitation(Request $request)
    {
        $emails = explode(',',$request->get('emails'));
        foreach($emails as $index => $email){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                unset($emails[$index]);
            }
        }
        if(empty($emails)){
            Flash::error('No se encontraron emails validos');
            return redirect(route('invite.user'));
        }
        $data = [
            'email_verified_at' => Carbon::now()
        ];
        $profile = Profile::where('user_id',Auth::user()->id)->first();
        $data = [
            "view" => "emails.invitation",
            "subject" => "AEIA EMPIEZA A INVERTIR [Invitación]",
            "name" => $profile->first_name.' '.$profile->lastname, 
            "rol" =>  (Auth::user()->rol==2?'suscriptor':'cliente'),
            "link" => Auth::user()->link
        ];
        $MailCustom = MailCustom::to($emails)->queue(new SendMail($data));
        Flash::success(count($emails).' Correos de invitación enviados.');
        return redirect(route('invite.user'));
    }
    public function generateInviteLink()
{
    $user = Auth::user();
    $uniqueCode = $user->unique_code;

    if (!$uniqueCode) {
        // Generar un unique_code si el usuario no tiene uno
        $uniqueCode = Str::random(10); // o cualquier otra lógica para generar el código
        $user->unique_code = $uniqueCode;
        $user->save();
    }
	$inviteLink=route('register',['refered_code'=>$uniqueCode]);
    return view('users.invite', ['inviteLink'=>$inviteLink]);
}
}
