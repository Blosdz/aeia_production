<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Contract;
use App\Models\Plan;
use App\Models\Fondo;
use App\Models\User;
use App\Models\ClientPayment;
use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



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
   
    public function index()
    {
        // Obtén el usuario autenticado actualmente
        $user = Auth::user();

        // Obtén todos los pagos del cliente con sus planes asociados
        $clientPayments = ClientPayment::with('plan', 'payment')->where('user_id', $user->id)->get();

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

}
