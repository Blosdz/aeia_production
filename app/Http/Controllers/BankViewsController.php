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
        foreach ($users as $user) {
            $get_payments = Payment::where('user_id', $user->id)->sum('total');
            $totalPaymentsByUser[$user->id]['total_payment'] = $get_payments;
            $totalPaymentsByUser[$user->id]['user'] = $user->toArray();

            $users_documents = Document::where('id', $user->id)->get();
            if ($users_documents->isNotEmpty()) {
                $totalPaymentsByUser[$user->id]['documentsFilePath'] = $users_documents->pluck('file_path')->toArray();
            } else {
                $totalPaymentsByUser[$user->id]['documentsFilePath'] = [];
            }
        }

        // dd($totalPaymentsByUser);
        return view('bankUsers', compact('users', 'totalPaymentsByUser'));
    }

public function view($id)
{
    $document = Document::find($id);

    if (!$document) {
        return redirect()->route('pdf.index')->with('error', 'Documento no encontrado');
    }

    return view('viewproduct', compact('document'));
}

}

