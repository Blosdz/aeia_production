<?php

namespace App\Traits;

use App\Http\Interfaces\BinanceTransferInterface;

trait BinanceMoneySplitterTrait{
    public static function split(BinanceTransferInterface $payment){
        $payment->calculate();
        return $payment->getResponse();
    }
}
