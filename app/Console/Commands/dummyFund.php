<?php

namespace App\Console\Commands;

use App\Models\Fondo;
use Illuminate\Console\Command;
use Carbon\Carbon;

class dummyFund extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateDummyFund';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */


    public function handle(){
        $fund = Fondo::where('fondo_name', 'dummy')->first(); // Obtener un solo registro

        if (!$fund) {
            $this->error('Fondo "dummy" no encontrado.');
            return 1;
        }

        $currentMonth = Carbon::now()->month;

        if ($fund->month != $currentMonth) {
            // Actualizar el mes y el historial
            $fund->month = $currentMonth;
            $this->updateJson($fund, true); // Actualizar inicial
        } else {
            // Solo agregar información para el día actual
            $this->updateJson($fund, false);
        }

        $fund->save(); // Guardar cambios en el modelo
        $this->info('Fondo "dummy" actualizado exitosamente.');
        return 0;
    }

    private function updateJson($fund, $isNewMonth){
        // Decodificar el historial JSON
        $historial = json_decode($fund->amounts_historial, true) ?? [];

        $currentDay = Carbon::now()->day;
        $currentMonth = Carbon::now()->month;

        if ($isNewMonth) {
            // Configurar un nuevo mes si es necesario
            $initialAmount = rand(100000, 400000); // Cantidad inicial entre 100,000 y 400,000
            $historial[$currentMonth] = [
                $currentDay => [
                    [
                        'amount' => $initialAmount,
                        'revenue_percentage' => 0, // Inicial sin ingresos
                    ],
                ],
            ];
        } else {
            // Asegurarse de que $historial[$currentMonth] sea un array
            if (!isset($historial[$currentMonth]) || !is_array($historial[$currentMonth])) {
                $historial[$currentMonth] = [];
            }

            // Asegurarse de que $historial[$currentMonth][$currentDay] sea un array
            if (!isset($historial[$currentMonth][$currentDay]) || !is_array($historial[$currentMonth][$currentDay])) {
                $historial[$currentMonth][$currentDay] = [];
            }

            // Obtener el último monto registrado o un valor predeterminado
            $lastEntry = end($historial[$currentMonth][$currentDay]);
            $lastAmount = $lastEntry['amount']?? 100000;

            // Calcular nuevos datos para el día actual
            $revenuePercentage = rand(1, 10) / 100; // Ingresos aleatorios (1% a 10%)
            $newAmount = $lastAmount + ($lastAmount * $revenuePercentage);

            // Agregar los nuevos datos al arreglo del día actual
            $historial[$currentMonth][$currentDay][] = [
                'amount' => round($newAmount, 2),
                'revenue_percentage' => $revenuePercentage * 100, // Guardar como porcentaje
            ];
        }

        // Actualizar el historial en el modelo y guardar
        $fund->amounts_historial = json_encode($historial);
        $fund->save();
    }
}
