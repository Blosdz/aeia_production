<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistorialController;
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


Route::get('/welcome_default', function () {
    return view('welcome_default');
});

Route::get('/', function () {
    return view('newFront');
})->name('welcome');

Route::get('/newHomeFront', function () {
    return view('newHome');
})->name('welcomeNew');

// Route::get('/test1', function () {
//     return view('auth.test1');
// })->name('test');

Route::get('/welcome_default2', function () {
    return view('welcome_default2');
})->name('welcome_default2');

Route::get('/registration', function () {
    return view('/registration/registration');
})->name('registration');

Auth::routes();

Route::get('/start', [HomeController::class, 'start'])->name('start');

Route::post('/mail/sendmail', [HomeController::class, 'sendmail'])->name('send.mail');

Route::middleware(['auth'])->group(function() {

    Route::post('/client/update_signature/{id}', [PaymentController::class, 'client_update_signature'])->name('client.update_signature');

    // descargar documentos 
    Route::get('/dataAdmin/{id}', [SuscriptorInfo::class, 'downloadDocuments'])->name('download.documents');
    // 
    Route::get('/dataCliente/{id}',[SuscriptorInfo::class,'detailCliente'])->name('detailCliente');
    Route::get('/dataAdmin',[SuscriptorInfo::class,'tableAdmin'])->name('detalles');
    ROute::get('/dataCliente',[SuscriptorInfo::class,'tableClientes'])->name('tableClientes');
    Route::get('/dataSuscriptor/{id}',[SuscriptorInfo::class,'detailSuscriptor'])->name('detailSuscriptor');
    Route::get('/dataSuscriptor',[SuscriptorInfo::class,'tableSuscriptors'])->name('tableSuscriptor');
    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::get('profiles/subscribers', [App\Http\Controllers\ProfileController::class, 'indexSubscribers'])->name('profiles.subscribers');
    Route::resource('profiles', App\Http\Controllers\ProfileController::class);
    Route::get('/profiles/data-suscriptor/{id}', [App\Http\Controllers\ProfileController::class, 'data_suscriptor'])->name('data_suscriptor');
    Route::get('/profiles/data-user/{id}', [App\Http\Controllers\ProfileController::class, 'data_user'])->name('data_user');
    Route::get('/profiles/data-gerente/{id}', [App\Http\Controllers\ProfileController::class, 'data_gerente'])->name('data_gerente');



    Route::get('/profiles/user/data', [App\Http\Controllers\ProfileController::class, 'edit2'])->name('profiles.user');
    Route::post('/profiles/user/data/{id}', [App\Http\Controllers\ProfileController::class, 'update2'])->name('profiles.update2');
    Route::get('/profiles/user/verified', [App\Http\Controllers\ProfileController::class, 'verified'])->name('profiles.verified');
    // En routes/web.php
    Route::delete('profiles/delete/{id}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('deleteUser');


    Route::resource('payments', PaymentController::class);
    Route::put('payments/{payment}/updatecomment', [PaymentController::class, 'updateComments'])->name('payments.update.comments');
    Route::get('/payments/user/data', [PaymentController::class, 'index2'])->name('payments.index2');
    Route::post('/payments/user/pay', [PaymentController::class, 'pay'])->name('payments.pay');
    Route::get('/payments/client/data', [PaymentController::class, 'client_index'])->name('clients.index');
    Route::post('/payments/client/data', [PaymentController::class, 'client_index'])->name('clients.filter');
    Route::get('/payments/select/plan', [PaymentController::class, 'select_plan'])->name('payment.plan');
    Route::get('/payments/client/pay/{id}', [PaymentController::class, 'plan_detail'])->name('payment.detail');
    Route::post('/payments/client/payment', [PaymentController::class, 'client_pay'])->name('client.payment');
    Route::get('/payments/client/{id}', [PaymentController::class, 'client_detail'])->name('payment.client.detail');
    Route::put('/payments/{id}/update-status', [PaymentController::class,'updateStatus'])->name('payments.update.status');
    Route::put('/payments/{id}/edit-payment', [PaymentController::class, 'editPayment'])->name('payments.edit.payment');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    
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
    Route::post('/upload-file', [App\Http\Controllers\ProfileController::class, 'upload_file'])->name('upload_file');

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

    Route::resource('contracts', App\Http\Controllers\ContractController::class);
    Route::get('/contract_pdf/{id}', [App\Http\Controllers\ContractController::class, 'contract_pdf'])->name('contracts.pdf');
    Route::get('/declaracion_pdf/{id}',[App\Http\Controllers\ContractController::class, 'declaracion'])->name('declaracion.pdf');

    Route::resource('plans', App\Http\Controllers\PlanController::class);
    Route::resource('clientPayments', App\Http\Controllers\ClientPaymentController::class);

    Route::get('/showUsers', [BankViewsController::class, 'showUsers'])->name('showUsers');
    Route::get('/show-form-pdf', [PdfController::class, 'create'])->name('pdfUpload');
    Route::post('/pdf-upload-store', [PdfController::class, 'store'])->name('pdf-upload-store');
    Route::get('/show-pdf', [PdfController::class, 'show'])->name('showproduct');
    Route::get('/view-pdf/{id}', [PdfController::class, 'view'])->name('viewproduct');

    Route::get('/profiles/{id}/edit', function ($id) {
        return redirect()->route('show-form-pdf');
    })->name('profiles.edit');

    Route::get('fondo-general', [FondoGeneralController::class, 'showTotalAmount'])->name('fondo-general.show');
    Route::post('update-fondo-general', [FondoGeneralController::class, 'updateTotalAmount'])->name('fondo-general.update');
    
    // Route::get('/home', [HomeController::class, 'showClientHistory'])->name('home');
    Route::resource('home',HomeController::class);
    Route::get('/get-fondo-data/{id}', [HomeController::class, 'getFondoData']);

    // Route::get('/home/{userId}', [HomeController::class, 'dataUsers'])->name('home');

    // ******************Facturas***********************
    Route::get('/facturas', [FacturasController::class, 'show_index'])->name('admin_funciones.fondos');
    Route::post('/facturas/{id}/store-voucher', [FacturasController::class, 'store_voucher'])->name('facturas.store_voucher');
    Route::get('/vouchers', [FacturasController::class, 'show_vouchers'])->name('vouchers.show');

    Route::get('payment/pdf', [PaymentController::class, 'pdf'])->name('pdf');
    Route::get('/payments/client/pay/{id}/contrato-pdf', [PaymentController::class, 'pdf'])->name('pdf');

    Route::get('payment/declaracion',[PaymentController::class, 'declaracion'])->name('declaracion');


    Route::prefix('funciones_admin')->group(function () {
        Route::get('/fondos', [FondoController::class, 'index'])->name('fondos.index');
        Route::get('/fondos/create', [FondoController::class, 'create'])->name('fondos.create');
        Route::post('/fondos', [FondoController::class, 'store'])->name('fondos.store');
        Route::get('/fondos/{id}/edit', [FondoController::class, 'edit'])->name('fondos.edit');
        Route::put('/fondos/{id}', [FondoController::class, 'update'])->name('fondos.update');
        Route::delete('/fondos/{id}', [FondoController::class, 'destroy'])->name('fondos.destroy');
        Route::post('/fondos/{id}', [FondoController::class, 'calcularComisiones'])->name('fondos.update-comisiones');
        Route::post('/fondos/{id}/update-ganancia', [FondoController::class, 'updateGanancia'])->name('fondos.update-ganancia');
    });

    Route::get('/view-product/{id}', [BankViewsController::class, 'view'])->name('viewproduct');
    Route::get('/subscriptor-data', [SubscriptorDataController::class, 'index'])->name('subscriptor.data.index');
// tableFondos
    Route::post('/logout',function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');
    Route::get('/home-gerente',[HomeController::class,'gerenteHome'])->name('gerente.home');

    Route::get('fondo-table',function(){
        return view('admin_funciones_new.tableFondos');
    });
    // FONDOS NEW 
    Route::get('table-fondo/fondo-select',[FondoController::class,'get_payments'])->name('adminSelect');
    Route::post('/create-fondo', [FondoController::class,'createFondo'])->name('create.fondo');
    Route::get('table-fondo',[FondoController::class,'view_fondos'])->name('tableFondos');
    // Route::get('table-fondo/edit',[FondoController::class , 'editFondo'])->name('editFondo');
    Route::get('/table-fondo/edit/{id}', [FondoController::class, 'editFondo'])->name('fondo.edit');
    // edit currencies
    Route::post('/table-fondo/edit/{id}/update-invested-currencies', [FondoController::class, 'updateInvestedCurrencies'])->name('fondos.update-invested-currencies');

    Route::post('/table-fondo/edit/{id}/update-add-payments', [FondoController::class, 'editUpdateFondo'])->name('fondos.update-add-payments');
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

