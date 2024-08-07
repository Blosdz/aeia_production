<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuscriptorHistorial extends Model
{
    use HasFactory;
    public $table='Historial_membresias';
    public $fillable=[
        'name',
        'refered_code',
        'plan_id',
        'user_id',
        'membership_collected'

    ];
}
