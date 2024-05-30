<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Contract
 * @package App\Models
 * @version April 26, 2022, 8:31 am UTC
 *
 * @property integer $user_id
 * @property integer $type
 * @property string $full_name
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $address
 * @property string $country_document
 * @property string $type_document
 * @property string $identification_number
 * @property string $code
 * @property integer $payment_id
 */
class Contract extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'contracts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'type',
        'full_name',
        'country',
        'city',
        'state',
        'address',
        'country_document',
        'type_document',
        'identification_number',
        'code',
        'payment_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'type' => 'integer',
        'full_name' => 'string',
        'country' => 'string',
        'city' => 'string',
        'state' => 'string',
        'address' => 'string',
        'country_document' => 'string',
        'type_document' => 'string',
        'identification_number' => 'string',
        'code' => 'string',
        'payment_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'type' => 'required',
        'full_name' => 'required',
        'country' => 'required',
        'city' => 'required',
        'state' => 'required',
        'address' => 'required',
        'country_document' => 'required',
        'type_document' => 'required',
        'identification_number' => 'required',
        'code' => 'required',
        'payment_id' => 'required'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
