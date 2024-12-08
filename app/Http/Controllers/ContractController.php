<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Repositories\ContractRepository;
use App\Repositories\DeclaracionesRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Flash;
use Response;
// use PDF;

use Carbon\Carbon;

use dd;
class ContractController extends AppBaseController
{
    /** @var  ContractRepository */
    private $contractRepository;

    public function __construct(ContractRepository $contractRepo, DeclaracionesRepository $declaracionesRepo)
    {
        $this->contractRepository = $contractRepo;
        $this->declaracionesRepository = $declaracionesRepo;
    }

    /**
     * Display a listing of the Contract.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //$contracts = $this->contractRepository->all();
        $contracts = Contract::where('user_id',auth()->user()->id)->get();
        return view('contracts_new.index')
            ->with('contracts', $contracts);
    }

    /**
     * Show the form for creating a new Contract.
     *
     * @return Response
     */
    public function create()
    {
        return view('contracts_new.create');
    }

    /**
     * Store a newly created Contract in storage.
     *
     * @param CreateContractRequest $request
     *
     * @return Response
     */
    public function store(CreateContractRequest $request)
    {
        $input = $request->all();

        $contract = $this->contractRepository->create($input);

        Flash::success('Contract saved successfully.');

        return redirect(route('contracts_new.index'));
    }

    /**
     * Display the specified Contract.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contract = $this->contractRepository->find($id);

        dd($contract);
        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        return view('contracts_new.show')->with('contract', $contract);
    }

    /**
     * Show the form for editing the specified Contract.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        return view('contracts_new.edit')->with('contract', $contract);
    }

    /**
     * Update the specified Contract in storage.
     *
     * @param int $id
     * @param UpdateContractRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContractRequest $request)
    {
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        $contract = $this->contractRepository->update($request->all(), $id);

        Flash::success('Contract updated successfully.');

        return redirect(route('contracts_new.index'));
    }

    /**
     * Remove the specified Contract from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contract = $this->contractRepository->find($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        $this->contractRepository->delete($id);

        Flash::success('Contract deleted successfully.');

        return redirect(route('contracts.index'));
    }

    public function contract_pdf($id)
    {
        $contract = $this->contractRepository->find($id);
        

            $user = Auth::user();
            $profile = Profile::where('user_id', $contract->user_id)->first(); // Obtener el perfil del usuario relacionado con el contrato
        
            // Obtener la fecha de creación del contrato
            $timestamp = Carbon::parse($contract->created_at);


            $months = [
                1 => 'Enero',
                2 => 'Febrero',
                3 => 'Marzo',
                4 => 'Abril',
                5 => 'Mayo',
                6 => 'Junio',
                7 => 'Julio',
                8 => 'Agosto',
                9 => 'Setiembre',
                10 => 'Octubre',
                11 => 'Noviembre',
                12 => 'Diciembre'
            ];
            // Crear un PDF con los datos necesarios
            $pdf = Pdf::loadView('documentos_new.contrato', [
                'profile' => $profile,
                'code' => $contract->code,
                'payment_id' => $contract->payment_id,
                'timestamp' => $timestamp,
                'contract' => $contract,
                'months'=>$months
            ]);

            // Retornar el PDF para visualizarlo en el navegador
            return $pdf->stream('documentos_new.contrato');

    }

    public function declaracion($id){
        $declaracion=$this->declaracionesRepository->find($id);
        $user=Auth::user(); 
        $profile =Profile::where('id',$declaracion->user_id)->first();
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Setiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $profile=Profile::where('user_id',$declaracion->user_id)->first();
        $timestamp=Carbon::parse($declaracion->created_at);
        $pdf=Pdf::loadView('documentos_new.declaracionVoluntaria',[
            'profile' => $profile,
            'user'=>$user,
            'code' => $declaracion->code,
            'payment_id' => $declaracion->payment_id,
            'timestamp' => $timestamp,
            'declaracion' => $declaracion,
            'months'=>$months
        ]);
        // dd($pdf);

        return $pdf->stream('documentos_new.declaracionVoluntaria');
    }
}
