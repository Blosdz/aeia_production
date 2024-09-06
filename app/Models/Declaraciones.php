<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Declaraciones extends Model
{
    use HasFactory;

    protected $table = 'declaraciones';

    protected $fillable = [
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
        'payment_id',
        'signature_image'
    ];

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
        'payment_id' => 'integer',
        'signature_image' => 'string'
    ];

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
        'payment_id' => 'required',
        'signature_image' => 'required'
    ];
}
