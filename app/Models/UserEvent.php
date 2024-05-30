<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserEvent
 * @package App\Models
 * @version March 1, 2022, 8:04 pm UTC
 *
 * @property integer $user_id
 * @property integer $event_id
 * @property string|\Carbon\Carbon $inscription_date
 */
class UserEvent extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'user_events';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'event_id',
        'inscription_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'event_id' => 'integer',
        'inscription_date' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'event_id' => 'required'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
