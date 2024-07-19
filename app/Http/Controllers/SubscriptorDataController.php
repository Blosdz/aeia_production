<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptorDataModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SubscriptorDataController extends Controller
{
    //
    public function index()
    {
        // Obtener el unique_code del usuario autenticado
        $uniqueCode = Auth::user()->unique_code;

        // Obtener todas las instancias donde el unique_code fue usado como refered_code
        $subscriptorData = SubscriptorDataModel::where('refered_code', $uniqueCode)
                            ->orderBy('created_at', 'desc') // Ordenar por la más reciente
                            ->get();

        // Retornar la vista con los datos
        return view('subscriptor_data_new.index', compact('subscriptorData'));

    }

}
