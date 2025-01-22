<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    use HasFactory;
    public $table='total_amounts';
    protected $fillable=[
        'month',
        'total',
        'ganancia_de_capital',
        'total_impuesto',
        'total_comisiones',
        'fondo_name',
        'invested_currencies',
        'amounts_historial'];

    public $timestamps=true;

    protected $casts=[
        'month'=>'integer',
        'total'=>'string',
        'ganancia_de_capital'=>'decimal:2',
        'total_comisiones'=>'decimal:2',
        'fondo_name'=>'string',
        'invested_currencies'=>'json',
        'amounts_historial'=>'json',
    ];


    public function historial()
    {
        return $this->hasMany(FondoHistorial::class);
    }
}
