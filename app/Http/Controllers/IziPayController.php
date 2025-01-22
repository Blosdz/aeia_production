<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use dd;
class IziPayController extends Controller
{
    //create password and authenticate key
    public function generateAuthorizationKey(){
        $user = env('IZI_USER');
        $password = env('IZI_PASSWORD');
        $originalKey = $user.':'.$password;
        return 'Basic '.base64_encode($originalKey);
    }

    public function generateFormToken(){
        //create Token payment

        //este es el url para generar el formulario con Qr
        $url='https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePaymentOrder';
        // el url para generar el formulario en la web es este
        // $url='https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment';

        // $url='https://api.micuentaweb.pe/api-payment/V4/Charge/CreateQRCode';

        $authorizationKey=$this->generateAuthorizationKey();

        $response = Http::withHeaders([
            'Authorization' => $authorizationKey,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'amount' => 180, // Ajusta según tu lógica
            'currency' => 'PEN',
            'customer' => [
                'email' => 'sample@example.com',
            ],
            'orderId' => 'myOrderId-884009', // Ajusta según tu lógica
                //formwith QR
            'channelOptions'=>[
                'channelType'=>'URL',
                'urlOptions'=>[
                    'generateQRCode'=>'true',
                    'qrCodeSize'=>250,
                ],
            ],
        ]);

        // $response = Http::withHeaders([
        //     'Authorization'=>$authorizationKey,
        //     'Content-Type'=>'application/json',
        // ])->post($url,[
        //         'amount'=>180,
        //         'currency'=>'PEN',
        //         'orderId'=>'myOrderId-884009',
        //         'paymentMethodType'=>'[SELECT PAYMENT METHOD]',
        //         'customer'=>[
        //             'email'=>'sample@example.com',
        //         ],
        //
        //     ]);
        //

        if ($response->successful()) {

            $formToken=$response->json()['answer']['formToken'] ?? null;
            $qrCode=$response->json()['answer']['channelDetails']['urlDetails']['qrCode'] ??null;
            return['formToken'=>$formToken,'qrCode'=>$qrCode];


            // return $response->json()['answer']['formToken']  ?? null;
        }
        throw new \Exception('Error al generar el Form Token: ' . $response->body());

    }

      public function showPaymentForm()
    {
        try {
            // $formToken = $this->generateFormToken();
            $paymentData = $this->generateFormToken(); // Obtén ambos valores
            $formToken = $paymentData['formToken'];
            return $paymentData;
            //solo si se manda el url con
            //en este caso es null
            // $qrCode = $paymentData['qrCode'] ?? null;
            // return view('testIzi', compact('formToken','qrCode'));
        } catch (\Exception $e) {
            return view('testIzi')->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function success(Request $request){
        // Capturar los datos enviados por Izipay
        $data = $request->all();

        // Aquí puedes registrar los datos en la base de datos o realizar cualquier lógica adicional
        \Log::info('Izipay Success Response:', $data);

        // Devolver una respuesta HTTP 200 (éxito)
        return response()->json([
            'message' => 'Payment success data received successfully!',
            'data' => $data,
        ], 200);
    }


}
