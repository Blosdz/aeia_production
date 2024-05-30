<?php
namespace App\Http\Services;

use App\Http\Interfaces\BinanceQRGenerator;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class BinanceQRGeneratorService implements BinanceQRGenerator
{
    protected $data;
    protected $webHookUrl;
    protected $response;

    public function __construct(array $data, string $webHookUrl){
        $this->data = $data;
        $this->webHookUrl = $webHookUrl;
    }

    public function generate(){
        try {
            $db_key = Provider::where('slug','binance_pay')->first();
            $apiKey = Crypt::decryptString($db_key->value);
            $secretKey = Crypt::decryptString($db_key->secret_key);

            $nonce = Str::random(32);

            $webhookUrl = $this->webHookUrl.'/api/webhook';

            $goods = [
                'goodsType'          => "02",
                'goodsCategory'      => "Z000",
                'referenceGoodsId'   => "7876763A3B",
                'goodsName'          => $this->data["name"],
                'goodsDetail'        => $this->data["details"],
            ];

            $timestamp = Carbon::now()->isoFormat('x');

            $body = [
                'env'              => array('terminalType' => "APP"),
                'wallet'           => "SPOT_WALLET",
                'currency'         => "USDT",
                'orderAmount'      => $this->data["total"],
                'goods'            => $goods,
                'merchantTradeNo'  => Str::random(32),
                'webhookUrl'       => $webhookUrl,
            ];

            $payload = $timestamp."\n".$nonce."\n".json_encode($body)."\n";
            $signature = strtoupper(hash_hmac('sha512',$payload,$secretKey));
            $response = Http::accept('application/json')
            ->withHeaders([
                'BinancePay-Timestamp'=>$timestamp,
                'BinancePay-Nonce'=>$nonce,
                'BinancePay-Certificate-SN'=>$apiKey,
                'BinancePay-Signature'=>$signature
            ])
            ->post('https://bpay.binanceapi.com/binancepay/openapi/v2/order', $body);
            $this->setResponse(json_decode($response));

        } catch (\Exception $e) {
            $this->setResponse($e->getMessage());
        }
    }

    public function getResponse(){
        return $this->response;
    }

    public function setResponse($response){
        return $this->response = $response;
    }

}


