<?php
namespace App\Http\Interfaces;

interface BinanceTransferInterface

{
    /**
     * Generates the response for Binance's API.
     * @return mixed
     */
    public function getResponse();
    public function setResponse($response);
    public function calculate();

}
