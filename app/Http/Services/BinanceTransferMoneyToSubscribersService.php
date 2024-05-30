<?php

namespace App\Http\Services;

use App\Http\Interfaces\BinanceTransferInterface;
use App\Models\BinanceTransfer;
use App\Models\Payment;
use App\Models\Provider;
use App\Traits\BinanceDoughSenderTrait;

class BinanceTransferMoneyToSubscribersService implements BinanceTransferInterface
{
    protected $response;
    protected $payment;

    public function __construct(Payment $payment)
    {
       $this->payment = $payment;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response)
    {
       return $this->response = $response;
    }

    public function calculate()

{
        try{
            $subscribersAccount = Provider::where('slug', 'api_suscriptores')->first();

            $transfers = [
                [
                    "receiver" => $subscribersAccount->binance_user,
                    "amount"   => $this->payment->total
                ],
            ];

            $this->setResponse(BinanceDoughSenderTrait::send($transfers));

            $transfer = BinanceTransfer::create([
                "payment_id" => $this->payment->id,
                "receiver" => $subscribersAccount->binance_user,
                "status" => $this->response->status,
                "message" => $this->response->error_message ?? null,
                "percentage" => 100,
                "amount" => $this->payment->total,
            ]);

            $transfer->save();

        } catch(\Exception $e){
            return $this->setResponse($e->getMessage());
        }
    }
}
