<!-- resources/views/admin_funciones/fondo_clientes.blade.php -->

@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
	


.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 ;
  padding: 30px;
  display: flex;
  gap: 40px;
  flex-flow: column nowrap;
  width:68vw;
}

.row {
  display: flex;
  flex-flow: row wrap;
  gap: 40px;
}

.card {
  display: flex;
  gap: 28px;
  width:24vw;
  color: #fcfcfc;
  padding: 32px;
  border-radius: 30%;
  position: relative;
  z-index: 1;
  box-shadow: 6px 28px 46px -6px #000;
}

.card::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border-radius: 1rem;
  background: linear-gradient(135deg, #f27121, #000000 40%);
  z-index: -2;
}

.card::after {
  content: '';
  position: absolute;
  left: 1px;
  top: 1px;
  width: calc(100% - 1px);
  height: calc(100% - 1px);
  border-radius: 1rem;
  background: linear-gradient(90deg, #071b9b, #060609);
  transition: box-shadow 0.3s ease;
  z-index: -1;
}

.card .info {
  display: flex;
  flex-flow: column nowrap;
}

.card .info .sub {
  color: #ff7a00;
  line-height: 28px;
  font-size: 14px;
  font-weight: 400;
}

.card .info .title {
  max-width: 260px;
  line-height: 28px;
  font-size: 17px;
  font-weight: 500;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;  
  overflow: hidden;
}

.card .info .btn {
  margin-top: 28px;
  color: #fff;
  background: transparent;
  border: unset;
  border-radius: 16px;
  overflow: hidden;
  padding: 12px 24px;
  font-weight: 600;
  font-size: 16px;
  margin-right: auto;
  cursor: pointer;
  position: relative;
  z-index: 0;
  transition: background 0.3s ease;
}

.card .info .btn::before,
.card .info .btn::after {
  content: '';
  position: absolute;
}

.card .info .btn::before {
  left: 50%;
  top: 50%;
  background: linear-gradient(90deg, #ff7a00 0%, transparent 45%, transparent 55%, #ff7a00 100%);
  transform: translate(-50%, -50%) rotate(55deg);
  width: 100%;
  height: 240%;
  border-radius: 16px;
  z-index: -2;
  opacity: 0.4;
  transition: all 0.3s ease;
  animation: 5s move infinite linear paused;
}

.btn{
  background:black !important;
  color:white;
}
.card .info .btn::after {
  left: 2px;
  top: 2px;
  background: #171721;
  width: calc(100% - 4px);
  height: calc(100% - 4px);
  border-radius: 16px;
  z-index: -1;
}

.card .info .btn:hover::before {
  animation-play-state: running;
  opacity: 1;
}

.card .image {
  min-width: 86px;
  min-height: 86px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  box-shadow: 8px 12px 16px #000;
  position: relative;
  z-index: 0;
}

.card .image::before {
  content: '';
  position: absolute;
  background: linear-gradient(110deg, #ff7a00 10%, #000000);
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  z-index: -2;
}

.card .image::after {
  content: '';
  position: absolute;
  left: 1px;
  top: 1px;
  width: calc(100% - 1px);
  height: calc(100% - 1px);
  border-radius: 50%;
  background: linear-gradient(90deg, #12121a, #030303);
  box-shadow: 6px 6px 14px -6px #f2712150 inset;
  z-index: -1;
}

.card .image > i {
  font-size: 30px;
  color: #071b9b;
}

@keyframes move {
  0% {transform: translate(-50%, -50%)  rotate(55deg);}
  100% {transform: translate(-50%, -50%)  rotate(415deg);}
}
</style>
    <div style="width: 75%; margin: auto;">
        <h2>Historial de Inversiones del Cliente: {{ $user->name }}</h2>
        <!-- Formulario para seleccionar el fondo -->
        <form action="{{ route('home') }}" method="GET">
            <label for="fondo_id">Seleccionar Fondo:</label>
            <select name="fondo_id" id="fondo_id" class="form-control" onchange="this.form.submit()">
                <option value="">Seleccione un fondo</option>
                @foreach ($find_plans as $plan)
                    <option value="{{ $plan->id }}" {{ $plan->id == $fondoId ? 'selected' : '' }}>
                        {{ $mapPlan[$plan->planId] }} - mes {{ $plan->month }} - Fondo - {{ $plan->plan_id_fondo }}
                    </option>
                @endforeach
            </select>
            <noscript><input type="submit" value="Seleccionar Fondo"></noscript>
        </form>

        @if ($fondoId)
            <!-- Mostrar datos del fondo seleccionado -->
            <div class="fondo-details">
                @foreach ($find_plans as $plan)
                    @if ($plan->id == $fondoId)
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="card">
        <div class="info">
          <div class="sub">Detalles de su Fondo</div>
          <div class="title">Fondo General: {{$plan->ganancia + $plan->monto_invertido}}</div>
           <div class="title">      Fondo General: {{ $plan->ganancia + $plan->monto_invertido }}</div>
              <div class="title">   Monto Invertido: {{ $plan->monto_invertido }}</div>
            <div class="title">     Ganancia Neta: {{ $plan->ganancia }}   </div>
             <div class="title">    Rentabilidad: {{ $plan->rentabilidad }}</div>
      </div>
    </div>
  </div>
</div>
                    @endif
                @endforeach
            </div>

            <!-- Botón para mostrar el gráfico -->
            <button onclick="document.getElementById('clientHistoryChartContainer').style.display='block'" class="btn">
                Movimientos del Fondo
            </button>

            <!-- Gráfico -->
            <div id="clientHistoryChartContainer" style="display: none;">
                <canvas id="clientHistoryChart"></canvas>
            </div>
        @endif
    </div>
@if ($fondoId)
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('clientHistoryChart').getContext('2d');
                
        var labels = {!! json_encode($historialClientes->pluck('created_at')->map(function($date) {
            return Carbon\Carbon::parse($date)->format('M d');
        })->toArray()) !!};
                
        var totalActual = {!! json_encode($historialClientes->map(function($historial) {
            return $historial->total_invertido + $historial->ganancia;
        })->toArray()) !!};

        // Capital inicial
        var capitalInicial = {!! json_encode([$historialClientes->first()->total_invertido]) !!};

        // Replicar el valor del capital inicial para todos los puntos del gráfico
        var capitalInicialArray = new Array(totalActual.length).fill(capitalInicial[0]);

        // Rentabilidad
        var rentabilidad = {!! json_encode($historialClientes->pluck('rentabilidad')->toArray()) !!};

        // Configurar el gráfico
        var clientHistoryChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Capital Inicial',
                        data: capitalInicialArray, // Usar el valor del capital inicial en todos los puntos
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Actual',
                        data: totalActual, // Mostrar los valores totales actuales
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Rentabilidad',
                        data: rentabilidad, // Mostrar los valores de rentabilidad
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                        yAxisID: 'rentabilidad' // Añadir un nuevo eje Y para la rentabilidad
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            id: 'total',
                            type: 'linear',
                            position: 'left',
                        },
                        {
                            id: 'rentabilidad',
                            type: 'linear',
                            position: 'right',
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) { return value * 100 + '%' } // Formato porcentaje
                            }
                        }
                    ]
                }
            }
        });
    });
    </script>
@endif
@endsection
