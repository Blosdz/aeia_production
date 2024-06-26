<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\FondoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FondoClientesController;
use App\Http\Controllers\SubscriptorDataController;
use App\Http\Controllers\BankViewsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ShowStatsController;
use App\Http\Controllers\FondoGeneralController;
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

Route::get('/welcome_default', function () {
    return view('welcome_default');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Route::get('/test1', function () {
    return view('auth.test1');
})->name('test');

Route::get('/welcome_default2', function () {
    return view('welcome_default2');
})->name('welcome_default2');

Route::get('/registration', function () {
    return view('/registration/registration');
})->name('registration');

Auth::routes();

//Route::get('/home', [FondoClientesController::class, 'index'])->name('home');

Route::get('/start', [App\Http\Controllers\HomeController::class, 'start'])->name('start');

Route::post('/mail/sendmail', [App\Http\Controllers\HomeController::class, 'sendmail'])->name('send.mail');


//Route::resource('users', 'UserController')->middleware('auth');
Route::resource('users', App\Http\Controllers\UserController::class);


Route::get('profiles/subscribers', [App\Http\Controllers\ProfileController::class, 'indexSubscribers'])->name('profiles.subscribers');
Route::resource('profiles', App\Http\Controllers\ProfileController::class);

Route::get('/profiles/user/data', [App\Http\Controllers\ProfileController::class, 'edit2'])->name('profiles.user');
Route::post('/profiles/user/data/{id}', [App\Http\Controllers\ProfileController::class, 'update2'])->name('profiles.update2');
Route::get('/profiles/user/verified',[App\Http\Controllers\ProfileController::class,'verified'])->name('profiles.verified');

Route::resource('payments', App\Http\Controllers\PaymentController::class);
//addcomments to vouchers
Route::put('payments/{payment}/updatecomment', [PaymentController::class, 'updateComments'])->name('payments.update.comments');
//
Route::get('/payments/user/data', [App\Http\Controllers\PaymentController::class, 'index2'])->name('payments.index2');
Route::post('/payments/user/pay', [App\Http\Controllers\PaymentController::class, 'pay'])->name('payments.pay');
Route::get('/payments/client/data', [App\Http\Controllers\PaymentController::class, 'client_index'])->name('clients.index');
Route::post('/payments/client/data', [App\Http\Controllers\PaymentController::class, 'client_index'])->name('clients.filter');
Route::get('/payments/select/plan',[App\Http\Controllers\PaymentController::class,'select_plan'])->name('payment.plan');
Route::get('/payments/client/pay/{id}',[App\Http\Controllers\PaymentController::class,'plan_detail'])->name('payment.detail');
Route::post('/payments/client/payment',[App\Http\Controllers\PaymentController::class,'client_pay'])->name('client.payment');
Route::get('/payments/client/{id}',[App\Http\Controllers\PaymentController::class,'client_detail'])->name('payment.client.detail');
Route::put('/payments/{id}/update-status', [App\Http\Controllers\PaymentController::class,'updateStatus'])->name('payments.update.status');
// Route::post('/payments/order', [App\Http\Controllers\PaymentController::class, 'new_order'])->name('payment.order');
// Route::get('/test', [App\Http\Controllers\PaymentController::class, 'testSendingMoney'])->name('payment.test');

Route::get('/invite/user/link', [App\Http\Controllers\UserController::class, 'generateInviteLink'])->name('invite.user');

Route::post('/invite/link/store', [App\Http\Controllers\UserController::class, 'link'])->name('users.link');

Route::post('/send_invitation',[App\Http\Controllers\UserController::class,'send_invitation'])->name('invitation');

Route::get('/suscriptor/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationSuscriptor'])->name('users.register.susp');
Route::get('/cliente/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationClient'])->name('users.register.client');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/confirmation-email/{token}', [App\Http\Controllers\UserController::class, 'confirmationEmail'])->name('user.confirmationEmail');
});




Route::resource('notifications', App\Http\Controllers\NotificationController::class);




// Route::resource('events', App\Http\Controllers\EventController::class);
Route::get('/rejection-history/{user_id}',[App\Http\Controllers\RejectionHistoryController::class,'rejectionHistory'])->name('rejectionHistory');
Route::get('/rejection-history-show/{id}',[App\Http\Controllers\RejectionHistoryController::class,'show'])->name('rejectionHistory.show');
Route::get('/dashboard',[App\Http\Controllers\EventController::class,'allEvents'])->name('dashboard');
// Route::get('/enroll-event/{id}',[App\Http\Controllers\EventController::class,'enroll'])->name('enroll');
Route::post('/upload-file',[App\Http\Controllers\ProfileController::class, 'upload_file'])->name('upload_file');

Route::get('bells/bells',        [App\Http\Controllers\BellsController::class, 'bells'])->name('bells.bells');

Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/images/' . $filename;
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/images/' . $filename;
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::resource('contracts', App\Http\Controllers\ContractController::class);

Route::get('/contract_pdf/{id}',[App\Http\Controllers\ContractController::class,'contract_pdf'])->name('contracts.pdf');

Route::resource('plans', App\Http\Controllers\PlanController::class);


Route::resource('clientPayments', App\Http\Controllers\ClientPaymentController::class);

Route::get('/showUsers', [App\Http\Controllers\BankViewsController::class, 'showUsers'])->name('showUsers');

Route::get('/show-form-pdf',[PdfController::class, 'create'])->name('pdfUpload');
Route::post('/pdf-upload-store', [PdfController::class, 'store'])->name('pdf-upload-store');
Route::get('/show-pdf', [PdfController::class, 'show'])->name('showproduct');
Route::get('/view-pdf/{id}', [PdfController::class, 'view'])->name('viewproduct');

Route::get('/profiles/{id}/edit', function ($id) {
    return redirect()->route('show-form-pdf');
})->name('profiles.edit');


Route::get('fondo-general', [FondoGeneralController::class, 'showTotalAmount'])->name('fondo-general.show');
Route::post('update-fondo-general', [FondoGeneralController::class, 'updateTotalAmount'])->name('fondo-general.update');
Route::middleware(['auth'])->group(function(){

	Route::get('/home',[FondoController::class,'showClientHistory'])->name('home');
});

Route::get('/facturas',[FacturasController::class,'show_index'])->name('admin_funciones.fondos');
Route::post('/facturas/{id}/store-voucher', [FacturasController::class, 'store_voucher'])->name('facturas.store_voucher');
Route::get('/vouchers', [FacturasController::class, 'show_vouchers'])->name('vouchers.show');

//Route::resource('fondos', FondoController::class);

//Route::post('/fondos/{id}/update-comisiones', [FondoController::class, 'updateComisiones'])->name('fondos.update-comisiones');
Route::get('payment/pdf',[PaymentController::class,'pdf'])->name('pdf');
Route::get('/payments/client/pay/{id}/contrato-pdf', [PaymentController::class, 'pdf'])->name('pdf');


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
