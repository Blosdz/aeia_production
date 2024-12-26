<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    
    public $table="insurance";

    public $fillable=[
        'user_id',
        'phonenumber',
        'json',
        'email',
    ];

    protected $casts=[
        'user_id'=>'integer',
        'phonenumber'=>'string',
        'json'=>'json',
        'email'=>'string',
    ];


}
