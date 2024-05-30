<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'providers';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'key',
        'value',
        'binance_user'
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string',
    ];

    public static $rules = [

    ];
}
