<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Contract;
use App\Models\Plan;
use App\Models\User;
use App\Models\ClientPayment;
use App\Http\Controllers\AppBaseController;
use App\Http\Interfaces\BinanceTransferInterface;
use App\Http\Requests\ClientPaymentRequest;
use App\Http\Services\BinanceQRGeneratorService;
use App\Http\Services\BinanceTransferMoneyToClientsService;
use App\Http\Services\BinanceTransferMoneyToSubscribersService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Traits\BinanceMoneySplitterTrait;
use App\Traits\BinanceDoughSenderTrait;
use App\Traits\BinanceBalanceCheckerTrait;
//use Symfony\Component\HttpFoundation\Response;
use App\Models\Photo;
// use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PaymentRepository;
use App\Models\Facturas;


class FacturasController extends Controller
{
    //
	//
	private $paymentRepository;
	public function __construct(PaymentRepository $paymentRepo){
		$this->paymentRepository=$paymentRepo;
		$this->transfer=null;
	}
	public function show_index(Request $request){
		$payments=$this->paymentRepository->all();
		if(empty($payments)){
			Flash::error('no hay pagos');
		}
		return view('admin_funciones_new.facturas')->with('payments',$payments);
	}
	public function store_voucher(Request $request, $id)
	{
	    $payment = Payment::findOrFail($id);
	    $filePath = 'voucher/';
	    $user = User::findOrFail($id);
	    $user_id = $user->id;
	    // Verificar si hay un archivo PDF en la solicitud
	    if ($request->hasFile('pdf_file')) {
	        // Crear el directorio si no existe
	        if (!file_exists(storage_path('app/public/' . $filePath))) {
	            Storage::makeDirectory('public/' . $filePath, 0777, true);
	        }
	
	        // Generar un nombre único para el archivo PDF
	        $name = uniqid() . '.' . $request->file('pdf_file')->getClientOriginalExtension();
	        // Ruta completa donde se guardará el archivo PDF
	        $path = $filePath . $name;
	
	        // Almacenar el archivo PDF
	        $request->file('pdf_file')->storeAs('public/' . $filePath, $name);
	        
	        // Crear la factura asociada al pago
          	$newFactura = new Facturas();
	        $newFactura->route_path = '/storage/' . $path;
	        $newFactura->user_name = $payment->user->name;
	        $newFactura->user_id = $payment->user_id;
        	$newFactura->save();
        
	        // Devolver una respuesta JSON con la URL del archivo y un mensaje de éxito
	        return response()->json([
	            'url' => url('/storage/' . $path),
	            'message' => $name . ' subido',
	            'file_name' => $name
	        ], 200);
	    } else {
	        // Si no se encuentra ningún archivo PDF en la solicitud, devolver un mensaje de error
	        return response()->json([
	            'message' => 'No se proporcionó ningún archivo PDF para subir'
	        ], 400);
	    }
	}
	public function show_vouchers()
	{
	    $user_id = Auth::id();
	    // Buscar los vouchers asociados al usuario
	    $vouchers = Facturas::where('user_id', $user_id)->get();
	
	    // Devolver la vista con los vouchers encontrados
	    return view('admin_funciones_new.vista_cliente', ['vouchers' => $vouchers]);
	}

}
