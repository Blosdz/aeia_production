<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    use HasFactory;
    public $table='total_amounts';
    protected $fillable=[
	    'month','total','ganancia_de_capital','total_impuesto','total_comisiones'];
    public $timestamps=true;
    public function historial()
    {
        return $this->hasMany(FondoHistorial::class);
    }
}
