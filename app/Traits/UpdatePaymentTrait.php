<?php

namespace App\Traits;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;

trait UpdatePaymentTrait
{
    public static function updatePendings() {
        Payment::where('status', 'PENDIENTE')
            ->where('expire_time', '<', now())
            ->update([
                'status' => 'VENCIDO',
            ]);
    }

    public static function updatePaids() {
        Payment::where('status', 'PAGADO')
            ->where('expiration_date', '<', now())
            ->update([
                'status' => 'VENCIDO',
            ]);
    }
}
