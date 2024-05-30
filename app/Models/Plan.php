<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Plan
 * @package App\Models
 * @version June 10, 2022, 3:36 pm UTC
 *
 * @property string $name
 * @property integer $minimum_fee
 * @property integer $maximum_fee
 * @property integer $annual_membership
 * @property integer $commission
 */
class Plan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'plans';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'minimum_fee',
        'maximum_fee',
        'annual_membership',
        'commission'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'minimum_fee' => 'integer',
        'maximum_fee' => 'integer',
        'annual_membership' => 'integer',
        'commission' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
