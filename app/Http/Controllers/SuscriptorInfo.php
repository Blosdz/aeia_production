<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\ClientPayment;
use App\Models\Contract;
use App\Models\Declaraciones;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use dd;

class SuscriptorInfo extends Controller
{

    public function tableAdmin() {
        $suscriptores = User::where('rol', 2)->get();
        $clientes = User::where('rol', 3)->get(); 
        $business = User::where('rol', 4)->get();
        $administradores = User::where('rol', 5)->get();
        
        $suscriptores_data = [];
        
        foreach ($suscriptores as $suscriptor) {
            $profile = Profile::where('user_id', $suscriptor->id)->first();
            $suscriptores_data[] = [
                'user' => $suscriptor,
                'profile' => $profile,
                'suscriptor_id' => $suscriptor->id,
            ];
        }
        $business_data = [];

        foreach($business as $bus){
            $profile = Profile::where('user_id', $bus->id)->first();
            $business_data[] = [
                'user' => $bus,
                'profile' => $profile,
            ];
        }
        $client_data = [];
        foreach($clientes as $client){
            $profile = Profile::where('user_id', $client->id)->first();
            $client_data[] = [
                'user' => $client,
                'profile' => $profile,
                'cliente_id' => $client->id,
            ];
        }
        $administrador_data = [];
        foreach($administradores as $admin){
            $profile = Profile::where('user_id', $admin->id)->first();
            $administrador_data[] = [
                'user' => $admin,
                'profile' => $profile,
            ];
        }
        return view('users_new.index', compact('suscriptores_data', 'client_data', 'business_data', 'administrador_data'));
    }
    
    public function downloadDocuments($id)
    {
        // Obtener el perfil del cliente
        $profile = User::where('id', $id)->first();
    
        if (!$profile) {
            return redirect()->back()->with('error', 'No se encontró el perfil del cliente.');
        }
    
        // Obtener los documentos relacionados con el cliente
        $clientContracts = Contract::where('user_id', $id)->get();
        $clientDeclaraciones = Declaraciones::where('user_id', $id)->get();
    
    
        // $pdfDeclaraciones = $clientDeclaraciones ? Pdf::loadView('documentos.declaracionVoluntaria', compact('profile', 'clientDeclaraciones'))->output() : null;
    
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
        // Crear un archivo ZIP y agregar los PDFs
        $zipFileName = 'documentos_cliente_' . $profile->name . '.zip';
        $zipPath = storage_path($zipFileName);
        $zip = new \ZipArchive;
    
        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            // Base PDF with static data
            // $pdfBase = Pdf::loadView('documentos_new.contrato', compact('profile'))->output();
    
            // Agregar los PDFs de contratos con diferentes timestamps
            foreach ($clientContracts as $contract) {
                
                $timestamp = Carbon::parse($contract->created_at);

                // Create a new PDF with varying details
                $pdfWithDetails = Pdf::loadView('documentos_new.contrato', array_merge(
                    compact('profile'),
                    [
                        'code' => $contract->code,
                        'payment_id' => $contract->payment_id,
                        'timestamp' => $timestamp,
                        'profile' => $profile,
                        'contract'=>$contract,
                        'months'=>$months

                    ]
                ))->output();
    
                $formattedTimestamp = $timestamp->format('Y-m-d_H-i-s');
                $zip->addFromString("Contrato_{$formattedTimestamp}.pdf", $pdfWithDetails);
            }
    
            foreach($clientDeclaraciones as $declaraciones){
                $timestamp=$declaraciones->created_at;
                $pdfWithDetails=Pdf::loadView('documentos_new.declaracionVoluntaria',array_merge(
                    compact('profile'),[
                        'code' => $declaraciones->code,
                        'payment_id' => $declaraciones->payment_id,
                        'timestamp' => $declaraciones->created_at,
                        'profile' => $profile,
                        'declaracion'=>$declaraciones,
                        'months'=>$months                       
                    ]
                ))->output();

                $formattedTimestamp = $timestamp->format('Y-m-d_H-i-s');
                $zip->addFromString("Declaracion_{$formattedTimestamp}.pdf",$pdfWithDetails);
            }

            // Agregar el PDF de declaraciones si existe
    
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Error al crear el archivo ZIP.');
        }
    
