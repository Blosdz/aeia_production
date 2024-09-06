<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currencies;

class CurrenciesController extends Controller
{
    protected $apiKeyCrypto;
    protected $apikeyCurrencies;

    public function __construct()
    {
        $this->apiKeyCrypto = 'OA41RZIM5X3PSVCV'; // apikey cryptos
        $this->apikeyCurrencies = '57006676771e98a463498cb92d904d45'; // apikey normal currencies
    }

    public function getUpdateCurrencies()
    {
        $currencies = [
            ['from' => 'BTC', 'to' => 'USD'],
            ['from' => 'BTC', 'to' => 'EUR'],
            ['from' => 'ETH', 'to' => 'USD'],
            ['from' => 'ETH', 'to' => 'EUR'],
            ['from' => 'SOL', 'to' => 'USD'],
            ['from' => 'SOL', 'to' => 'EUR'],
        ];

        foreach ($currencies as $currencyPair) {
            $fromCurrency = $currencyPair['from'];
            $toCurrency = $currencyPair['to'];

            // Fetch the exchange rate data from API
            $url = 'https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=' . $fromCurrency . '&to_currency=' . $toCurrency . '&apikey=' . $this->apiKeyCrypto;
            $json = file_get_contents($url);
            $data = json_decode($json, true);

            if (isset($data['Realtime Currency Exchange Rate'])) {
                $rate = $data['Realtime Currency Exchange Rate']['5. Exchange Rate'];
                
                // Fetch or create the currency record based on 'base'
                $currency = Currencies::firstOrNew(['base' => $fromCurrency]);

                // Update the rates JSON field
                $currency->rates = array_merge($currency->rates ?? [], [$toCurrency => $rate]);
                $currency->save();
            }
        }

        // Similarly, handle the normal currencies update from the Fixer.io API.
        $fixerUrl = 'http://data.fixer.io/api/latest?access_key=' . $this->apikeyCurrencies . '&symbols=USD,EUR';
        $fixerJson = file_get_contents($fixerUrl);
        $fixerData = json_decode($fixerJson, true);

        if (isset($fixerData['success']) && $fixerData['success']) {
            $eurToUsdRate = $fixerData['rates']['USD'];
            $usdToEurRate = 1 / $eurToUsdRate; // Calculate reverse rate
            
            // Update EUR to USD and USD to EUR
            $eurCurrency = Currencies::firstOrNew(['base' => 'EUR']);
            $eurCurrency->rates = array_merge($eurCurrency->rates ?? [], ['USD' => $eurToUsdRate]);
            $eurCurrency->save();

            $usdCurrency = Currencies::firstOrNew(['base' => 'USD']);
            $usdCurrency->rates = array_merge($usdCurrency->rates ?? [], ['EUR' => $usdToEurRate]);
            $usdCurrency->save();
        }
    }
}
