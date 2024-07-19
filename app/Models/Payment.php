<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use App\Models\Contract;
use App\Models\ClientPayment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Payment
 * @package App\Models
 * @version December 17, 2021, 9:25 pm UTC
 *
 * @property string $status
 */
class Payment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'payments';
    

    protected $dates = ['deleted_at', 'date_transaction', 'expire_time', 'expiration_date'];



    public $fillable = [
        'month',
        'total',
        'status',
        'date_transaction',
        'user_id',
        'prepay_code',
        'expire_time',
        'transact_code',
        'transact_timestamp',
        'qr_url',
        'expiration_date',
	    'voucher_picture',
	    'comments_on_payment',
	    'user_name',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'voucher_picture'=>'string',
    ];

    public $timestamps=true;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'prepay_code' => 'required',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'id', 'payment_id');
    }

    public function client_payment(): BelongsTo
    {
        return $this->belongsTo(ClientPayment::class,'id','payment_id');
    }

    public function binanceTransfers(): HasMany
    {
        return $this->hasMany(BinanceTransfer::class);
    }

    public function scopeLastPayment($query) {
        return $query->orderBy('created_at', 'desc')
                     ->with('contract');
    }
    public function scopeIsPaid($query) {
        return $query->where('status', 'PAGADO');
    }

    public function scopeIsPending($query) {
        return $query->where('status', 'PENDIENTE');
    }
    public function clientPayments(): HasMany
    {
        return $this->hasMany(ClientPayment::class, 'payment_id');
    }


}
