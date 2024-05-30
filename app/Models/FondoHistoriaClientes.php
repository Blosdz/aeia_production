<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondoHistoriaClientes extends Model
{
    use HasFactory;
    protected $table = 'fondo_historia_clientes';

    protected $fillable = [
        'fondo_cliente_id',
        'month',
        'total_invertido',
	'ganancia',
	'rentabilidad',
    ];

    public function fondoCliente()
    {
        return $this->belongsTo(FondoClientes::class, 'fondo_cliente_id');
    }
}
