<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\FondoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FondoClientesController;
use App\Http\Controllers\SuscriptorInfo;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SubscriptorDataController;
use App\Http\Controllers\BankViewsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ShowStatsController;
use App\Http\Controllers\FondoGeneralController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/pgadmin', function() {
    abort(404);
});

// landing_page
Route::get('/', function () {
    return view('landing_site');
})->name('welcome');


Route::get('/registration', function () {
    return view('/registration/registration');
})->name('registration');

Auth::routes();

Route::get('/start', [HomeController::class, 'start'])->name('start');

Route::post('/mail/sendmail', [HomeController::class, 'sendmail'])->name('send.mail');

$roles = [
    'admin' => 1,
    'suscriptor' => 2,
    'client' => [3, 4], // Roles múltiples
];

Route::middleware(['auth'])->group(function() {
    // home routes
    /* 
    |                                                      |
    |                                                      |
    |               manejo de rutas group                  |
    |                                                      |
    |                                                      |
    */
    Route::middleware('role:1')->group(function(){
        // home admin

        Route::get('/admin/home',[HomeController::class,'homeAdmin'])->name('admin.home');

        //profiles / Verified / KYC / DESTROY / 
        
        Route::resource('profiles', App\Http\Controllers\ProfileController::class);
        Route::get('/profiles/{id}/edit', function ($id) {
            return redirect()->route('show-form-pdf');
        })->name('profiles.edit');
        Route::post('/upload-file', [ProfileController::class, 'upload_file'])->name('upload_file');
        Route::delete('/profiles/mass-destroy', [ProfileController::class, 'massDestroy'])->name('profiles.massDestroy');

        //payments 

        //index
        // Route::resource('payments',PaymentController::class);
        Route::get('payments_admin',[PaymentController::class,'index'])->name('payments.index_admin');

        Route::get('payments/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::post('payments/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.update.status');

        //fondos
        
        Route::get('table-fondo/fondo-select',[FondoController::class,'get_payments'])->name('adminSelect');
        Route::post('update-fondo-general', [FondoGeneralController::class, 'updateTotalAmount'])->name('fondo-general.update');

        Route::get('fondo-table',function(){
            return view('admin_funciones_new.tableFondos');
        });
        // FONDOS NEW 
        // Route::get('table-fondo/edit',[FondoController::class , 'editFondo'])->name('editFondo');
        Route::get('/table-fondo/edit/{id}', [FondoController::class, 'editFondo'])->name('fondo.edit');
        // edit currencies
        Route::post('/table-fondo/edit/{id}/update-invested-currencies', [FondoController::class, 'updateInvestedCurrencies'])->name('fondos.update-invested-currencies');

        Route::post('/table-fondo/edit/{id}/update-add-payments', [FondoController::class, 'editUpdateFondo'])->name('fondos.update-add-payments');

        Route::post('/create-fondo', [FondoController::class,'createFondo'])->name('create.fondo');
        Route::get('table-fondo',[FondoController::class,'view_fondos'])->name('tableFondos');

        // Route::post('update-fondo-general', [FondoController::class, 'updateGanancia'])->name('fondos.update-ganancia');
        Route::post('/table-fondo/edit/{id}/update-investing',[FondoController::class,'updateGanancia'])->name('fondos.update-ganancia');

        
    
        Route::resource('contracts', App\Http\Controllers\ContractController::class);
        Route::get('/contract_pdf/{id}', [App\Http\Controllers\ContractController::class, 'contract_pdf'])->name('contracts.pdf');
        Route::get('/declaracion_pdf/{id}',[App\Http\Controllers\ContractController::class, 'declaracion'])->name('declaracion.pdf');

        //insurance 

        Route::get('/insurancesAdmin',[App\Http\Controllers\InsuranceController::class,'index_admin'])->name('insurance.admin');
        Route::get('/insurancesAdmin/{id}', [App\Http\Controllers\InsuranceController::class, 'show'])->name('insurance.show');
        Route::post('/insurancesAdmin/{id}/update', [App\Http\Controllers\InsuranceController::class, 'updateStatus'])->name('insurance.updateStatus');



    });

    //suscriptor
    Route::middleware('role:2')->group(function(){
        // home 

        Route::get('/suscriptor/home',[HomeController::class,'homeSuscriptor'])->name('suscriptor.home');
        // Verificacion
        Route::get('/profiles/user/data',[ProfileController::class,'edit2'])->name('user.profile_edit');
        Route::post('/profiles/user/data/{id}', [ProfileController::class, 'update2'])->name('profiles.update2');
        // Clientes    
        Route::get('/dataCliente/{id}',[SuscriptorInfo::class,'detailCliente'])->name('detailCliente');
        Route::get('/dataCliente',[SuscriptorInfo::class,'tableClientes'])->name('tableClientes');
        // historial
        // Pagos  / retiros
    });
    
    //cliente normal
    Route::middleware(['role:3'])->group(function(){

        // home client
        Route::get('/user/home',[HomeController::class,'homeUsers'])->name('user.home');
        
        //profile
        Route::get('/profiles/user/data',[ProfileController::class,'edit2'])->name('user.profile_edit');
        Route::post('/profiles/user/data/{id}', [ProfileController::class, 'update2'])->name('profiles.update2');
        
        //insurance
        Route::post('/upload-insurance', [ProfileController::class, 'upload_insurance'])->name('profiles.upload_insurance');

        //payments
        Route::get('payments',[PaymentController::class,'index_user'])->name('payments.index_user');

        Route::get('payments/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::get('/payments/client/data', [PaymentController::class, 'client_index'])->name('clients.index');
        Route::get('/payments/select/plan', [PaymentController::class, 'select_plan'])->name('payment.plan');
        Route::get('/payments/client/pay/{id}', [PaymentController::class, 'plan_detail'])->name('payment.detail');
        Route::post('/payments/client/payment', [PaymentController::class, 'client_pay'])->name('client.payment');
        Route::post('/payments/{id}/edit-payment', [PaymentController::class, 'editPayment'])->name('payments.editPayment');


        Route::resource('contracts', App\Http\Controllers\ContractController::class);
        Route::get('/contract_pdf/{id}', [App\Http\Controllers\ContractController::class, 'contract_pdf'])->name('contracts.pdf');
        Route::get('/declaracion_pdf/{id}',[App\Http\Controllers\ContractController::class, 'declaracion'])->name('declaracion.pdf');

        //seguros 
        Route::get('insurances/plans', [App\Http\Controllers\InsuranceController::class,'showInsurancePlans'])->name('insurance.plans');
        Route::post('insurances/store', [App\Http\Controllers\InsuranceController::class, 'insurance_pay'])->name('insurance.store');
        Route::get('insurances/create',[App\Http\Controllers\InsuranceController::class,'create'])->name('insurance.create');
        Route::get('insurances/create/pay',[App\Http\Controllers\InsuranceController::class,'pay'])->name('insurance.pay');
        Route::get('insurances',[App\Http\Controllers\InsuranceController::class,'index'])->name('insurance.index');
        // Route::resource('insurances', App\Http\Controllers\InsuranceController::class);

    });

    //cliente business
    Route::middleware(['role:4'])->group(function(){
        // home client
        Route::get('/user/home',[HomeController::class,'homeUsers'])->name('user.home');
        //profile
        Route::get('/profiles/user/data',[ProfileController::class,'edit2'])->name('user.profile_edit');
        Route::post('/profiles/user/data/{id}', [ProfileController::class, 'update2'])->name('profiles.update2');
        //payments

        Route::get('payments',[PaymentController::class,'index_user'])->name('payments.index_user');
        Route::get('/payments/client/data', [PaymentController::class, 'client_index'])->name('clients.index');
        Route::get('/payments/select/plan', [PaymentController::class, 'select_plan'])->name('payment.plan');
        Route::get('/payments/client/pay/{id}', [PaymentController::class, 'plan_detail'])->name('payment.detail');
        Route::post('/payments/client/payment', [PaymentController::class, 'client_pay'])->name('client.payment');

        Route::resource('contracts', App\Http\Controllers\ContractController::class);
        Route::get('/contract_pdf/{id}', [App\Http\Controllers\ContractController::class, 'contract_pdf'])->name('contracts.pdf');
        Route::get('/declaracion_pdf/{id}',[App\Http\Controllers\ContractController::class, 'declaracion'])->name('declaracion.pdf');

    });

    //gerente->suscriptor
    Route::middleware('role:5')->group(function(){
        // home 
        // verificacion
        // suscriptores
        // historial
        // Pagos / retiros

    });

    //verificador
    Route::middleware('role:6')->group(function(){
        // home 
        // Verificar - Usuarios
        // Pagos

    });

    //banco
    Route::middleware('role:8')->group(function(){
        // home banco


    });

    Route::resource('home',HomeController::class);
    Route::get('/home');
    Route::get('/get-fondo-data/{id}', [HomeController::class, 'getFondoData']);



    Route::post('/client/update_signature/{id}', [PaymentController::class, 'client_update_signature'])->name('client.update_signature');

    // descargar documentos 
    Route::get('/dataAdmin/{id}', [SuscriptorInfo::class, 'downloadDocuments'])->name('download.documents');
    // 


    Route::get('/dataAdmin',[SuscriptorInfo::class,'tableAdmin'])->name('detalles');
    Route::get('/dataSuscriptor/{id}',[SuscriptorInfo::class,'detailSuscriptor'])->name('detailSuscriptor');

    Route::get('/dataSuscriptor',[SuscriptorInfo::class,'tableSuscriptors'])->name('tableSuscriptor');
    Route::resource('users', App\Http\Controllers\UserController::class);




    
    Route::get('/invite/user/link', [App\Http\Controllers\UserController::class, 'generateInviteLink'])->name('invite.user');

    Route::post('/invite/link/store', [App\Http\Controllers\UserController::class, 'link'])->name('users.link');
    Route::post('/send_invitation', [App\Http\Controllers\UserController::class, 'send_invitation'])->name('invitation');

    Route::get('/suscriptor/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationSuscriptor'])->name('users.register.susp');
    Route::get('/cliente/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationClient'])->name('users.register.client');

    Route::get('/confirmation-email/{token}', [App\Http\Controllers\UserController::class, 'confirmationEmail'])->name('user.confirmationEmail');

    Route::resource('notifications', App\Http\Controllers\NotificationController::class);
    Route::get('/rejection-history/{user_id}', [App\Http\Controllers\RejectionHistoryController::class, 'rejectionHistory'])->name('rejectionHistory');
    Route::get('/rejection-history-show/{id}', [App\Http\Controllers\RejectionHistoryController::class, 'show'])->name('rejectionHistory.show');
    Route::get('/dashboard', [App\Http\Controllers\EventController::class, 'allEvents'])->name('dashboard');
    Route::get('bells/bells', [App\Http\Controllers\BellsController::class, 'bells'])->name('bells.bells');

    Route::get('images/{filename}', function ($filename) {
        $path = storage_path() . '/images/' . $filename;
        if (!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });


    Route::resource('plans', App\Http\Controllers\PlanController::class);
    Route::resource('clientPayments', App\Http\Controllers\ClientPaymentController::class);

    Route::get('/showUsers', [BankViewsController::class, 'showUsers'])->name('showUsers');
    Route::get('/show-form-pdf', [PdfController::class, 'create'])->name('pdfUpload');
    Route::post('/pdf-upload-store', [PdfController::class, 'store'])->name('pdf-upload-store');
    Route::get('/show-pdf', [PdfController::class, 'show'])->name('showproduct');
    Route::get('/view-pdf/{id}', [PdfController::class, 'view'])->name('viewproduct');


    
    // Route::get('/home', [HomeController::class, 'showClientHistory'])->name('home');
    // Route::get('/home/{userId}', [HomeController::class, 'dataUsers'])->name('home');

    // ******************Facturas***********************
    Route::get('/facturas', [FacturasController::class, 'show_index'])->name('admin_funciones.fondos');
    Route::post('/facturas/{id}/store-voucher', [FacturasController::class, 'store_voucher'])->name('facturas.store_voucher');
    Route::get('/vouchers', [FacturasController::class, 'show_vouchers'])->name('vouchers.show');

    Route::get('payment/pdf', [PaymentController::class, 'pdf'])->name('pdf');
    Route::get('/payments/client/pay/{id}/contrato-pdf', [PaymentController::class, 'pdf'])->name('pdf');

    Route::get('payment/declaracion',[PaymentController::class, 'declaracion'])->name('declaracion');


    Route::get('/view-product/{id}', [BankViewsController::class, 'view'])->name('viewproduct');
    Route::get('/subscriptor-data', [SubscriptorDataController::class, 'index'])->name('subscriptor.data.index');
// tableFondos
    Route::post('/logout',function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');
    Route::get('/home-gerente',[HomeController::class,'gerenteHome'])->name('gerente.home');

    // Suscriptor Historial
    Route::get('/historial-suscriptor',[HistorialController::class,'dataHistorial'])->name('Historial');

});


Route::get('/testing',function(){
    return view('test');
})->name('test');

Route::get('/api/data',[ApiController::class,'getData']);
// Fallback route for session timeout redirection
Route::fallback(function () {
    return redirect()->route('login');
});

Route::get('/newFront',function(){
    return view('newFront');
})->name('newFront');

