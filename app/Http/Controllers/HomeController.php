<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Contract;
use App\Models\Plan;
use App\Models\Fondo;
use App\Models\User;
use App\Models\ClientPayment;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;
use App\Models\SuscriptorHistorial;
use App\Models\FondoClientes;
use App\Models\FondoHistoriaClientes;
use App\Models\FondoHistorial;
use App\Models\SubscriptorDataModel;
use Carbon\Carbon;

use Illuminate\Session\SessionManager;  

use DateTime;
use Str;
use dd;
// use FondoHistorial;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['sendmail', 'welcome']]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function index(){
        $user=Auth::user();
        if(!$user){
            abort(404,'user not found');
        }
        $data = $this->DataUsers($user);
        return view('home',compact('user','data'));
     }
    
    public function DataUsers($user){
        switch($user->rol){
            case 1:
                return $this->data_admin();
            case 2:
                return $this->getUserReferidos();
            case 3:
                return $this->getUserCliente();
            case 4:
                return $this->getUserCliente();
            case 5:
                return $this->getUserReferidos();
            case 6:
                return $this->getUserVerificador();
            case 7:
                return $this->getUser7Data();
            case 8:
                return $this->getUserBanco();
        }

    }

    public function data_admin()
    {
        $user = Auth::user();
        
        // Obtener todos los fondos con su historial
        $fondos = Fondo::with('historial')->get();
    
        // Crear la estructura de datos para cada fondo
        // dd($fondos);
        $fondosChartData = [];
    
        foreach ($fondos as $fondo) {
            $fondoData = [];
            foreach ($fondo->historial as $historial) {
                $fondoData[] = [
                    'x' => $historial->created_at->format('Y-m-d H:i:s'),  // Fecha
                    'y' => [
                        $historial->ganancia_neta           // valor de actualizacion en historial
                         
                    ]
                ];
            }
            $fondosChartData[$fondo->id] = $fondoData;  // Asociar el fondo con su historial
        }
    
        // Otros datos
        $membresias = SubscriptorDataModel::where('user_table_id', $user->id)->first(); 
        $totalsumado = Fondo::sum('total_comisiones');
    
        // Pasar los datos a la vista
        return view('adminDashboard', compact('fondos', 'fondosChartData', 'membresias', 'totalsumado'));
    }
    

    public function getFondoData($id)
    {
        $fondo = Fondo::find($id);
        $historial = FondoHistorial::where('fondo_id', $id)->get();

        return response()->json([
            'name' => $fondo->name,
            'created_at' => $fondo->created_at->format('d-m-Y'),
            'total_comisiones' => $fondo->total_comisiones,
            'historial' => $historial
        ]);
    }

    

    public function data_idk()
    {
        // Obtén el usuario autenticado actualmente
        $user = Auth::user();

        // Obtén todos los pagos del cliente con sus planes asociados
        $clientPayments = ClientPayment::with('plan', 'payment')->where('user_id', $user->id)->get();

        $notificaciones= Notification::where('user_id', $user->id)->get();

        // Agrupa los pagos por plan_id
        $groupedPayments = $clientPayments->groupBy('plan_id');

        // Obtener el total de los pagos del usuario
        $payments = Payment::where('user_name', $user->name)->get();
        $totalPayment = $payments->sum('total');

        // Calcular el total de la comisión que se queda la empresa y la parte que sobra
        $totalComisionEmpresa = 0;
        $totalSobra = 0;

        // Obtener los fondos del año y mes actuales
        $currentYear = date('Y');
        $currentMonth = date('m');
        $fondo = Fondo::where('year', $currentYear)->where('month', $currentMonth)->first();

        if ($fondo) {
            foreach ($clientPayments as $clientPayment) {
                $plan = $clientPayment->plan;
                $payment = $clientPayment->payment;

                if ($plan && $payment) {
                    $porcentaje = $payment->total / $fondo->total;
                    $gananciaSinComision = $porcentaje * $fondo->renta;

                    $comisionEmpresa = $gananciaSinComision * ($plan->commission / 100);
                    $sobra = $gananciaSinComision - $comisionEmpresa;

                    $totalComisionEmpresa += $comisionEmpresa;
                    $totalSobra += $sobra;
                }
            }
        }

        // Pasar los pagos agrupados y los cálculos a la vista
        return view('home', compact('groupedPayments', 'totalPayment', 'totalComisionEmpresa', 'totalSobra', 'fondo'));
    }
    public function start()
    {
        return view('start');
    }
    public function welcome()
    {
        $dt = Carbon::Now();
        return view('welcome');
    }
    public function getUserVerificador(){
        return view('home');
    }

    public function getUserBanco(){
        return view('home');
    }
    public function sendmail(Request $request)
    {

        $data = $request->all();
        
        $data['email_send'] = "dbutron9211@gmail.com";
        //data['email_send'] = "danieldantecuevas@gmail.com";
        $MailCustom = MailCustom::to($data['email_send'])->queue(new SendMail($data));

        return response()->json([
            'status'        => true,
            'message'       => $data,
            'MailCustom'    => $MailCustom
        ], 200);

    }

    public function getUserReferidos(){
        $user = Auth::user();
        $uniqueCode = $user->unique_code;
        if (!$uniqueCode) {
            // Generar un unique_code si el usuario no tiene uno
            $uniqueCode = Str::random(10); // o cualquier otra lógica para generar el código
            $user->unique_code = $uniqueCode;
            $user->save();
        }
        $inviteLink = route('register', ['refered_code' => $uniqueCode]);

        $dataInvitados = User::where('refered_code', $uniqueCode)->count();
        $totalClientes = User::all()->count();
        $qrCode =  QrCode::size(250)->generate($inviteLink);

        $montoGenerado = SubscriptorDataModel::where('user_table_id', $user->id)->pluck('membership_collected')->first();
        $infoSuscriptor = SuscriptorHistorial::where('refered_code', $user->unique_code)->get();

        // Generar los datos para el gráfico
        $chartDataSus = [];
        $totalCollected = 0;
        foreach ($infoSuscriptor as $historial) {
            $totalCollected += $historial->membership_collected;
            $chartDataSus[] = [
                'date' => $historial->created_at->format('Y-m-d'),
                'total_collected' => $totalCollected
            ];
        }

        // dd($chartDataSus);
        $porcentajeInvitados = $totalClientes > 0 ? ($dataInvitados / $totalClientes) * 100 : 0;

        return view('home', compact('inviteLink', 'dataInvitados', 'totalClientes', 'porcentajeInvitados', 'montoGenerado', 'chartDataSus','qrCode'));
    }

    public function getUserCliente()
    {
        $user = Auth::user();
        // Obtener el primer día del mes actual
        $primerDiaMesActual = Carbon::now()->startOfMonth()->toDateString();
    
        // Obtener el último día del mes actual
        $ultimoDiaMesActual = Carbon::now()->endOfMonth()->toDateString();
    
        // Filtrar FondoClientes por el mes actual
        // $fondoClientes = FondoClientes::where('user_id', $user->id)
                                    //    ->whereDate('created_at', '>=', $primerDiaMesActual)
                                    //    ->whereDate('created_at', '<=', $ultimoDiaMesActual)
                                    //    ->get();

        
        $userProfile = Profile::where('user_id',$user->id)->first();

        $fondoids=FondoClientes::where('user_id',$user->id)->pluck('id');
        // dd($fondoClientes);
        // Filtrar Fondo por el mes actual
        $ultimoFondo = Fondo::latest()->first();

        $montoInvertidoTotal=FondoClientes::where('plan_id_fondo',$ultimoFondo->id)->where('user_id',$user->id)->sum('monto_invertido');
        dd($montoInvertidoTotal);
    

        // ********************************TIMER************************************************
        $currentDate=new DateTime();
        $targetDate=new DateTime('29-'.$currentDate->format('m').'-'.$currentDate->format('Y'));
        if($currentDate>$targetDate){
            $targetDate->modify('+1month');
        }
        $interval=$currentDate->diff($targetDate);

        // *********************************************************************************

        // $fondoClientes = FondoClientes::selectRaw('DATE(created_at)as date,')where('user_id', $user->id)->pluck('id');
        // $ultimoFondo= Fondo::selectRaw('DATE(created_at) as date, ')->where();
        // $montoInvertidoTotal = FondoClientes::whereIn('id', $fondoClientes)->sum('monto_invertido');
        if($montoInvertidoTotal){
            $totalFondo=$ultimoFondo->total;
            $montoInvertido=$montoInvertidoTotal;
            // $montoInvertido = FondoHistoriaClientes::where('plan_id_fondo',$ultimoFondo->id)->where('fondo_cliente_id',$user->id)->sum('total_invertido');
            $porcentajeInvertido = ($montoInvertidoTotal/ $ultimoFondo->total) * 100;
        }else{
            $totalFondo=0;
            $montoInvertidoTotal=0;
            $porcentajeInvertido=0 ;
        }
        

        dd($montoInvertido,$ultimoFondo);

        // *******************************************************************************

        $currentMonth = date('n'); // Obtener el mes actual (por ejemplo, junio sería 6)

        $paymentsTotal = Payment::where('user_id',$user->id)->sum('total') ;

        $homeGraph =   ClientPayment::where('user_id',$user->id);

        // $fondoTotal = Fondo::where('month', $currentMonth)->value('total');
        // dd($paymentsTotal);
        
        $historiaClientes = FondoHistoriaClientes::whereIn('fondo_cliente_id', $fondoids)->get();

        // data client
        $fondoClientesTotal = FondoClientes::where('user_id', $user->id)->sum('ganancia');

        $totalInversionYBeneficio = ($fondoClientesTotal ?? 0) + $paymentsTotal;

        // dd($totalInversionYBeneficio);
        // 707.19 databalance 465 invertido


            // Suma del monto invertido de todos los planes que tiene el usuario
        $totalInversionPlanes = FondoClientes::where('user_id', $user->id)->sum('monto_invertido');

        // $totalInversionPlanes = $totalInversionPlanes ?? 0;


        //porcentaje del fondo de este mes corregir 
        // $ultimoFondo = FondoClientes::where('user_id',$user->id)->latest()->first();

        // Preparar los datos para el gráfico de dona en ApexCharts
        
    
        $planData = [];
        $mapPlan = [
            1 => 'bronce',
            2 => 'plata',
            3 => 'oro',
            4 => 'platino',
            5 => 'diamante',
            6 => 'vip'
        ];

        // dd($plans);

        foreach ($historiaClientes as $historia) {
            $planId = $historia->planId;
            $planName = $mapPlan[$planId];
            $month = Carbon::parse($historia->created_at)->format('m-d');
            $total_invertido = $historia->ganancia;
            $inversion_inicial = $historia->total_invertido;
            if (!isset($planData[$planName])) {
                $planData[$planName] = [
                    'months' => [],
                    'data' => [],
                    'inversion_inicial'=>$inversion_inicial
                ];
            }
    
            $planData[$planName]['months'][] = $month;
            $planData[$planName]['data'][] = $total_invertido;
            $planData[$planName]['inversion_inicial'] = $inversion_inicial; 

        }

        $plans = Plan::all();
        // dd($planData);
        return view('home', compact('planData','totalInversionPlanes','totalInversionYBeneficio','porcentajeInvertido','interval','plans' ,'paymentsTotal','userProfile'));
    }



    // Obtener el fondo total para el mes actual

    // Obtener las inversiones del cliente para el mes actual

}

