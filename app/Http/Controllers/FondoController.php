<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fondo;
use App\Models\FondoHistorial;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\FondoHistoriaClientes;
use App\Models\FondoClientes;
use App\Models\ClientPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class FondoController extends Controller
{
    // CONSEGUIR LOS PAGOS POSTERIORES A UN FONDO YA CREADO VERIFICA SI HAY FONDO O NO 
    public function calculate_latest_payments(){
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Obtener el último fondo creado
        $ultimoFondo = Fondo::latest()->first();

        if ($ultimoFondo && $ultimoFondo->ganancia_de_capital>0) {
            // Obtener el timestamp del último fondo
            $timestampUltimoFondo = $ultimoFondo->updated_at; // Cambiar de created_at a updated_at

            // Filtrar pagos realizados después del último fondo
            $totalPayments = Payment::whereYear('created_at', $currentYear)
                                    ->whereMonth('created_at', $currentMonth)
                                    ->where('created_at', '>', $timestampUltimoFondo)
                                    ->sum('total');
        } else {
            // Si no hay fondos, obtener todos los pagos del mes actual
            $totalPayments = Payment::whereYear('created_at', $currentYear)
                                    ->whereMonth('created_at', $currentMonth)
                                    ->sum('total');
        }    
        return $totalPayments;
    }

    public function index() {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $totalPayments = $this->calculate_latest_payments();
        $fondos = Fondo::where('month', $currentMonth)->get();

        return view('admin_funciones.index', compact('fondos', 'totalPayments'));
    }

    public function crearFondoClientes($mes, $year, $ultimoFondo)
    {
        $fondosClientesCreados = [];
        $fondosClientesTotales = [];
    
        if ($ultimoFondo && $ultimoFondo->ganancia_de_capital > 0) {
            $timestampUltimoFondo = $ultimoFondo->created_at;
            $payments = Payment::whereYear('created_at', $year)
                ->whereMonth('created_at', $mes)
                ->where('created_at', '>', $timestampUltimoFondo)
                ->with('clientPayments')
                ->get();
        } else {
            $payments = Payment::whereYear('created_at', $year)
                ->whereMonth('created_at', $mes)
                ->with('clientPayments')
                ->get();
        }
    
        foreach ($payments as $payment) {
            foreach ($payment->clientPayments as $clientPayment) {
                $user_id = $clientPayment->user_id;
                $plan_id = optional($clientPayment->plan)->id;
                $total = $payment->total;
    
                if ($plan_id === null) {
                    continue;
                }
    
                if (!isset($fondosClientesTotales[$user_id][$plan_id])) {
                    $fondosClientesTotales[$user_id][$plan_id] = 0;
                }
    
                $fondosClientesTotales[$user_id][$plan_id] += $total;
            }
        }
    
        foreach ($fondosClientesTotales as $user_id => $planes) {
            foreach ($planes as $plan_id => $total) {
                $fondoCliente = FondoClientes::updateOrCreate([
                    'month' => $mes,
                    'user_id' => $user_id,
                    'planId' => $plan_id,
                    'plan_id_fondo'=>$ultimoFondo->id,
                ], [
                    'monto_invertido' => $total,
                ]);
    
                $fondosClientesCreados[] = $fondoCliente;
            }
        }
    
        return $fondosClientesCreados;
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer',
            'total' => 'required|numeric',
        ]);

        $fondoAnterior = Fondo::latest()->first();

        if($fondoAnterior==null){
            $nuevoFondo = Fondo::create([
                'month' => $request->month,
                'total' => $request->total,
                'ganancia_de_capital' => $request->ganancia_de_capital ?? 0,
            ]);
            // Crear los FondoClientes usando el nuevo fondo
            $fondosClientesCreados = $this->crearFondoClientes($request->month, date('Y'), $nuevoFondo);
        }
	else{

        	if ($fondoAnterior || $fondoAnterior->ganancia_de_capital > 0) {
        	    // Si hay un fondo anterior con ganancia, crear un nuevo fondo
        	    $nuevoFondo = Fondo::create([
        	        'month' => $request->month,
        	        'total' => $request->total,
        	        'ganancia_de_capital' => $request->ganancia_de_capital ?? 0,
        	    ]);

        	    // Crear los FondoClientes usando el nuevo fondo
        	    $fondosClientesCreados = $this->crearFondoClientes($request->month, date('Y'), $nuevoFondo);
        	} else {
        	    // Si no hay un fondo anterior con ganancia, usar el fondo existente

        	    $fondosClientesCreados = $this->crearFondoClientes($request->month, date('Y'), $nuevoFondo);
        	}
	}

        return redirect()->route('fondos.index');

    }
    public function calcularComisiones($fondoId)
    {
	   $fondo = Fondo::find($fondoId);

	    if (!$fondo) {
	        return redirect()->route('fondos.index')->with('error', 'Fondo no encontrado');
	    }
	
	    // Calcular el total de inversiones en el fondo
	    $totalInversiones = $fondo->total;
	
	    if ($totalInversiones == 0) {
	        return redirect()->route('fondos.index')->with('error', 'No hay inversiones en este fondo');
	    }
	
	    // Calcular las comisiones y actualizar los fondos y fondos de clientes
	    $fondosClientes = FondoClientes::where('plan_id_fondo', $fondoId)->get();
	
	    // Depurar para ver los datos del fondo y los fondos de clientes
	    //dd($fondo, $totalInversiones, $fondosClientes);
	
	    $totalComisiones = 0;
	    $table_of_depurar=$fondosClientes;	
	    foreach ($fondosClientes as $fondoCliente) {
		$fondoHistClient=FondoHistoriaClientes::create([
			'fondo_cliente_id'=>$fondoCliente->id,
			'month'=>$fondoCliente->month,
			'total_invertido'=>$fondoCliente->monto_invertido,
			'ganancia'=>$fondoCliente->ganancia,
			'rentabilidad'=>$fondoCliente->rentabilidad,
			
		    ]);

	    	$plan=Plan::find($fondoCliente->planId);
	        // Calcular el porcentaje de inversión del cliente en relación al total
	        $porcentajeInversion = $fondoCliente->monto_invertido / $totalInversiones;
	
	        // Calcular la ganancia del cliente en base al porcentaje de inversión y la ganancia del fondo
	        $gananciaCliente = $porcentajeInversion * $fondo->ganancia_de_capital;
	
	        $comision = $gananciaCliente * ($plan->commission / 100);

	        $totalComisiones += $comision;
	        // Actualizar la ganancia del cliente en la tabla de fondo_clientes
	        $fondoCliente->ganancia = $gananciaCliente - $comision;
	        $fondoCliente->rentabilidad = $gananciaCliente / $fondoCliente->monto_invertido;
	        $fondoCliente->update();
	    }
	    //dd($table_of_depurar);	
	    // Actualizar el balance del fondo con la comisión total
	    $fondo->total_comisiones = $totalComisiones;
	    $fondo->save();
	    foreach ($fondosClientes as $fondoCliente) {
		$fondoHistClient=FondoHistoriaClientes::create([
			'fondo_cliente_id'=>$fondoCliente->id,
			'month'=>$fondoCliente->month,
			'total_invertido'=>$fondoCliente->monto_invertido,
			'ganancia'=>$fondoCliente->ganancia,
			'rentabilidad'=>$fondoCliente->rentabilidad,
			
		    ]);

	    	$plan=Plan::find($fondoCliente->planId);
	        // Calcular el porcentaje de inversión del cliente en relación al total
	        $porcentajeInversion = $fondoCliente->monto_invertido / $totalInversiones;
	
	        // Calcular la ganancia del cliente en base al porcentaje de inversión y la ganancia del fondo
	        $gananciaCliente = $porcentajeInversion * $fondo->ganancia_de_capital;
	
	        $comision = $gananciaCliente * ($plan->commission / 100);

	        $totalComisiones += $comision;
	        // Actualizar la ganancia del cliente en la tabla de fondo_clientes
	        $fondoCliente->ganancia = $gananciaCliente - $comision;
	        $fondoCliente->rentabilidad = $gananciaCliente / $fondoCliente->monto_invertido;
	        $fondoCliente->update();
	    }
	
	    return redirect()->route('fondos.index')->with('success', 'Comisiones calculadas y actualizadas correctamente');
	}

	

    public function updateGanancia(Request $request, $id)
    {
        $fondo = Fondo::findOrFail($id);
        $request->validate([
            'ganancia_de_capital' => 'required|numeric',
        ]);

        $fondo->ganancia_de_capital = $request->ganancia_de_capital;
        $fondo->save();

        FondoHistorial::create([
            'fondo_id' => $fondo->id,
            'ganancia_neta' => $request->ganancia_de_capital,
            'total' => $fondo->total,
            'tota_comisiones' => $this->calcularComisiones($id),
        ]);

        return redirect()->route('fondos.index');
    }

    public function edit($id)
    {
        $fondo = Fondo::findOrFail($id);
        return view('admin_funciones.edit', compact('fondo'));
    }

    public function update( $id)
    {
        $fondoAnterior = Fondo::latest()->first();

        if ($fondoAnterior->ganancia_de_capital > 0) {
            return redirect()->route('fondos.index')->with('error', 'No se puede actualizar el monto total. Por favor, cree un nuevo fondo.');
        }

        $fondo = Fondo::findOrFail($id);
	/*
        $request->validate([
            'total' => 'required|numeric',
	]);*/

        $fondosClientesCreados = $this->crearFondoClientes($fondo->month, date('Y'), $fondo);
        $fondo->total = $this->calculate_latest_payments();
        $fondo->save();

        return redirect()->route('fondos.index')->with('success', 'Monto total actualizado');
    }

    public function destroy($id)
    {
        $fondo = Fondo::findOrFail($id);
	   // Eliminar los registros de FondoHistorial asociados al fondo
	    FondoHistorial::where('fondo_id', $fondo->id)->delete();

	    // Eliminar los registros de FondoHistoriaClientes asociados al fondo
	    FondoHistoriaClientes::whereHas('fondoCliente', function ($query) use ($fondo) {
	        $query->where('plan_id_fondo', $fondo->id);
	    })->delete();
	
	    // Eliminar los registros de FondoClientes asociados al plan_id_fondo del fondo
	    FondoClientes::where('plan_id_fondo', $fondo->id)->delete();
	
	    // Finalmente, eliminar el fondo
	    $fondo->delete();

	    return redirect()->route('fondos.index');
    }
    public function showClientHistory(Request $request){
	    $user = Auth::user();
	
	    if (!$user) {                       
	        return redirect()->route('login')->with('error', 'Por favor inicie sesión');
	    }
	
	    $fondoId = $request->input('fondo_id');
	
	    // Obtener los planes asociados con el cliente autenticado
	    $find_plans = FondoClientes::where('user_id', $user->id)->get();
	
	    // Obtener el historial del fondo seleccionado
	    $historialClientes = collect();
	    if ($fondoId) {
	        $historialClientes = FondoHistoriaClientes::where('fondo_cliente_id', $fondoId)
	            ->orderBy('created_at', 'asc')
	            ->get();
	    }
		        // Definir el mapeo de los planes
	    $mapPlan = [
	        1 => 'Bronce',
	        2 => 'Plata',
	        3 => 'Oro',
	        4 => 'Platino',
	        5 => 'Diamante',
	        6 => 'VIP'
	    ];
	
	    return view('home', compact('user', 'find_plans', 'historialClientes', 'fondoId','mapPlan'));
	}

}
