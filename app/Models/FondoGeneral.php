<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondoGeneral extends Model
{
	protected $fillable = ['monto', 'monto_manual'];
}
