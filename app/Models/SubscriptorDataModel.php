<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptorDataModel extends Model
{
    use HasFactory;
    public $table='membresias_data';
    public $fillable=[
	    'name',
        // 'refered_code',
        // 'plan_id',
        'membership_collected',
        'user_table_id'
    ];
}
