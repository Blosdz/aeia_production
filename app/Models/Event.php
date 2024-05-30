<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Event
 * @package App\Models
 * @version February 21, 2022, 7:20 pm UTC
 *
 * @property string $title
 * @property string|\Carbon\Carbon $date
 * @property string $description
 * @property string $image
 * @property string $link_meet
 * @property string $link_recording
 * @property int $total
 * @property int $status
 */
class Event extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'events';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'date',
        'description',
        'image',
        'link_meet',
        'link_recording',
        'total',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'date' => 'datetime',
        'description' => 'string',
        'image' => 'string',
        'link_meet' => 'string',
        'link_recording' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        //'title' => 'required'
    ];

    
}
