<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Models\Payment;
use App\Repositories\ContractRepository;
use App\Models\Profile;
use App\Models\SubscriptorDataModel;
use App\Models\Contract;
use App\Models\Plan;
use App\Models\Declaraciones;
use App\Models\User;
use App\Models\ClientPayment;
use App\Http\Controllers\AppBaseController;
use App\Http\Interfaces\BinanceTransferInterface;
use App\Http\Requests\ClientPaymentRequest;
use App\Http\Services\BinanceQRGeneratorService;
use App\Http\Services\BinanceTransferMoneyToClientsService;
use App\Http\Services\BinanceTransferMoneyToSubscribersService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Traits\BinanceMoneySplitterTrait;
use App\Traits\BinanceDoughSenderTrait;
use App\Traits\BinanceBalanceCheckerTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuscriptorHistorial;


//use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Storage;

use Flash;
use DB;
use dd;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use Response;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;
    private $contractRepository;
    protected ?BinanceTransferInterface $transfer;

    public function __construct(PaymentRepository $paymentRepo, ContractRepository $contractRepo)
    {
        $this->paymentRepository = $paymentRepo;
        $this->contractRepository = $contractRepo;
        $this->transfer = null;

        // Middleware para inicializar $this->user
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $payments = $this->paymentRepository->all();
        // dd($payments) ;

        return view('payments_new.index')->with(compact('payments'));
    }

    public function index_user(Request $request)
    {
        $user=Auth::user();

        $payments = Payment::where('user_id',$user->id);


        return view('payments_new.index')
            ->with('payments', $payments);
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Response
     */
    public function create()
    {
        return view('payments_new.create');
    }

    /**
     * Store a newly created Payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();
	    $input["date_transaction"] = Carbon::now()->format('Y-m-d H:i:s'); // Formatear la fecha con horas, minutos y segundos

        $payment = $this->paymentRepository->create($input);

        Flash::success('Payment saved successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }
        

        return view('payments_new.index')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }
        return view('payments_new.edit',compact('payment'));
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param int $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $payment = $this->paymentRepository->update($request->all(), $id);

        Flash::success('Payment updated successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        $this->paymentRepository->delete($id);

        Flash::success('Payment deleted successfully.');

        return redirect(route('payments.index'));
    }

    /**
     * Display a listing of the Payment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index2(Request $request)
    {
        $user = Auth::user();

        $payments = $user
                  ->payments()
                  ->with('contract')
                  ->get();

        $current = null;
        $total = 200;

        //TODO this must be better implemented
        $lastPaidPayment = $user->payments()
                            ->lastPayment()
                            ->isPaid()
                            ->first();

        $lastPendingPayment = $user->payments()
                            ->lastPayment()
                            ->isPending()
                            ->first();


        if ($lastPaidPayment){
            $current = true;
            $message = "No puedes hacer mas pagos hasta " . $lastPaidPayment->expiration_date;
            Flash::error($message, 'message');
        };

        if($lastPendingPayment){
            $current = true;
            $message = "Tiene un estado de pago en PENDIENTE";
            Flash::error($message, 'message');
        };
        return view('payments_new.index2')
        ->with(compact('payments', 'current', 'total'));
    }

    public function generateQR($data)
    {
        $env = \config('app');
        $ngrok = \config('binance.ngrok');

        //IMPORTANT
        if ($env["env"] == 'local' && $env["url"] == "http://localhost:8000") {
            $binanceQR = new BinanceQRGeneratorService($data, $ngrok);
            $binanceQR->generate();
        }
        else {
            $binanceQR = new BinanceQRGeneratorService($data, $env["url"]);
            $binanceQR->generate();
        }

        // return $this->sendResponse(($binanceQR->getResponse()), 200);
        return $binanceQR->getResponse();
    }

    public function client_index(Request $request){
        $input = $request->all();
        $payments=Payment::with(['clientPayments'])->where("user_id",$this->user->id)->orderBy('created_at','desc')->get();
        



        // $payments = $this->paymentRepository->all();
        // $payments = Payment::where("user_id", Auth::user()->id)
        //           ->with('contract')
        //           ->with('declaracion')
        //           ->with('client_payment')
        //           ->when( (isset($input['plan']) && $input['plan']!= 0) , function($query) use ($input){
        //               return $query->whereHas('client_payment', function($query2) use ($input) {
        //                   $query2->where('plan_id',$input['plan']);
        //               });
        //           })
        //           ->when( (isset($input['year']) && is_numeric($input['year'])) , function ($query) use ($input) {
        //               return $query->whereBetween('created_at',[$input['year'].'-01-01 00:00:00',$input['year'].'-12-31 23:59:59']);
        //           })
        //           ->when( (isset($input['funds']) && $input['funds'] != 0), function ($query) use ($input) {
        //               $months = [
        //                   1 => 'Enero',
        //                   2 => 'Febrero',
        //                   3 => 'Marzo',
        //                   4 => 'Abril',
        //                   5 => 'Mayo',
        //                   6 => 'Junio',
        //                   7 => 'Julio',
        //                   8 => 'Agosto',
        //                   9 => 'Setiembre',
        //                   10 => 'Octubre',
        //                   11 => 'Noviembre',
        //                   12 => 'Diciembre'
        //               ];
        //               return $query->where('month',$months[$input['funds']]);
        //           } )
        //           ->get()
        //           ->map(function ($payment) {
        //             // Formateamos la fecha con minutos y segundos en el formato Y-m-d H:i:s
        //             $payment->formatted_date = $payment->created_at->format('Y-m-d H:i:s');
        //             return $payment;
        //         })
        //           ->sortBy(function ($payment) {
        //               switch ($payment->status) {
        //                   case 'PENDIENTE':
        //                       return 1;
        //                   case 'PAGADO':
        //                       return 2;
        //                   case 'VENCIDO':
        //                       return 3;
        //                   default:
        //                       return 4;
        //               }
        //           });
        // $plans = Plan::pluck('name','id')->toArray();

        return view('payments_new.index')
            ->with(compact('payments'));
    }

    public function client_update_signature(Request $request, $id)
    {
        // Obtener el pago asociado por su ID
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['error' => 'Pago no encontrado.'], 404);
        }
    
        // Obtener el perfil del usuario asociado al pago
        $profile = Profile::where('user_id', $payment->user_id)->first();
        if (!$profile) {
            return response()->json(['error' => 'Perfil no encontrado.'], 404);
        }
    
        // Procesar la imagen si existe en la solicitud
        $fileName = null;
        if ($request->has('canvas_image')) {
            $imageData = $request->input('canvas_image');
            $imageParts = explode(";base64,", $imageData);
            if (count($imageParts) > 1) {
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = 'signatures/' . uniqid() . '.png'; // Ruta para guardar la firma
                Storage::disk('public')->put($fileName, $imageBase64); // Guardar la imagen en disco
            } else {
                return response()->json(['error' => 'Formato de imagen inválido.'], 400);
            }
        }
    
        // Crear o actualizar el contrato asociado al pago
        $contractData = [
            'user_id' => $profile->user_id,
            'type' => 2,
            'full_name' => $profile->first_name . ' ' . $profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'signature_image' => $fileName, // Guardar la imagen si existe
            'payment_id' => $payment->id
        ];
    
        $contract = Contract::updateOrCreate(
            ['payment_id' => $payment->id], // Buscar contrato por payment_id
            $contractData
        );
    
        // Crear o actualizar la declaración asociada al pago
        $declarationData = [
            'user_id' => $profile->user_id,
            'type' => 2,
            'full_name' => $profile->first_name . ' ' . $profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'signature_image' => $fileName, // Guardar la imagen si existe
            'payment_id' => $payment->id,
            'created_at'=> $contract->created_at
        ];
    
        $declaration = Declaraciones::updateOrCreate(
            ['payment_id' => $payment->id], // Buscar declaración por payment_id
            $declarationData
        );
    
        return response()->json(['success' => 'Firma actualizada correctamente.'], 200);
    }
       
    public function client_detail($id)
    {
        $payment = $this->paymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment not found');

            return redirect(route('payments.index'));
        }

        return view('payments_new.client_detail')->with('payment', $payment);
    }

    public function select_plan()
    {
        $plans = Plan::get();
        return view('payments_new.select_plan')->with(compact('plans'));
    }

    public function plan_detail($id)
    {
        $plan = Plan::find($id);
        return view('payments_new.detail')->with(compact('plan'));
    }

    public function client_pay(ClientPaymentRequest $request)
    {
        $input = $request->all();

        $months = [
            0 => 'Diciembre',
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Setiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
             // Procesar y guardar la imagen del canvas
        if ($request->has('canvas_image')) {
            $imageData = $request->input('canvas_image');
            $imageParts = explode(";base64,", $imageData);
            $imageBase64 = base64_decode($imageParts[1]);
            $fileName = 'signatures/' . uniqid() . '.png'; // Ruta de guardado en 'storage/app/public/signatures'
            // Guardar la imagen en el almacenamiento de Laravel (public disk)
            Storage::disk('public')->put($fileName, $imageBase64);
            // Asignar la ruta de la imagen al campo 'signature_image'
            $input['signature_image'] = $fileName;
        }

        $currentDate = Carbon::now();
        $dayOfMonth = (int)$currentDate->format('d');
        $currentMonth = (int)$currentDate->format('m');
        $month = $months[($dayOfMonth >= 28 ? ($currentMonth + 1) % 12 : $currentMonth)];
        $input["month"] = $month;
	    $input["user_name"]=Auth::user()->name;
        $input["total"] = $input["amount"];
        //$input["date_transaction"] = Carbon::parse()->format('Y-m-d');
        $input["name"] = $input["month"];
        $input["details"] = $input["month"];
	    $filePath='vouchers/';
	    if ($request->hasFile('voucher_picture')) {
		    if (!file_exists(storage_path($filePath))) {
                	Storage::makeDirectory('public/'.$filePath, 0777, true);
            	}
		    $name=uniqid().'.'.$request->file('voucher_picture')->getClientOriginalExtension();
		    $path=$filePath.$name;
		    $request->file('voucher_picture')->storeAs('public/'.$filePath,$name);
		    $input["voucher_picture"] = '/storage/vouchers/' . $name;
        }else{
            $input["voucher_picture"]="noimgadded";
        }  	

        $input["user_id"] = Auth::user()->id;

        $input["date_transaction"] = Carbon::now()->format('Y-m-d H:i:s');

        $payment = $this->paymentRepository->create($input);

        $profile = Profile::where('user_id',$payment->user_id)->first();
        $contract = [
            'user_id' => $profile->user_id,
            'type' => 2,
            'full_name' => $profile->first_name.' '.$profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'signature_image' => $fileName, // Usar la ruta guardada
            'payment_id' => $payment->id
        ];
        
	    $contract = Contract::create($contract);

        $declaraciones = Declaraciones::create([
            'user_id' => $profile->user_id,
            'type' => 2,
            'full_name' => $profile->first_name.' '.$profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'signature_image' => $fileName, // Usar la ruta guardada
            'payment_id' => $payment->id

        ]);

        $declaraciones->touch();
        $referred_user = Auth::user()->refered_code;

        $client_payment = [
            'user_id' => $profile->user_id,
            'payment_id' => $payment->id,
            'referred_code' => $referred_user ,
            'plan_id' => $input['plan_id'],
	        'code' => uniqid(),
	        'total'=>$input['total'],
        ];


            // Buscar el usuario que refirió
        $referredUser = User::where('unique_code', Auth::user()->refered_code)->first();
        if(!empty($referred_user))
        {
            $client_payment['referred_user_id'] = $referredUser->id;
        }

        ClientPayment::create($client_payment);



	    return redirect()->back()->with('success'); 
    }

    public function updateStatus($id, Request $request)
    {
        $payment = Payment::findOrFail($id);
        $clientPayment = ClientPayment::where('payment_id', $payment->id)->first();
    
        // Validaciones de entrada
        $request->validate([
            'comments_on_payment' => 'nullable|string|max:255',
            'status' => 'required|string|in:Pagado,Rechazado,Revision',
            'voucher_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'comprobante' => 'nullable|mimes:pdf|max:2048',
        ]);
    
        DB::transaction(function () use ($payment, $clientPayment, $request) {
            // Actualizar el estado y comentarios del pago
            $payment->status = $request->input('status');
            $payment->comments_on_payment = $request->input('comments_on_payment');
    
            // Manejar la subida de `voucher_picture`
            if ($request->hasFile('voucher_picture')) {
                // Eliminar el archivo anterior si existe
                if ($payment->voucher_picture) {
                    Storage::delete('public/' . $payment->voucher_picture);
                }
    
                // Guardar el nuevo archivo
                $filePath = 'vouchers/';
                $fileName = uniqid() . '.' . $request->file('voucher_picture')->getClientOriginalExtension();
                $request->file('voucher_picture')->storeAs('public/' . $filePath, $fileName);
                $payment->voucher_picture = $filePath . $fileName;
            }
    
            
            if ($request->hasFile('comprobante')) {
                // Eliminar archivo anterior si existe
                if ($payment->comprobante) {
                    Storage::delete('public/' . $payment->comprobante);
                }
            
                // Guardar el nuevo archivo
                $filePath = 'vouchers_emitidos/';
                $fileName = uniqid() . '.' . $request->file('comprobante')->getClientOriginalExtension();
                $request->file('comprobante')->storeAs('public/' . $filePath, $fileName);
            
                // Actualizar el modelo con la nueva ruta
                $payment->update(['comprobante'=>$filePath.$fileName]);
            }

    
            $payment->save();
    
            // Actualizar el estado de `ClientPayment` solo si el estado es "Pagado"
            if ($clientPayment) {
                $clientPayment->status = $payment->status === "Pagado" ? 1 : 0;
                $clientPayment->save();
            }
    
            // Procesar notificaciones y lógica según el estado
            switch ($payment->status) {
                case "Pagado":
                    $this->actualizarMembresias($payment);
                    Notification::create([
                        'user_id' => $payment->user_id,
                        'title' => 'Pago del ' . $payment->created_at->format('Y-m-d'),
                        'body' => "Su pago ha sido procesado con éxito.",
                    ]);
                    break;
    
                case "Rechazado":
                    Notification::create([
                        'user_id' => $payment->user_id,
                        'title' => 'Pago del ' . $payment->created_at->format('Y-m-d'),
                        'body' => "Su pago ha sido rechazado.",
                    ]);
                    break;
    
                case "Revision":
                    Notification::create([
                        'user_id' => $payment->user_id,
                        'title' => 'Pago del ' . $payment->created_at->format('Y-m-d'),
                        'body' => "Su pago está en revisión. Vaya a 'Depositar' y en su pago seleccione 'Ver Detalle'.",
                    ]);
                    break;
    
                default:
                    break;
            }
        });
    
        return redirect()->route('payments.index')->with('success', 'Estado del pago actualizado con éxito.');
    }
    
    

    public function actualizarMembresias($payment)
    {
        $dataSuscriptor = [1 => 14, 2 => 35, 3 => 70, 4 => 84, 5 => 140];
        $dataGerente = [1 => 4, 2 => 10, 3 => 20, 4 => 24, 5 => 40];
        $dataAdmin = [1 => 6, 2 => 15, 3 => 30, 4 => 36, 5 => 60];
        $dataAdminNew = [1 => 24, 2 => 60, 3 => 120, 4 => 144, 5 => 240];
        $dataAdminRef = [1 => 10, 2 => 25, 3 => 50, 4 => 60, 5 => 100];

        DB::transaction(function () use ($payment, $dataSuscriptor, $dataGerente, $dataAdmin, $dataAdminNew, $dataAdminRef) {
            $clientPayment = ClientPayment::where('payment_id', $payment->id)->first();
            $user = User::findOrFail($payment->user_id);
            $clientProfile = Profile::where('user_id', $user->id)->firstOrFail();
            $referredCode = $user->refered_code;
            $userReferee = User::where('unique_code', $referredCode)->first();

            if ($referredCode === "aeia") {
                SuscriptorHistorial::create([
                    'name' => $clientProfile->first_name,
                    'refered_code' => 'aeia',
                    'plan_id' => $clientPayment->plan_id,
                    'user_id' => $user->id,
                    'membership_collected' => $dataAdminNew[$clientPayment->plan_id]
                ]);

                SubscriptorDataModel::where('user_table_id', $userReferee->id)
                    ->increment('membership_collected', $dataAdminNew[$clientPayment->plan_id]);
            } else {
                $this->procesarMembresiasSuscriptor($user, $clientPayment, $dataSuscriptor, $dataGerente, $dataAdmin, $dataAdminRef);
            }
        });
    }

    private function procesarMembresiasSuscriptor($user, $clientPayment, $dataSuscriptor, $dataGerente, $dataAdmin, $dataAdminRef)
    {
        $suscriptor = User::where('unique_code', $user->refered_code)->first();
        $clientProfile = Profile::where('user_id', $user->id)->first();
        $planId = $clientPayment->plan_id;

        SuscriptorHistorial::create([
            'name' => $clientProfile->first_name,
            'refered_code' => $user->refered_code,
            'plan_id' => $planId,
            'user_id' => $user->id,
            'membership_collected' => $dataSuscriptor[$planId]
        ]);

        SubscriptorDataModel::where('user_table_id', $suscriptor->id)
            ->increment('membership_collected', $dataSuscriptor[$planId]);

        if ($suscriptor->refered_code !== 'aeia') {
            $this->procesarMembresiasGerente($suscriptor, $clientPayment, $dataGerente, $dataAdminRef);
        }
    }

    private function procesarMembresiasGerente($suscriptor, $clientPayment, $dataGerente, $dataAdminRef)
    {
        $suscriptorData = User::where('unique_code', $suscriptor->refered_code)->first();
        $gerenteName = Profile::where('user_id', $suscriptorData->id)->first();

        SuscriptorHistorial::create([
            'name' => $gerenteName->first_name,
            'refered_code' => $suscriptorData->unique_code,
            'plan_id' => $clientPayment->plan_id,
            'user_id' => $suscriptor->id,
            'membership_collected' => $dataAdminRef[$clientPayment->plan_id]
        ]);

        SubscriptorDataModel::where('user_table_id', $suscriptorData->id)
            ->increment('membership_collected', $dataAdminRef[$clientPayment->plan_id]);
    }


    public function pay(Request $request)
    {
        $input = $request->all();
        $input["user_id"] = Auth::user()->id;
        $input["date_transaction"] = Carbon::now();
    
        $expireTime = Carbon::now()->addDays(15);
        $input["expire_time"] = $expireTime;
        $input['month'] = 'annual_subscription';
    
        $payment = $this->paymentRepository->create($input);
    
    
        $profile = Profile::where('user_id', $payment->user_id)->first();
        $contract = [
            'user_id' => $profile->user_id,
            'type' => 1,
            'full_name' => $profile->first_name . ' ' . $profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'signature_image' => $fileName, // Usar la ruta guardada
            'payment_id' => $payment->id
        ];

        $contract = Contract::create($contract);
    
        return redirect()->back()->with('success', 'Pago realizado con éxito');
    }
    

    public function webhook(Request $request){
        $input = $request->input();
        $data = json_decode($input["data"]);
        try {
            $payment = Payment::where("prepay_code", $input["bizIdStr"])->first(); //use bizIdStr please

            if ($input["bizStatus"] == "PAY_SUCCESS" && $payment->status == "PENDIENTE"){
                $payment->status = "PAGADO";
                $payment->transact_code = $data->transactionId;

                $transactTime = Carbon::createFromTimestamp($data->transactTime/1000)->format("Y-m-d H:i:s");
                $payment->transact_timestamp = $transactTime;

                if ($payment->user->rol === 2) {
                    $payment->update([
                        'expiration_date' => $payment->date_transaction->addYear(1),
                    ]);
                }

                $payment->save();
                $payment->refresh();

                if($payment->month !== "annual_subscription"){
                    $transfer = new BinanceTransferMoneyToClientsService($payment);
                }else{
                    $transfer = new BinanceTransferMoneyToSubscribersService($payment);
                }
                BinanceMoneySplitterTrait::split($transfer);
            }
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

   
    
    public function updateComments(Request $request, $id){
	    $payment=Payment::findOrFail($id);
	    $request->validate(['comments_on_payment'=>'nullable|string|max:255',]);
	    $payment->comments_on_payment=$request->input('comments_on_payment');
	    $payment->update(['comments_on_payment' => $request->input('comments_on_payment')]);
	    return redirect()->route('payments.index');
	    
		
    }
    public function pdf(Request $request,$id){
	    $user=Auth::user();
	    $profile=Profile::where('user_id',$user->id)->first();
	    $pdf=Pdf::loadView('pdf',compact('profile'));
	    return $pdf->stream();
    }

    public function declaracion(){
        $user=Auth::user();
        $profile=Profile::where('user_id',$user->id)->first();
        // $

        $pdf=Pdf::loadview('declaracionVoluntaria',compact('profile','user'));
        return  $pdf->stream();
    }

    public function editPayment($id, Request $request)
    {
        $payment = Payment::find($id);
        $input = $request->all();
        
        // Elimina el archivo de imagen anterior si existe
        if ($payment->voucher_picture) {
            Storage::delete('public/' . $payment->voucher_picture);
        }
    
        // Verifica si hay un nuevo archivo de imagen cargado
        if ($request->hasFile('voucher_picture')) {
            $filePath = 'vouchers/';
            if (!Storage::exists($filePath)) {
                Storage::makeDirectory($filePath, 0777, true);
            }
            
            // Genera un nombre único para el archivo
            $name = uniqid() . '.' . $request->file('voucher_picture')->getClientOriginalExtension();
            $path = $filePath . $name;
            $request->file('voucher_picture')->storeAs('public/' . $filePath, $name);
            $input["voucher_picture"] = 'vouchers/' . $name; // Corrige la ruta de almacenamiento
        }
    
        // Actualiza el registro del pago con la nueva imagen
        $payment->update([
            'voucher_picture' => $input["voucher_picture"]
        ]);
    
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }
}