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
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use Response;

class PaymentController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;
    private $contractRepository;
    protected ?BinanceTransferInterface $transfer;

    public function __construct(PaymentRepository $paymentRepo,ContractRepository $contractRepo)
    {
        $this->paymentRepository = $paymentRepo;
        $this->transfer = null;
	$this->contractRepository=$contractRepo;
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

        return view('payments_new.show')->with('payment', $payment);
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

        return view('payments_new.edit')->with('payment', $payment);
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

    public function client_index(Request $request)
    {
        $input = $request->all();

        $payments = $this->paymentRepository->all();
        $payments = Payment::where("user_id", Auth::user()->id)
                  ->with('contract')
                  ->with('client_payment')
                  ->when( (isset($input['plan']) && $input['plan']!= 0) , function($query) use ($input){
                      return $query->whereHas('client_payment', function($query2) use ($input) {
                          $query2->where('plan_id',$input['plan']);
                      });
                  })
                  ->when( (isset($input['year']) && is_numeric($input['year'])) , function ($query) use ($input) {
                      return $query->whereBetween('created_at',[$input['year'].'-01-01 00:00:00',$input['year'].'-12-31 23:59:59']);
                  })
                  ->when( (isset($input['funds']) && $input['funds'] != 0), function ($query) use ($input) {
                      $months = [
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
                      return $query->where('month',$months[$input['funds']]);
                  } )
                  ->get()
                  ->sortBy(function ($payment) {
                      switch ($payment->status) {
                          case 'PENDIENTE':
                              return 1;
                          case 'PAGADO':
                              return 2;
                          case 'VENCIDO':
                              return 3;
                          default:
                              return 4;
                      }
                  });
        $plans = Plan::pluck('name','id')->toArray();

        return view('payments_new.index')
            ->with(compact('payments', 'plans'));
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
        //     $size = $request->file('voucher_picture')->getSize();
        //     $name = $request->file('voucher_picture')->getClientOriginalName();
        //     $request->file('voucher_picture')->storeAs('public/images/', $name);
        //     // ... (rest of your code for photo object and saving)
        //     $photo=new Photo();
        //     $photo->name=$name;
        //     $photo->size=$size;
        //     $photo->save();
        //     $input["voucher_picture"]=$photo->id;

		$name=uniqid().'.'.$request->file('voucher_picture')->getClientOriginalExtension();
		$path=$filePath.$name;
		$request->file('voucher_picture')->storeAs('public/'.$filePath,$name);
		$input["voucher_picture"] = '/storage/vouchers/' . $name;
        }else{
            $input["voucher_picture"]="noimgadded";
        }  	

        //$qr = $this->generateQR($input);
        //if ($qr->status !== "SUCCESS"){
         //   return $this->sendError($qr, 400);
       // }

        $input["user_id"] = Auth::user()->id;

        $input["date_transaction"] = Carbon::now()->format('Y-m-d H:i:s');
        // $input["total"] = number_format($input["total"], 7);
        //$input["prepay_code"] = $qr->data->prepayId;

        //$expireTime = Carbon::createFromTimestamp($qr->data->expireTime / 1000)->format("Y-m-d H:i:s");

        //$input["expire_time"] = $expireTime;
        //$input["qr_url"] = $qr->data->qrcodeLink;

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
            'payment_id' => $payment->id
        ];

	    $contract = Contract::create($contract);

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


    public function pay(Request $request)
    {
        $input = $request->all();
        //$qr = $this->generateQR($input);
        //if ($qr->status !== "SUCCESS"){
         //   return $this->sendError($qr, 400);
        //}


        $input["user_id"] = Auth::user()->id;

        $input["date_transaction"] = Carbon::now();
        // $input["total"] = number_format($input["total"], 7);
        //$input["prepay_code"] = $qr->data->prepayId;

        $expireTime = Carbon::now()->dat(15);

        $input["expire_time"] = $expireTime;

        //$input["qr_url"] = $qr->data->qrcodeLink;
        $input['month'] = 'annual_subscription';

        $payment = $this->paymentRepository->create($input);


        $profile = Profile::where('user_id',$payment->user_id)->first();
        $contract = [
            'user_id' => $profile->user_id,
            'type' => 1,
            'full_name' => $profile->first_name.' '.$profile->lastname,
            'country' => $profile->country,
            'city' => $profile->city,
            'state' => $profile->state,
            'address' => $profile->address,
            'country_document' => $profile->country_document,
            'type_document' => $profile->type_document,
            'identification_number' => $profile->identification_number,
            'code' => uniqid(),
            'payment_id' => $payment->id
        ];

        $contract = Contract::create($contract);
        // Flash::success('Deposito recibido correctamente.');

	    return redirect()->back()->with('success','pago realizado con exito');
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
    public function updateStatus($id)
    {
        $payment = Payment::find($id);
    
        if (!$payment) {
            return response()->json(['error' => 'Pago no encontrado'], 404);
        }
    
        // Actualiza el estado del pago a "PAGADO"
        $payment->status = 'PAGADO';
    
        // Datos de membresías
        $dataSuscriptor = [
            1 => 14, 
            2 => 35, 
            3 => 70, 
            4 => 84, 
            5 => 140
        ];
        $dataGerente = [
            1 => 4  , 
            2 => 10, 
            3 => 20, 
            4 => 24, 
            5 => 40
        ];
        // admin con comision 
        $dataAdmin = [
            1 => 6, 
            2 => 15, 
            3 => 30, 
            4 => 36, 
            5 => 60
        ];
        // admin vende sin comision
        $dataAdminNew = [
            1 => 24, 
            2 => 60, 
            3 => 120, 
            4 => 144, 
            5 => 240
        ];
        $dataAdminRef = [
            1 => 10,
            2 => 25, 
            3 => 50, 
            4 => 60, 
            5 => 100
        ];
        $result = DB::transaction(function () use ($payment, $dataSuscriptor, $dataGerente, $dataAdmin, $dataAdminNew, $dataAdminRef) {
            $payment->update();
    
            // Buscar el registro de ClientPayment asociado al pago
            $clientPayment = ClientPayment::where('payment_id', $payment->id)->first();
            if (!$clientPayment) {
                throw new Exception('ClientPayment no encontrado');
            }
    
            // Buscar el usuario asociado al pago
            $user = User::find($payment->user_id);
            if (!$user) {
                throw new Exception('Usuario no encontrado');
            }
    
            // Obtener el perfil del cliente
            $clientProfile = Profile::where('user_id', $user->id)->first();
            if (!$clientProfile) {
                throw new Exception('Perfil del cliente no encontrado');
            }
    
            $referredCode = $user->refered_code;
            $user_referee = User::where('unique_code', $referredCode)->first();
            if (!$user_referee) {
                throw new Exception('Usuario referenciado no encontrado');
            }
    
            $suscriptorData = [];
            $suscriptorHistorial = [];
    
            if ($referredCode == "aeia") {
                $suscriptorData[] = SuscriptorHistorial::create([
                    'name' => $clientProfile->first_name,
                    'refered_code' => 'aeia',
                    'plan_id' => $clientPayment->plan_id,
                    'user_id' => $user->id,
                    'membership_collected' => $dataAdminNew[$clientPayment->plan_id]
                ]);
                $suscriptorHistorial[] = SubscriptorDataModel::where('user_table_id', $user_referee->id)->update([
                    'membership_collected' => DB::raw("membership_collected + " . $dataAdminNew[$clientPayment->plan_id])
                ]);
            } else {
                $suscriptor = User::where('unique_code', $user->refered_code)->first();
                if (!$suscriptor) {
                    throw new Exception('Suscriptor no encontrado');
                }
                
                $suscriptorData[] = SuscriptorHistorial::create([
                    'name' => $clientProfile->first_name,
                    'refered_code' => $user->refered_code,
                    'plan_id' => $clientPayment->plan_id,
                    'user_id' => $user->id,
                    'membership_collected' => $dataSuscriptor[$clientPayment->plan_id]
                ]);
                
                $suscriptorHistorial[] = SubscriptorDataModel::where('user_table_id', $user_referee->id)->update([
                    'membership_collected' => DB::raw("membership_collected + " . $dataSuscriptor[$clientPayment->plan_id])
                ]);
                
                if ($suscriptor->refered_code != 'aeia') {
                    $suscriptor_data = User::where('unique_code', $suscriptor->refered_code)->first();
                    if (!$suscriptor_data) {
                        throw new Exception('Suscriptor de segundo nivel no encontrado');
                    }
    
                    $suscriptor_name = Profile::where('user_id', $suscriptor->id)->first();
                    if (!$suscriptor_name) {
                        throw new Exception('Nombre del suscriptor no encontrado');
                    }
    
                    $suscriptorDataGerenteHistorial[] = SuscriptorHistorial::create([
                        'name' => $suscriptor_name->first_name,
                        'refered_code' => $suscriptor_data->unique_code,
                        'plan_id' => $clientPayment->plan_id,
                        'user_id' => $suscriptor->id,
                        'membership_collected' => $dataGerente[$clientPayment->plan_id]
                    ]);
    
                    $suscriptorDataGerente[] = SubscriptorDataModel::where('user_table_id', $suscriptor_data->id)->update([
                        'membership_collected' => DB::raw("membership_collected + " . $dataGerente[$clientPayment->plan_id])
                    ]);
    
                    $gerente_name = Profile::where('user_id', $suscriptor_data->id)->first();
                    if (!$gerente_name) {
                        throw new Exception('Nombre del gerente no encontrado');
                    }
    
                    $suscriptorData[] = SubscriptorDataModel::create([
                        'name' => $gerente_name->first_name,
                        'refered_code' => 'aeia',
                        'plan_id' => $clientPayment->plan_id,
                        'membership_collected' => $dataAdmin[$clientPayment->plan_id]
                    ]);
    
                    $admin_code = User::where('unique_code', 'aeia')->first();
                    if (!$admin_code) {
                        throw new Exception('Código de administrador no encontrado');
                    }
    
                    $suscriptorDataGerente[] = SubscriptorDataModel::where('user_table_id', $admin_code->id)->update([
                        'membership_collected' => DB::raw("membership_collected + " . $dataAdmin[$clientPayment->plan_id])
                    ]);
                }else{
                    $suscriptor_data = User::where('unique_code', $suscriptor->refered_code)->first();
                    if (!$suscriptor_data) {
                        throw new Exception('Suscriptor de segundo nivel no encontrado');
                    }
    
                    $suscriptor_name = Profile::where('user_id', $suscriptor->id)->first();
                    if (!$suscriptor_name) {
                        throw new Exception('Nombre del suscriptor no encontrado');
                    }
    
                    $suscriptorDataGerenteHistorial[] = SuscriptorHistorial::create([
                        'name' => $suscriptor_name->first_name,
                        'refered_code' => $suscriptor_data->unique_code,
                        'plan_id' => $clientPayment->plan_id,
                        'user_id' => $suscriptor->id,
                        'membership_collected' => $dataAdminRef[$clientPayment->plan_id]
                    ]);
    
                    $suscriptorDataGerente[] = SubscriptorDataModel::where('user_table_id', $suscriptor_data->id)->update([
                        'membership_collected' => DB::raw("membership_collected + " . $dataAdminRef[$clientPayment->plan_id])
                    ]);
    
                }
            }
        });
        
	    return redirect()->back()->with('success','pago actualizado con exito');
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
            $input["voucher_picture"] = '/storage/vouchers/' . $name; // Corrige la ruta de almacenamiento
        }
    
        // Actualiza el registro del pago con la nueva imagen
        $payment->update([
            'voucher_picture' => $input["voucher_picture"]
        ]);
    
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }
}