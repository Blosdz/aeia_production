<?php

namespace App\Traits;

use App\Models\Provider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait BinanceBalanceCheckerTrait{
    public static function check($account , string $currency) {
        try {
            $db_key = Provider::where('slug', $account)->first();
            $apiKey = Crypt::decryptString($db_key->value);
            $secretKey = Crypt::decryptString($db_key->secret_key);

            $nonce = Str::random(32);

            $timestamp = Carbon::now()->isoFormat('x');

            $body = [
                'wallet'              => "FUNDING_WALLET",
                'currency'            => $currency,
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
            ->post('https://bpay.binanceapi.com/binancepay/openapi/balance', $body);

            return json_decode($response);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
