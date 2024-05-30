<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FondoClientes;
use App\Models\Fondo;
use App\Models\Payment;
use App\Models\ClientPayment;
use App\Models\Plan;


class FondoClientesController extends Controller
{
    //
    public function index(){
	$fondoClientes=FondoClientes::all();
	$fondoGeneral=Fondo::all();
	return view('home',compact('fondoClientes'));
    }
}
