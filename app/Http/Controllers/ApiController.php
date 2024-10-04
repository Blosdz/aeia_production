<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApiService;
use App\Models\Currencies;

class ApiController extends Controller
{
    //
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getData()
    {
        // $data = $this->apiService->getMultipleData();
        $currency=Currencies::first();
        $rates=json_decode($currency->rates);

        $filteredRates = array_filter($rates, function ($key) {
            return !in_array($key, ['USD', 'EUR']);
        }, ARRAY_FILTER_USE_KEY);
        // dd($data);
        return response()->json($filteredRates);
    }
}

