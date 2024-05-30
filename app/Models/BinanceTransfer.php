<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BinanceTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'receiver',
        'status',
        'message',
        'percentage',
        'amount',
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
