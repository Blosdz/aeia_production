<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientPayments;
use App\Models\Payment;
use App\Models\Fondo;
use App\Http\Controllers\PaymentController;

class FondoGeneralController extends Controller
{	
     public function showTotalAmount()
    {
        // Obtener el registro de FondoGeneral
        $fondoGeneral = FondoGeneral::first();

        // Verificar si existe un registro de FondoGeneral
        if ($fondoGeneral) {
            $totalAmount = $fondoGeneral->monto;
            return response()->json(['total_amount' => $totalAmount]);
        } else {
            return response()->json(['error' => 'No se encontró ningún registro de FondoGeneral'], 404);
        }
    }
     public function updateTotalAmount()
    {
        // Calcular la suma de los totales de los pagos
        $totalPayments = Payment::sum('total');

        // Obtener o crear el registro de FondoGeneral
        $fondoGeneral = FondoGeneral::firstOrNew([]);

        // Actualizar el monto en FondoGeneral
        $fondoGeneral->monto = $totalPayments;

        // Guardar el registro de FondoGeneral
        $fondoGeneral->save();

        return response()->json(['message' => 'FondoGeneral actualizado correctamente']);
    }
}
