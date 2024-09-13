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
        
        // if($contract->type == 1)
        // //Contrato de administracion de capital_suscriptor
        // {
        //     PDF::SetMargins(10,20,10);
        //     PDF::SetTitle("Contrato de licencia de suscriptor - ".$contract->code);
            
        //     PDF::setPrintHeader(false);
        //     PDF::AddPage();

        //     $style= '
        //     <style>
        //         table, th, td {
        //             border: 0px solid;
        //         }
        //         p,
        //         td {
        //             text-align: justify;
        //         }
        //     </style>
        //     ';

        //     $title = $style.'
        //         <div style="width:100%; text-align:center"> <u><b> CONTRATO DE LICENCIA DE SUSCRIPTOR </b></u></div>
        //     ';

        //     PDF::writeHtml($title,true,false,true,false,'');

        //     PDF::setY(30);

        //     $body = '
        //         <p>Conste por el presente Contrato para Administración de Capital, que celebran de una parte 
        //         <b>AEIA INVESTMENT E.I.R.L.</b> identificado con RUC Nº 20608381741, a quien en adelante se le denominará <b>LA EMPRESA</b>; y de otra parte el Sr(a)'.
        //         $contract->full_name.', con DNI '.$contract->identification_number.', con domicilio fiscal '.$contract->address.
        //         ', '.$contract->state.', '.$contract->city.', '.$contract->country.', a quien en lo sucesivo se le denominará 
        //         <b>EL SUSCRIPTOR</b>. El presente contrato, se celebra en los términos y condiciones siguientes:</p>
        //     ';
        //     PDF::writeHtml($body,true,false,true,false,'');

        //     $first = '
        //         <br><p><u><b>PRIMERA: ANTECEDENTES</b></u></p><br>
        //     ';
        //     PDF::writeHtml($first,true,false,true,false,'');

        //     $first_body = '
        //         <table>
        //         <tr>
        //             <td width="5%">1.1</td>
        //             <td width="95%">
        //                 <b>EL SUSCRIPTOR</b> es una persona natural, que desea ser intermediario para vincular, uno o más clientes interesados en los servicios de
        //                 <b>LA EMPRESA</b>. Así mismo, <b>EL SUSCRIPTOR</b> puede actuar en representación de un máximo de tres (03) personas, empero, sólo se
        //                 considerará a uno de ellos como el representante de los mismos, siendo este, el único <b>EL SUSCRIPTOR</b>; asimismo, las obligaciones emanadas
        //                 del presente contrato sólo alcanzarán al representante.
        //             </td>
        //         </tr>
        //         <tr>
        //             <td>1.2</td>
        //             <td>
        //                 <b>LA EMPRESA</b> es una persona jurídica de derecho privado constituido bajo el régimen de empresa individual de responsabilidad limitada, el mismo
        //                 que brinda un servicio de administración de capitales en el mercado de activos digitales y criptomonedas.
        //             </td>
        //         </tr>
        //         </table>
        //     ';

        //     PDF::writeHtml($first_body,true,false,true,false,'');

        //     $second = '
        //         <br><p><u><b>SEGUNDA: OBJETO DEL CONTRATO</b></u></p></br>
        //     ';

        //     PDF::writeHtml($second,true,false,true,false,'');

        //     $second_body = '
        //         <table>
        //         <tr>
        //             <td width="5%">2.1</td>
        //             <td width="95%">
        //                 El objeto del presente contrato es establecer los términos y condiciones para mediación de intermediario que desempeñará <b>EL SUSCRIPTOR</b> en la 
        //                 capacitación de clientes interesados en los servicios de <b>LA EMPRESA.</b>
        //             </td>
        //         </tr>
        //         </table>
        //     ';

        //     PDF::writeHtml($second_body,true,false,true,false,'');

        //     $third = '
        //         <br><p><u><b>TERCERA: FUNCIONES DEL SUSCRIPTOR</b></u></p></br>
        //     ';

        //     PDF::writeHtml($third,true,false,true,false,'');

        //     $third_body = '
        //         <table>
        //         <tr>
        //             <td width="5%">3.1</td>
        //             <td width="95%">
        //                 La intervención del <b>SUSCRIPTOR</b> comprenderá, entre otras, las siguientes actuaciones:
        //                 <ul>
        //                     <li>Obtener clientes que interesados en el servicio que brinda <b>LA EMPRESA.</b></li>
        //                     <li>Contar un panel de control en el sistema de <b>LA EMPRESA</b>, que le permita verificar y recopilar las inversiones de los clientes captados.</li>
        //                     <li>Registrar a los clientes interesados en la plataforma de <b>LA EMPRESA,</b> bajo el código de licencia único del <b>SUSCRIPTOR.</b></li>
        //                     <li>Recibir comisiones sobre la rentabilidad generada por sus clientes.</li>
        //                     <li>Informar a los clientes del servicio que ofrece <b>LA EMPRESA.</b></li>
        //                 </ul>
        //             </td>
        //         </tr>
        //         </table>
        //     ';

        //     PDF::writeHtml($third_body,true,false,true,false,'');

        //     $_body = '
        //         <table>
        //         <tr>
        //             <td width="5%">2.1</td>
        //             <td width="95%">
        //             </td>
        //         </tr>
        //         </table>
        //     ';

        //     PDF::Output("Contrato de administracion de capital-".$contract->code.".pdf");
        //     return redirect(route('contracts.index'));

        // } else 
        if ($contract->type == 2){

        //Contrato de administracion de capital_cliente
            $user = Auth::user();
            $profile = User::where('id', $contract->user_id)->first(); // Obtener el perfil del usuario relacionado con el contrato
        
            // Obtener la fecha de creación del contrato
            $timestamp = Carbon::parse($contract->created_at);


            $months = [
                0 => 'Enero',
                1 => 'Febrero',
                2 => 'Marzo',
                3 => 'Abril',
                4 => 'Mayo',
                5 => 'Junio',
                6 => 'Julio',
                7 => 'Agosto',
                8 => 'Setiembre',
                9 => 'Octubre',
                10 => 'Noviembre',
                11 => 'Diciembre'
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

    }

    public function declaracion($id){
        $declaracion=$this->declaracionesRepository->find($id);
        $user=Auth::user(); 
        $profile =Profile::where('id',$declaracion->user_id)->first();
        $months = [
            0 => 'Enero',
            1 => 'Febrero',
            2 => 'Marzo',
            3 => 'Abril',
            4 => 'Mayo',
            5 => 'Junio',
            6 => 'Julio',
            7 => 'Agosto',
            8 => 'Setiembre',
            9 => 'Octubre',
            10 => 'Noviembre',
            11 => 'Diciembre'
        ];
        $profile=Profile::where('id',$declaracion->user_id)->first();
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

        return $pdf->stream('documentos_new.declaracionVoluntaria');
    }
}
