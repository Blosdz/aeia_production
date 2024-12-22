<?php

namespace App\Models;

use Eloquent as Model;

use App\Models\Plan;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ClientPayment
 * @package App\Models
 * @version June 13, 2022, 8:33 pm UTC
 *
 * @property integer $user_id
 * @property integer $payment_id
 * @property string $referred_code
 * @property integer $referred_user_id
 */
class ClientPayment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'client_payments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'payment_id',
        'referred_code',
        'referred_user_id',
        'plan_id',
        'code',
        'fondo_name',
        'rescue_money'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'payment_id' => 'integer',
        'referred_code' => 'string',
        'referred_user_id' => 'integer',
        'plan_id' => 'integer',
        'code' => 'string',
        'fondo_name' => 'nullable|string',
        'rescue_money' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'referred_code' => 'nullable',
        'referred_user_id' => 'nullable'
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class,'plan_id','id');
    }

    public function referred_user(): BelongsTo
    {
        return $this->belongsTo(User::class,'referred_user_id','id');
    }
    public function payment():BelongsTo{
	    return $this->belongsTo(Payment::class, 'payment_id');
    }
}
