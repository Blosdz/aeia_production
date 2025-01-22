<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{

    public function generateToken(Request $request)
    {
        // Extraer los datos del encabezado y del cuerpo
        $transactionId = $request->header('transactionId');
        $body = $request->all();

        // Verifica que los datos sean válidos antes de enviarlos
        if (!$transactionId || empty($body)) {
            return response()->json([
                'error' => 'Datos faltantes',
                'details' => 'El encabezado transactionId o el cuerpo de la solicitud están vacíos',
            ], 400);
        }

        // Configura el endpoint de Izipay
        $url = 'https://sandbox-api-pw.izipay.pe/security/v1/Token/Generate';

        try {
            // Enviar la solicitud POST al endpoint de Izipay
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'transactionId' => $transactionId,
            ])->post($url, $body);

            // Revisar la respuesta de Izipay
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json([
                    'error' => 'Error al generar el token',
                    'details' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
