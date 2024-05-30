<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Notification
 * @package App\Models
 * @version January 27, 2022, 6:05 pm UTC
 *
 * @property string $body
 * @property string $body
 * @property integer $user_id
 */
class Notification extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'notifications';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'body',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'body' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