        // Descargar el archivo ZIP y eliminarlo después de enviar
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
    

    public function tableAdminInfo($id){
        $user = User::find($id);
        if($user->rol != 2 || $user->rol!=5){
            $payments_data = Payments::where('user_id',$user->id)->get();

        }else{
            $data_suscriptor= ClientPaymet::where('referred_code',$user->unique_code)->get();
        }
        return view('gerente_funciones.detailDataSuscriptores', compact('suscriptor', 'users_with_payments'));
    }

    public function tableSuscriptors()
    {
        $user = Auth::user();
        $unique_link = $user->unique_code;
        $users_refered = User::where('refered_code', $unique_link)->get();
        $array_subs = $users_refered->toArray();

        foreach ($users_refered as $subscriptor_refered) {
            // Contar el número de referidos
            $get_number_refereds = User::where('refered_code', $subscriptor_refered->unique_code)->count();
            
            // Agregar el conteo de referidos al array
            $subscriptor_refered->totalReferidos = $get_number_refereds;
        }

        return view('gerente_funciones.tablaSuscriptores', compact('users_refered'));
    
    }
    public function detailSuscriptor($id)
    {
        // Obtener el suscriptor por ID
        $suscriptor = User::find($id);
        if (!$suscriptor) {
            // Manejar el caso en que el suscriptor no se encuentre
            return redirect()->back()->with('error', 'Suscriptor no encontrado');   
        }

        // Obtener los usuarios referidos por el suscriptor
        $data_client = User::where('refered_code', $suscriptor->unique_code)->get();
        
        // Crear un array para almacenar la información de usuarios referidos con sus pagos
        $users_with_payments = [];

        // Iterar sobre cada usuario referido
        foreach ($data_client as $user) {
            // Obtener los pagos realizados por cada usuario referido
            $payment_client = ClientPayment::where('user_id', $user->id)->get();

            // Convertir el usuario y sus pagos a array y añadir el plan_id
            $user_array = $user->toArray();
            $user_array['plan_id'] = $payment_client->pluck('plan_id')->toArray(); // Asumiendo que tomas el primer plan_id encontrado

            // Añadir el usuario con sus pagos al array
            $users_with_payments[] = $user_array;
        }

        // dd($users_with_payments);
        // Pasar la información a la vista
        return view('gerente_funciones.detailDataSuscriptores', compact('suscriptor', 'users_with_payments'));
    }
    public function tableClientes()
    {
        $user = Auth::user();
        $unique_link = $user->unique_code;
        $users_refered = User::where('refered_code', $unique_link)->get();

        foreach ($users_refered as $subscriptor_refered) {
            // Contar el número de referidos
            $get_number_refereds = User::where('refered_code', $subscriptor_refered->unique_code)->count();

            // Sumar los pagos del usuario referido
            $user_payment = Payment::where('user_id', $subscriptor_refered->id)->sum('total'); // Cambiado a 'total'

            // Agregar el conteo de referidos y el total de pagos al objeto de usuario referido
            $subscriptor_refered->totalReferidos = $get_number_refereds;
            $subscriptor_refered->totalPayments = $user_payment;
        }

        // dd($users_refered);
        return view('suscriptor_funciones.tablaClientes', compact('users_refered'));
    }

    public function detailCliente($id){
        // Obtener los usuarios referidos por el suscriptor

        $data_client = User::find($id);
        
        // dd($data_client);
        // Crear un array para almacenar la información de usuarios referidos con sus pagos
        $users_with_payments = [];

        $user_payments=ClientPayment::where('user_id',$id)->get();

        $user_total=Payment::where('user_id',$data_client->id)->get();

        $userarray=$data_client->toArray();
        $userarray['plan_id']=$user_payments->pluck('plan_id')->toArray();
        $userarray['total']=$user_total->pluck('total')->toArray();
        $users_with_payments=$userarray;
        // dd($users_with_payments);
        return view('suscriptor_funciones.detailDataClientes', compact('users_with_payments'));
    }

    
}

