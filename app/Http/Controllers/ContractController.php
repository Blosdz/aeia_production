<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Repositories\ContractRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Contract;
use Flash;
use Response;
use PDF;

class ContractController extends AppBaseController
{
    /** @var  ContractRepository */
    private $contractRepository;

    public function __construct(ContractRepository $contractRepo)
    {
        $this->contractRepository = $contractRepo;
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
        return view('contracts.index')
            ->with('contracts', $contracts);
    }

    /**
     * Show the form for creating a new Contract.
     *
     * @return Response
     */
    public function create()
    {
        return view('contracts.create');
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

        return redirect(route('contracts.index'));
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

        return view('contracts.show')->with('contract', $contract);
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

        return view('contracts.edit')->with('contract', $contract);
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

        return redirect(route('contracts.index'));
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
        
        if($contract->type == 1)
        //Contrato de administracion de capital_suscriptor
        {
            PDF::SetMargins(10,20,10);
            PDF::SetTitle("Contrato de licencia de suscriptor - ".$contract->code);
            
            PDF::setPrintHeader(false);
            PDF::AddPage();

            $style= '
            <style>
                table, th, td {
                    border: 0px solid;
                }
            </style>
            ';

            $title = $style.'
                <div style="width:100%; text-align:center"> <u><b> CONTRATO DE LICENCIA DE SUSCRIPTOR </b></u></div>
            ';

            PDF::writeHtml($title,true,false,true,false,'');

            PDF::setY(30);

            $body = '
                <p>Conste por el presente Contrato para Administración de Capital, que celebran de una parte 
                <b>AEIA INVESTMENT E.I.R.L.</b> identificado con RUC Nº 20608381741, debidamente representado por 
                DIEGO ELI BUTRON NUÑEZ, identificado con DNI N° 71400723, con domicilio en Urb. El solar de 
                Challapampa A-25´ distrito de Cerro Colorado, provincia y departamento de 
                Arequipa país Perú, a quien en adelante se le denominará <b>LA EMPRESA</b>; y de otra parte el Sr(a)'.
                $contract->full_name.', con DNI '.$contract->identification_number.', con domicilio fiscal '.$contract->address.
                ', '.$contract->state.', '.$contract->city.', '.$contract->country.', a quien en lo sucesivo se le denominará 
                <b>EL SUSCRIPTOR</b>. El presente contrato, se celebra en los términos y condiciones siguientes:</p>
            ';
            PDF::writeHtml($body,true,false,true,false,'');

            $first = '
                <br><p><u><b>PRIMERA: ANTECEDENTES</b></u></p><br>
            ';
            PDF::writeHtml($first,true,false,true,false,'');

            $first_body = '
                <table>
                <tr>
                    <td width="5%">1.1</td>
                    <td width="95%">
                        <b>EL SUSCRIPTOR</b> es una persona natural, que desea ser intermediario para vincular, uno o más clientes interesados en los servicios de
                        <b>LA EMPRESA</b>. Así mismo, <b>EL SUSCRIPTOR</b> puede actuar en representación de un máximo de tres (03) personas, empero, sólo se
                        considerará a uno de ellos como el representante de los mismos, siendo este, el único <b>EL SUSCRIPTOR</b>; asimismo, las obligaciones emanadas
                        del presente contrato sólo alcanzarán al representante.
                    </td>
                </tr>
                <tr>
                    <td>1.2</td>
                    <td>
                        <b>LA EMPRESA</b> es una persona jurídica de derecho privado constituido bajo el régimen de empresa individual de responsabilidad limitada, el mismo
                        que brinda un servicio de administración de capitales en el mercado de activos digitales y criptomonedas.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($first_body,true,false,true,false,'');

            $second = '
                <br><p><u><b>SEGUNDA: OBJETO DEL CONTRATO</b></u></p></br>
            ';

            PDF::writeHtml($second,true,false,true,false,'');

            $second_body = '
                <table>
                <tr>
                    <td width="5%">2.1</td>
                    <td width="95%">
                        El objeto del presente contrato es establecer los términos y condiciones para mediación de intermediario que desempeñará <b>EL SUSCRIPTOR</b> en la 
                        capacitación de clientes interesados en los servicios de <b>LA EMPRESA.</b>
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($second_body,true,false,true,false,'');

            $third = '
                <br><p><u><b>TERCERA: FUNCIONES DEL SUSCRIPTOR</b></u></p></br>
            ';

            PDF::writeHtml($third,true,false,true,false,'');

            $third_body = '
                <table>
                <tr>
                    <td width="5%">3.1</td>
                    <td width="95%">
                        La intervención del <b>SUSCRIPTOR</b> comprenderá, entre otras, las siguientes actuaciones:
                        <ul>
                            <li>Obtener clientes que interesados en el servicio que brinda <b>LA EMPRESA.</b></li>
                            <li>Contar un panel de control en el sistema de <b>LA EMPRESA</b>, que le permita verificar y recopilar las inversiones de los clientes captados.</li>
                            <li>Registrar a los clientes interesados en la plataforma de <b>LA EMPRESA,</b> bajo el código de licencia único del <b>SUSCRIPTOR.</b></li>
                            <li>Recibir comisiones sobre la rentabilidad generada por sus clientes.</li>
                            <li>Informar a los clientes del servicio que ofrece <b>LA EMPRESA.</b></li>
                        </ul>
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($third_body,true,false,true,false,'');

            $_body = '
                <table>
                <tr>
                    <td width="5%">2.1</td>
                    <td width="95%">
                    </td>
                </tr>
                </table>
            ';

            PDF::Output("Contrato de administracion de capital-".$contract->code.".pdf");
            return redirect(route('contracts.index'));

        } else if ($contract->type == 2)
        //Contrato de administracion de capital_cliente
        {
            PDF::SetMargins(10,20,10);
            PDF::SetTitle("Contrato de administración de capital - ".$contract->code);
            
            PDF::setPrintHeader(false);
            PDF::AddPage();

            $style= '
            <style>
                table, th, td {
                    border: 0px solid;
                }
            </style>
            ';

            $title = $style.'
                <div style="width:100%; text-align:center"> <u><b> CONTRATO DE ADMINISTRACIÓN DE CAPITAL </b></u></div>
            ';

            PDF::writeHtml($title,true,false,true,false,'');

            PDF::setY(30);

            $body = '
                <p>Conste por el presente Contrato para Administración de Capital, que celebran de una parte 
                <b>AEIA INVESTMENT E.I.R.L.</b> identificado con RUC Nº 20608381741, debidamente representado por su 
                Gerente General Sr. DIEGO ELI BUTRON NUÑEZ, identificado con DNI N° 71400723, con domicilio 
                en Urb. El solar de Challapampa A-25´ distrito de Cerro Colorado, provincia y departamento de 
                Arequipa país Perú, a quien en adelante se le denominará <b>EL COMISIONISTA</b>; y de otra parte '.
                $contract->full_name.', de nacionalidad '.$contract->country_document.' identificado con documento de identidad Nº '.
                $contract->identification_number.', domiciliado en '.$contract->address.', '.$contract->state.', '.$contract->city.', '.$contract->country.' 
                a quien en lo sucesivo se le denominará <b>EL MANDANTE</b>. El presente contrato, se celebra en los términos y condiciones siguientes:</p>
            ';
            PDF::writeHtml($body,true,false,true,false,'');

            $first = '
                <br><p><u><b>PRIMERA: ANTECEDENTES</b></u></p><br>
            ';
            PDF::writeHtml($first,true,false,true,false,'');

            $first_body = '
                <table>
                <tr>
                    <td width="5%">1.1</td>
                    <td width="95%">
                        <b>EL MANDANTE</b> es una persona natural, que desea invertir su capital en criptodivisas y requiere de alguien que las administre.
                    </td>
                </tr>
                <tr>
                    <td>1.2</td>
                    <td>
                        <b>EL COMISIONISTA</b> es una persona jurídica de derecho privado constituido bajo el régimen de empresa individual de responsabilidad 
                        limitada, dedicada a crear un ecosistema digital de integración de servicios financieros, con el objetivo de generar varios fondos de inversión
                        colectivos para hacer trading de alta frecuencia en el mercado de activos digitales y criptomonedas a través del soporte de robots de inteligencia 
                        artificial y equipo profesional de traders.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($first_body,true,false,true,false,'');

            $second = '
                <br><p><u><b>SEGUNDA: OBJETO DEL CONTRATO</b></u></p><br>
            ';
            PDF::writeHtml($second,true,false,true,false,'');

            $second_body = '
                <table>
                <tr>
                    <td width="5%">2.1</td>
                    <td width="95%">
                        El objeto del presente contrato es prestar el servicio de administración del capital de <b>EL MANDANTE</b> 
                        en el mercado de activos digitales y criptomonedas (en adelante el mercado), a cambio de la contraprestación 
                        que aparece en la cláusula décimo primera del presente instrumento.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($second_body,true,false,true,false,'');

            $third = '
                <br><p><u><b>TERCERA: DECLARACIONES DEL MANDANTE</b></u></p><br>
            ';
            PDF::writeHtml($third,true,false,true,false,'');

            $third_body = '
                <table>
                <tr>
                    <td width="5%">3.1</td>
                    <td width="95%">
                        Tener capacidad de goce y ejercicio de su capital para ser invertido en criptomonedas y en los mercados de activos digitales, 
                        asimismo declara haber sido instruido por <b>EL COMISIONISTA</b> sobre las condiciones y alcances de su inversión.
                    </td>
                </tr>
                <tr>
                    <td width="5%">3.2</td>
                    <td width="95%">
                        Que ha sido debidamente informado por EL <b>COMISIONISTA</b>, de los aspectos relevantes de las criptomonedas tales como la política 
                        de inversiones de éstos, los factores que signifiquen riesgo para las expectativas de inversión de <b>EL MANDANTE</b>.
                    </td>
                </tr>
                <tr>
                    <td width="5%">3.3</td>
                    <td width="95%">
                        Que asume los riesgos de invertir en la adquisición de criptomonedas, liberando a <b>EL COMISIONISTA</b> (incluyendo a los funcionarios y 
                        empleados) de toda responsabilidad.
                    </td>
                </tr>
                <tr>
                    <td width="5%">3.4</td>
                    <td width="95%">
                        Que la información remitida a <b>EL COMISIONISTA</b> usando medios electrónicos (para efectos de este contrato se consideran las siguientes 
                        herramientas: correo electrónico, página web y otros) constituyen mecanismos válidos a efectos de generar derechos y obligaciones para 
                        <b>EL COMISIONISTA</b> y <b>EL MANDANTE</b>, asumiendo los riesgos derivados del empleo de estos medios.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($third_body,true,false,true,false,'');

            $fourth = '
                <br><p><u><b>CUARTA: FACULTADES DEL COMISIONISTA</b></u></p><br>
            ';
            PDF::writeHtml($fourth,true,false,true,false,'');

            $fourth_body = '
                <table>
                <tr>
                    <td width="5%">4.1</td>
                    <td width="95%">
                        En desarrollo del presente contrato, <b>EL COMISIONISTA</b> tendrá las siguientes facultades:
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <ul>
                            <li> Invertir y administrar el capital de <b>EL MANDANTE</b> en el mercado de activos digitales y criptodivisas, para lo cual podrá realizar 
                            todas las transacciones que le sean permitidas en el mercado.</li>
                            <li> Realizar en nombre de <b>EL MANDANTE</b> el cobro de los rendimientos o de dividendos del capital que se genere en el mercado.</li>
                            <li> Redimir el capital y sus ganancias al momento del vencimiento del contrato, siempre que no existan pérdidas.</li>
                            <li> Valorar, a través de robots con inteligencia artificial y equipo de traders profesionales, los precios de mercado para el trading de criptodivisas.</li>
                            <li> <b>EL COMISIONISTA</b> deberá emitir un informe mensual en cuanto a las ganancias y pérdidas registradas en la cuenta respecto del capital cedido en 
                            administración.</li>
                        </ul>
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($fourth_body,true,false,true,false,'');

            $fifth = '
                <br><p><u><b>QUINTA: OBLIGACIONES y FACULTADES DEL MANDANTE</b></u></p><br>
            ';
            PDF::writeHtml($fifth,true,false,true,false,'');

            $fifth_body = '
                <table>
                <tr>
                    <td width="5%">5.1</td>
                    <td width="95%">
                        En desarrollo del presente contrato, <b>EL MANDANTE</b> tendrá las siguientes facultades:
                    </td>
                </tr>
                <tr>
                    <td width="5%"></td>
                    <td width="95%">
                        <ol type="a">
                            <li> Contar con un usuario y contraseña personal que le permita consultar el estado de su inversión.</li>
                            <li> Realizar depósitos de inversión.</li>
                            <li> Realizar consultas diarias de las operaciones de inversión realizada. </li>
                            <li> Retirar su inversión según el plan de inversión elegido, siempre que no se registren pérdidas.</li>
                            <li> Cobrar las ganancias de la inversión al término del contrato.</li>
                            <li> Participar de cursos, charlas ponencias y capacitaciones ofrecidas por el <b>EL COMISIONISTA</b>. </li>
                            <li> No solicitar la devolución total o en parte del capital cedido, sino hasta el término del contrato. </li>
                            <li> <b>EL MANDANTE</b> no podrá cambiar de plan durante la vigencia del presente contrato, debiendo elegir cualquiera de los planes señalados en la cláusula 
                            séptima, en el supuesto de invertir un capital adicional. En caso desee invertir un capital adicional, puede invertir en otro plan diferente al inicial. </li>
                            <li> <ol type="a">
                                <li> Realizar el pago anual de la membresía, según el plan elegido, dentro del plazo establecido.</li>
                                <li> Asumir, previa coordinación y aviso, costos externos que se generen de los bancos, billeteras digitales, comisiones, etc.</li>
                                </ol>
                            </li>
                        </ol>
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($fifth_body,true,false,true,false,'');

            $sixth = '
                <br><p><u><b>SEXTA: DEPÓSITO DE CAPITAL A ADMINISTRAR</b></u></p><br>
            ';
            PDF::writeHtml($sixth,true,false,true,false,'');

            $sixth_body = '
                <table>
                <tr>
                    <td width="5%">6.1</td>
                    <td width="95%">
                        Por el presente contrato <b>EL MANDANTE</b> entrega a <b>EL COMISIONISTA</b> en custodia y administración, la suma de US$. '.$contract->payment->total.' 
                        (00/100 Dólares Americanos), para que éste pueda administrarlo conforme las facultades conferidas en la cláusula cuarta.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($sixth_body,true,false,true,false,'');

            $seventh = '
                <br><p><u><b>SEPTIMA: PLAN DE INVERSIÓN</b></u></p><br>
            ';
            PDF::writeHtml($seventh,true,false,true,false,'');

            $seventh_body = '
                <table>
                <tr>
                    <td width="5%">7.1</td>
                    <td width="95%">
                        De manera expresa, <b>EL MANDANTE</b> elige el plan de inversión “…….”, cuyas condiciones se encuentran detalladas en el Anexo Nro. 01, 
                        que adjunto al presente contrato, forma parte integrante e indesligable de este instrumento.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($seventh_body,true,false,true,false,'');

            $plans = '
                <br>
                <b>Plan Bronce:</b><br>
                Inversión: de US$ 100.00 a $300.00<br>
                Membresía anual: US$ 24.00<br>
                Comisión sobre la rentabilidad anual: 50%<br>
                <b>Plan Plata:</b><br>
                Inversión: de US$ 301.00 a $1,000.00<br>
                Membresía anual: US$ 60.00<br>
                Comisión sobre la rentabilidad anual: 50%<br>
                <b>Plan Oro:</b><br>
                Inversión: de US$ 1,001.00 a $5,000.00<br>
                Membresía anual: US$ 120.00<br>
                Comisión sobre la rentabilidad anual: 50%<br>
                <b>Plan Platino:</b><br>
                Inversión: de US$ 5,001.00 a $10,000.00<br>
                Membresía anual: US$ 144.00<br>
                Comisión sobre la rentabilidad anual: 45%<br>
                <b>Plan Diamante:</b><br>
                Inversión: de US$ 10,001.00 a $50,000.00<br>
                Membresía anual: US$ 240.00<br>
                Comisión sobre la rentabilidad anual: 45%<br>
            ';

            PDF::writeHtml($plans,true,false,true,false,'');

            $eighth = '
                <br><p><u><b>OCTAVA: DEL SISTEMA DE TRADING</b></u></p><br>
            ';
            PDF::writeHtml($eighth,true,false,true,false,'');

            $eighth_body = '
                <table>
                <tr>
                    <td width="5%">8.1</td>
                    <td width="95%">
                        El sistema de trading a emplear para la administración del capital se dará a través de un algoritmo programado para hacer compras y 
                        ventas de activos digitales de forma autónoma, tomando decisiones basadas únicamente en la información del mercado e indicadores estadísticos. <br>
                        Esto será gestionado a través de los traders y del soporte de robots de inteligencia artificial, generando factores de corrección que se ajustan 
                        según el comportamiento del mercado, minimizando pérdidas y compensando el valor obtenido.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($eighth_body,true,false,true,false,'');

            $nineth = '
                <br><p><u><b>NOVENA: DESEMBOLSO POR MANTENIMIENTO DEL SISTEMA DE TRADING</b></u></p><br>
            ';
            PDF::writeHtml($nineth,true,false,true,false,'');

            $nineth_body = '
                <table>
                <tr>
                    <td width="5%">9.1</td>
                    <td width="95%">
                        <b>EL MANDANTE</b> se obliga a realizar el depósito por el mantenimiento del sistema de trading según el plan elegido en la cláusula sexta, esto durante 
                        la vigencia del contrato, el pago deberá ser realizado en el momento de suscribirse al plan de inversión.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($nineth_body,true,false,true,false,'');

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
            $tenth = '
                <br><p><u><b>DÉCIMA: PLAZO DE DURACIÓN DEL CONTRATO</b></u></p><br>
            ';
            PDF::writeHtml($tenth,true,false,true,false,'');
            $tenth_body = '
                <table>
                <tr>
                    <td width="5%">10.1</td>
                    <td width="95%">
                        El plazo del presente contrato es de un (01) año y entrará en vigor a partir del '.date_format($contract->created_at,'d').' de '.
                        $months[date_format($contract->created_at,'n')].' del '.date_format($contract->created_at,'Y').'. 
                        Quince (15) días antes del vencimiento del contrato, <b>EL COMISIONISTA</b> notificará a la cuenta de <b>EL MANDANTE</b> sobre la transferencia a su cuenta.
                    </td>
                </tr>
                <tr>
                    <td width="5%">10.2</td>
                    <td width="95%">
                        Ambas partes convienen que el plan de inversión podrá ser renovado si las condiciones objetivas que determinaron su contratación subsistieran, así como las 
                        necesidades del servicio, en cuyo caso se celebrará un nuevo contrato escrito. 
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($tenth_body,true,false,true,false,'');

            $eleventh = '
                <br><p><u><b>DÉCIMO PRIMERA: CONTRAPRESTACIÓN</b></u></p><br>
            ';
            PDF::writeHtml($eleventh,true,false,true,false,'');
            $eleventh_body = '
                <table>
                <tr>
                    <td width="5%">11.1</td>
                    <td width="95%">
                        Por el servicio a que se refiere el presente contrato, <b>EL MANDANTE</b> se obliga a pagar a <b>EL COMISIONISTA</b> el porcentaje de comisión fijada 
                        según el tipo de plan elegido en la cláusula quinta.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($eleventh_body,true,false,true,false,'');
            
            $twelveth = '
                <br><p><u><b>DECIMO SEGUNDA: DE LA FORMA DE PAGO Y DEVOLUCIÓN DEL CAPITAL</b></u></p><br>
            ';
            PDF::writeHtml($twelveth,true,false,true,false,'');
            $twelveth_body = '
                <table>
                <tr>
                    <td width="5%">12.1</td>
                    <td width="95%">
                    La contraprestación por los servicios de <b>EL COMISIONISTA</b>, será deducida del resultado de las ganancias que generé 
                    la administración del capital en el mercado de criptodivisas al término del contrato; del mismo modo, la devolución del
                     capital y las ganancias que éste haya generado se entregarán al término del contrato.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($twelveth_body,true,false,true,false,'');

            $thirteenth = '
                <br><p><u><b>DECIMO TERCERA: DE LAS OBLIGACIONES DEL COMISIONISTA</b></u></p><br>
            ';
            PDF::writeHtml($thirteenth,true,false,true,false,'');
            $thirteenth_body = '
                <table>
                <tr>
                    <td width="5%">13.1</td>
                    <td width="95%">
                        <b>EL MANDANTE</b> durante la ejecución del presente asume las siguientes obligaciones:
                        <ol type="a">
                            <li>Realizar el pago anual de la membresía, según el plan elegido, dentro del plazo establecido.</li>
                            <li>Asumir, previa coordinación y aviso, costos externos que se generen de los bancos, billeteras digitales, comisiones, etc.</li>
                            <li>Registrar sus datos e información fidedigna para el registro de las cuentas. Cuando la información consignada en la 
                            HOJA DE DATOS se modifique, EL MANDANTE deberá actualizar dicha información completando una nueva HOJA DE DATOS adicional a la 
                            suscrita originalmente, la misma que se formará también parte integrante del presente contrato.</li>
                            <li>Declarar que la procedencia de su capital de inversión no está ligado a orígenes ilícitos o actividades consideradas delitos dentro de la legislación peruana.</li>
                        </ol>
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($thirteenth_body,true,false,true,false,'');

            
            $fourteenth = '
            <br><p><u><b>DECIMO CUARTA: DE LAS OBLIGACIONES DEL MANDANTE </b></u></p><br>
            ';
            PDF::writeHtml($fourteenth,true,false,true,false,'');
            $fourteenth_body = '
            <table>
            <tr>
            <td width="5%">14.1</td>
            <td width="95%">
            <b>EL MANDANTE</b> durante la ejecución del presente asume las siguientes obligaciones:
            <ol type="a">
            <li>Realizar el pago anual de la membresía, según el plan elegido, dentro del plazo establecido.</li>
            <li>Asumir, previa coordinación y aviso, costos externos que se generen de los bancos, billeteras digitales, comisiones, etc.</li>
            <li>Registrar sus datos e información fidedigna para el registro de las cuentas. Cuando la información consignada en la CUENTA DE 
            VERIFICACION DE LA PLATAFORMA se modifique, EL MANDANTE deberá actualizar dicha información completando una nueva HOJA DE DATOS adicional 
            a la suscrita originalmente, la misma que se formará también parte integrante del presente contrato.</li>
            <li>Declarar que la procedencia de su capital de inversión no está ligado a orígenes ilícitos o actividades consideradas delitos dentro de la legislación peruana.</li>                            
            </ol>
            </td>
            </tr>
            </table>
            ';
            
            PDF::writeHtml($fourteenth_body,true,false,true,false,'');
            $fifteenth = '
                <br><p><u><b>DECIMO QUINTA: CONOCIMIENTO DE ALTO RIESGO</b></u></p><br>
            ';
            PDF::writeHtml($fifteenth,true,false,true,false,'');
            $fifteenth_body = '
                <table>
                <tr>
                    <td width="5%">15.1</td>
                    <td width="95%">
                        <b>EL MANDANTE</b> reconoce expresamente que las operaciones que realizará <b>EL COMISIONISTA</b> 
                        son de alto riesgo, por lo que, exime de toda responsabilidad a <b>EL COMISIONISTA</b> de cualquier pérdida del capital administrado.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($fifteenth_body,true,false,true,false,'');
            
            $sixteenth = '
                <br><p><u><b>DECIMO SEXTA: CONCESIONES RECÍPROCAS</b></u></p><br>
            ';
            PDF::writeHtml($sixteenth,true,false,true,false,'');
            $sixteenth_body = '
                <table>
                <tr>
                    <td width="5%">16.1</td>
                    <td width="95%">
                        Las partes declaran de manera conjunta que para la suscripción del presente contrato no ha mediado error, falta de diligencia, 
                        ilicitud ni ninguna otra conducta que pueda dar lugar a responsabilidad alguna de una frente a la otra y, por lo tanto, ambas partes 
                        declaran que el presente contrato se ha efectuado de conformidad con las normas vigentes.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($sixteenth_body,true,false,true,false,'');

            $seventeenth = '
                <br><p><u><b>DECIMO SÉPTIMA: CONFIDENCIALIDAD</b></u></p><br>
            ';
            PDF::writeHtml($seventeenth,true,false,true,false,'');
            $seventeenth_body = '
                <table>
                <tr>
                    <td width="5%">17.1</td>
                    <td width="95%">
                        <b>EL COMISIONISTA</b> se compromete y obliga, durante y después de la vigencia del presente contrato, a no usar en su propio provecho 
                        ni divulgar directa o indirectamente información que obtenga de <b>EL MANDANTE</b> producto de la relación contractual presente. 
                        <b>EL COMISIONISTA</b> declara que la violación de este compromiso, mientras dure el contrato, constituye falta grave pudiendo tomar 
                        las acciones legales contra los que resulten responsables. 
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($seventeenth_body,true,false,true,false,'');

            $eighteenth = '
                <br><p><u><b>DECIMO OCTAVA: CONSENTIMIENTO INFORMADO PARA EL TRATAMIENTO DE DATOS PERSONALES DEL MANDANTE.</b></u></p><br>
            ';
            PDF::writeHtml($eighteenth,true,false,true,false,'');
            $eighteenth_body = '
                <table>
                <tr>
                    <td width="5%">18.1</td>
                    <td width="95%">
                        <b>EL MANDANTE</b> de manera expresa otorga consentimiento a <b>AEIA INVESTMENT E.I.R.L.</b> identificado con RUC Nº 20608381741, sobre sus datos personales, 
                        para que ésta los integre a sus bases de datos de manera permanente y realice tratamientos para su propio uso, únicamente <b>EL COMISIONISTA</b> podrá compartir 
                        datos de <b>EL MANDANTE</b> en caso de requerimiento judicial.
                    </td>
                </tr>
                <tr>
                    <td width="5%">18.2</td>
                    <td width="95%">
                        <b>EL MANDANTE</b> declara que el presente consentimiento lo otorga de manera libre, previa, expresa, inequívoca e informada. Se deja constancia que los datos 
                        de identidad y dirección de <b>AEIA INVESTMENT E.I.R.L.</b>, como Titular de las Bases de Datos, a efectos de que quien suscribe este documento pueda dirigirse, en 
                        caso decida ejercer cualquiera de los derechos previstos en la legislación vigente (acceso, rectificación, cancelación y oposición en los términos previstos en 
                        la Ley de Protección de Datos Personales (Ley Nº 29733) y su Reglamento (Decreto Supremo Nº 003-2013-JUS), así como revocar su consentimiento para el uso de sus 
                        datos), son los siguientes:
                        <br>
                        <b>AEIA INVESTMENT E.I.R.L..</b>, con RUC N° 20608381741
                        Dirección: Urb. El Solar de Challapampa A -25´ distrito de Cerro Colorado, provincia y departamento de Arequipa.
                        Correo electrónico: XXXXXXXXXXXXXX                        
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($eighteenth_body,true,false,true,false,'');

            $nineteenth = '
                <br><p><u><b>DECIMO NOVENA: REGIMEN LEGAL APLICABLE</b></u></p><br>
            ';
            PDF::writeHtml($nineteenth,true,false,true,false,'');
            $nineteenth_body = '
                <table>
                <tr>
                    <td width="5%">19.1</td>
                    <td width="95%">
                    Ambas partes declaran que las labores que desarrollará <b>EL COMISIONISTA</b> se encuentran dentro de los alcances artículo 1790° 
                    de Código Civil, así como las demás normas que resulten aplicables y pertinentes al salvaguardo de sus derechos. Por tanto, 
                    la prestación de servicios al amparo del presente contrato en ningún modo generará relación laboral entre las partes.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($nineteenth_body,true,false,true,false,'');

            $twentyth = '
                <br><p><u><b>VIGÉSIMA: CLAUSULA LEGAL RESOLUTORIA</b></u></p><br>
            ';
            PDF::writeHtml($twentyth,true,false,true,false,'');
            $twentyth_body = '
                <table>
                <tr>
                    <td width="5%">20.1</td>
                    <td width="95%">
                        El Contrato quedará resuelto de pleno derecho únicamente en los siguientes casos:
                        <ol type="a">
                            <li>Cuando, por motivo de una investigación de los datos proporcionadas por <b>EL MANDANTE</b> se descubra que éste haya incurrido en actos ilícitos.</li>
                            <li>Cuando <b>EL MANDANTE</b> sea o haya sido incorporado por los organismos correspondientes en la Lista OFAC (emitida por la Oficina de Control de Activos 
                            Extranjeros del Departamento de Tesoro de los Estados Unidos de América), listas de terroristas o de Proliferación de Armas de Destrucción Masiva (emitida por la Organización de las Naciones Unidas), listas de terroristas de la Unión Europea u otras similares sobre actividades delictivas.</li>
                        </ol>
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($twentyth_body,true,false,true,false,'');

            $twentyfirst = '
                <br><p><u><b>VIGÉSIMO PRIMERA: ÁMBITO JURISDICCIONAL</b></u></p><br>
            ';
            PDF::writeHtml($twentyfirst,true,false,true,false,'');
            $twentyfirst_body = '
                <table>
                <tr>
                    <td width="5%">21.1</td>
                    <td width="95%">
                    Cualquier controversia derivada de la celebración, ejecución y/o interpretación del presente contrato, que las partes no puedan resolver por negociación directa, será 
                    sometida a los jueces y tribunales del distrito judicial de Arequipa.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($twentyfirst_body,true,false,true,false,'');

            $twentysecond = '
                <br><p><u><b>VIGÉSIMO SEGUNDA: DOMICILIO DE LAS PARTES</b></u></p><br>
            ';
            PDF::writeHtml($twentysecond,true,false,true,false,'');
            $twentysecond_body = '
                <table>
                <tr>
                    <td width="5%">22.1</td>
                    <td width="95%">
                    Las partes ratifican como sus respectivos domicilios los señalados en la introducción del presente contrato, por lo que 
                    se reputarán válidas todas las comunicaciones y notificaciones dirigidas a los mismos con motivo de la ejecución del presente 
                    contrato. El cambio de domicilio de cualquiera de las partes surtirá efecto recién a partir del día siguiente de notificado por 
                    escrito a la otra parte.
                    </td>
                </tr>
                </table>
            ';

            PDF::writeHtml($twentysecond_body,true,false,true,false,'');

            $end = 'En señal de conformidad las partes suscriben este documento que se extiende por triplicado el día'.date_format($contract->created_at,'d').' del mes de '.
            $months[date_format($contract->created_at,'n')].' del '.date_format($contract->created_at,'Y').'<br><br><br><br>';
            PDF::writeHtml($end,true,false,true,false,'');
            $footer = '
                <table style="text-align: center">
                <tr>
                    <td width="5%"></td>
                    <td width="40%" style="border-top: 1px solid">
                        <b>AEIA INVESTMENT E.I.R.L.</b><br>
                        RUC N° 20608381741 <br>
                        <b>EL COMISIONISTA</b>
                    </td>
                    <td width="5%"></td>
                    <td width="40%" style="border-top: 1px solid">
                        <b>'.$contract->full_name.'</b><br>
                        '.$contract->type_document.' N° '.$contract->identification_number.'<br>
                        <b>EL MANDANTE</b>
                    </td>
                    <td width="5%"></td>
                </tr>
                </table>
            ';

            PDF::writeHtml($footer,true,false,true,false,'');
            PDF::Output("Contrato de administracion de capital-".$contract->code.".pdf");
            return redirect(route('contracts.index'));
        }
    }
}
