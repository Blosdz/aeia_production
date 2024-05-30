<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Bells
 * @package App\Models
 * @version April 8, 2022, 6:44 am UTC
 *
 * @property integer $user_id
 * @property boolean $notification
 */
class Bells extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'bells';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'notification'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'notification' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
