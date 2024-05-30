<?php

namespace App\Traits;

use App\Models\Provider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait BinanceDoughSenderTrait {
    public static function send(array $data) {
        try {
            $db_key = Provider::where('slug', 'binance_pay')->first();
            $apiKey = Crypt::decryptString($db_key->value);
            $secretKey = Crypt::decryptString($db_key->secret_key);

            $nonce = Str::random(32);
            $merchantSendId = Str::random(32);

            $transferDetailList = [];
            $totalAmount = 0;

            foreach ($data as $element) {
                $transferDetail = [
                    'merchantSendId'     => $merchantSendId,
                    'receiveType'        => "BINANCE_ID",
                    'receiver'           => $element['receiver'],
                    'transferAmount'     => $element['amount'],
                    'transferMethod'     => "FUNDING_WALLET",
                ];

                $totalAmount = $totalAmount + $element['amount'];
                array_push($transferDetailList, $transferDetail);
            }

            $timestamp = Carbon::now()->isoFormat('x');

            $body = [
                'requestId'           => $nonce,
                'batchName'           => "AEIA Transfer",
                'currency'            => "USDT",
                'totalAmount'         => $totalAmount,
                'totalNumber'         => count($transferDetailList),
                'transferDetailList'  => $transferDetailList,
            ];

            $payload = $timestamp."\n".$nonce."\n".json_encode($body)."\n";
            $signature = strtoupper(hash_hmac('sha512', $payload, $secretKey));

            $response = Http::accept('application/json')
            ->withHeaders([
                'BinancePay-Timestamp'       => $timestamp,
                'BinancePay-Nonce'           => $nonce,
                'BinancePay-Certificate-SN'  => $apiKey,
                'BinancePay-Signature'       => $signature
            ])
            ->post('https://bpay.binanceapi.com/binancepay/openapi/payout/transfer', $body);

            return json_decode($response);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
