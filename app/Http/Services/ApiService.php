<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class ApiService
{
    protected $apiKey;

    //another key K31HY05UE6ZW0NBW 
    public function __construct()
    {
        $this->apiKey = 'OA41RZIM5X3PSVCV'; // Tu API Key
    }

    public function getData($fromCurrency, $toCurrency)
    {
        $url = 'https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency='.$fromCurrency.'&to_currency='.$toCurrency.'&apikey='.$this->apiKey;
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }

    public function getMultipleData()
    {
        return  Cache::remember('crypto_exchange_rates',1440,function(){
            $currencies = [
                ['from' => 'BTC', 'to' => 'USD'],
                ['from' => 'BTC', 'to' => 'EUR'],
                ['from' => 'ETH', 'to' => 'USD'],
                ['from' => 'ETH', 'to' => 'EUR'],
                ['from' => 'SOL', 'to' => 'USD'],
                ['from' => 'SOL', 'to' => 'EUR'],
            ];
            // USD A EUR  | EUR A USD | USD A PEN | EUR A PEN |

            $results = [];

            foreach ($currencies as $currency) {
                $data = $this->getData($currency['from'], $currency['to']);
                $results[] = $data;
            }

            return $results;

        });
    }
}
