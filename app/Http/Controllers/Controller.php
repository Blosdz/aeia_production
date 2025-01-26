<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Fondo;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function landing(){

        $fund = Fondo::where('fondo_name', 'dummy')->first(); // Obtener un solo registro

        $months=['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];

        // dd($fund->month);

        $month=$months[$fund->month-1];


        $historial = json_decode($fund->amounts_historial, true) ?? [];

        return view('landing_site', compact('historial','month'));

    }


}
