<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondoHistorial extends Model
{
    use HasFactory;
    public $table='fondo_historials';
    protected $fillable = [
	    'fondo_id', 'ganancia_neta','total','total_comisiones',];

    public function fondo()
    {
        return $this->belongsTo(Fondo::class);
    }
}
