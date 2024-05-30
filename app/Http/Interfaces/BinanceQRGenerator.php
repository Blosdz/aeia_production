<?php
namespace App\Http\Interfaces;

interface BinanceQRGenerator

{
    /**
     * Generates the QR Code with Binance
     * @return mixed
     */
    public function generate();
    public function getResponse();
    public function setResponse($response);

}
