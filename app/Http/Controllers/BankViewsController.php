<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Contract;
use App\Models\Document; // Agrega el modelo PdfFile
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
use App\Http\Controllers\PdfController; // Importa el controlador PdfController

use Flash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\UserRepository;
use Pdf;

use Response;

class BankViewsController extends Controller
{
    

    protected $userRepository;	 
    public function __construct(UserRepository $userRepository){
	    $this->userRepository=$userRepository;
	}
    public function showUsers()
    {
        $users = User::where('rol', 3)->get();
        $totalPaymentsByUser = [];
        $totalDocuments = [];

        // Calcular la suma de pagos por usuario y buscar documentos por el ID del usuario
        foreach ($users as $user) {
	    $totalDocuments[$user->name] = Document::where('user_name', $user->id)->get();


            $totalPaymentsByUser[$user->id] = Payment::where('user_id', $user->id)->sum('total');
        }

        return view('bankUsers', compact('users', 'totalPaymentsByUser', 'totalDocuments'));
    }
// BankViewsController.php

public function view($id)
{
    $document = Document::find($id);

    if (!$document) {
        return redirect()->route('pdf.index')->with('error', 'Documento no encontrado');
    }

    return view('viewproduct', compact('document'));
}



}

