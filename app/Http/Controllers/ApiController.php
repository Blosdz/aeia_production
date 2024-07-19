<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ApiService;

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
        $data = $this->apiService->getMultipleData();
        // dd($data);
        return response()->json($data);
    }
}

