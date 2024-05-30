<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Contract;
use App\Models\Plan;
use App\Models\User;
use App\Models\ClientPayment;
use Illuminate\Support\Facades\Mail as MailCustom;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class ShowStatsController extends Controller
{
    //
     public function showStats(){
            // Obtén el usuario autenticado actualmente
        $user = Auth::user();


        // Obtén todos los pagos del cliente con sus planes asociados
        $clientPayments = ClientPayment::with('plan')->where('user_id',$user->id)->get();
        

        // Agrupa los pagos por plan_id
        $groupedPayments = $clientPayments->groupBy('plan_id');


        $payments=Payment::where('user_name',$user->name)->get();
        $totalPayment=$payments->sum('total');

        $clientsPay=$payments->groupBy('total');

        // Pasar los pagos agrupados a la vista
        return view('home', compact('groupedPayments','totalPayment','clientsPay'));


    }
}
