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
	// public function show_index(Request $request){
	// 	$payments=$this->paymentRepository->all();
	// 	if(empty($payments)){
	// 		Flash::error('no hay pagos');
	// 	}
	// 	return view('admin_funciones_new.facturas')->with('payments',$payments);
	// }

	public function show_index()
	{
		// Obtener los ClientPayment donde fondo_name es null y rescue_money es false
		$clientPayments = ClientPayment::whereNotNUll('fondo_name')	
			->pluck('payment_id');
	
		// Obtener los pagos asociados a los ClientPayment anteriores con estado 'PAGADO'
		$payments = Payment::whereIn('id', $clientPayments)
			->where('status', 'PAGADO')
			->get();
	
		// dd($payments); // Verificar los datos
	
		return view('admin_funciones_new.facturas', compact('payments'));
	}
	 

	public function store_voucher(Request $request, $id)
	{
		// Encontrar el ClientPayment por id
		$ClientPayment = ClientPayment::findOrFail($id);
	
		// Verificar si hay un archivo PDF en la solicitud
		if ($request->hasFile('pdf_file')) {
			// Crear el directorio si no existe
			$filePath = 'Facturas/';
			if (!Storage::exists('public/' . $filePath)) {
				Storage::makeDirectory('public/' . $filePath, 0777, true);
			}
	
			// Generar un nombre único para el archivo PDF
			$name = uniqid() . '.' . $request->file('pdf_file')->getClientOriginalExtension();
			// Ruta completa donde se guardará el archivo PDF
			$path = $filePath . $name;
	
			// Almacenar el archivo PDF
			$request->file('pdf_file')->storeAs('public/' . $filePath, $name);
	
			// Obtener el pago relacionado
			$payment = Payment::findOrFail($ClientPayment->payment_id);
	
			// Crear la factura asociada al pago
			$facturaCreada = Facturas::create([
				'route_path' => '/storage/' . $path,
				'user_name' => $payment->user->name,
				'user_id' => $payment->user_id,
				'fondo_name' => $ClientPayment->fondo_name,
				'plan_id' => $ClientPayment->plan_id,
				'total' => $payment->total,
			]);
		}
	
		return redirect()->route('admin_funciones.fondos')->with('success', 'PDF subido exitosamente');
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
