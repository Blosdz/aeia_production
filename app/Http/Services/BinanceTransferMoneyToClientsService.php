<?php

namespace App\Http\Services;

use App\Http\Interfaces\BinanceTransferInterface;
use App\Models\BinanceTransfer;
use App\Models\Payment;
use App\Models\Provider;
use App\Traits\BinanceDoughSenderTrait;

class BinanceTransferMoneyToClientsService implements BinanceTransferInterface
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
            $plan = $this->payment->client_payment->plan;
            $membershipAccount = Provider::where('slug', 'api_membresias')->first();
            $membershipAmount = $plan->annual_membership;
            $fundAccount = Provider::where('slug', 'ilike', "%{$this->payment->month}%")->first();
            $this->payment->total = $this->payment->total - $membershipAmount;

            $transfers = [
                [
                    "receiver" => $membershipAccount->binance_user,
                    "amount"   => $membershipAmount,
                ],
                [
                    "receiver" => $fundAccount->binance_user,
                    "amount"   => $this->payment->total,
                ],
            ];

            $this->setResponse(BinanceDoughSenderTrait::send($transfers));

            $transfer = BinanceTransfer::create([
                "payment_id" => $this->payment->id,
                "receiver" => $fundAccount->binance_user,
                "status" => $this->response->status,
                "message" => $this->response->error_message ?? null,
                "percentage" => $membershipAmount,
                "amount" => $this->payment->total,
            ]);

            $transfer->save();

        } catch(\Exception $e){
            return $this->setResponse($e->getMessage());
        }
    }
}
