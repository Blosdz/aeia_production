<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FondoClientes extends Model
{
    use HasFactory;
    public $table='fondo_clientes';
    protected $fillable = [
        'month',
	    'plan_id_fondo',
        'planId',
        'monto_invertido',
        'Balance',
        'rentabilidad',
        'ganancia',
        'user_id',
        'fondo_historial',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fondoHistoriaClientes()
    {
        return $this->hasMany(FondoHistoriaClientes::class, 'fondo_cliente_id');
    }
}
