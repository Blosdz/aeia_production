<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

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
class RejectionHistory extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'rejection_history';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'date',
        'comment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'string',
        'date' => 'datetime',
        'comment' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        //'title' => 'required'
    ];

    public function user()  
    {
        return $this->belongsTo(User::class);
    }

    
}
