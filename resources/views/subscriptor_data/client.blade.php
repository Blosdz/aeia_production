@extends('layouts_new.app')
@section('content')
<script>
    var chartDataClient = @json($chartDataClient);
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
<link rel="stylesheet" href="{{URL::asset('/newDashboard/app.css')}}">

<div class="container_dashboard_background">
    <div id="chart_column1"></div>
    <div class="dashboard-new-title">Dashboard</div>
    <div class="row">
        <div class="" id="group-new-containers">
            <div class="dashboard-new-container">
                <div class="dashboard-subtitle">Balance</div>
                <div class="dashboard-data"> $ {{$total_ganancia_fondos+$total_amount}}</div> 
                <div class="dashboard-image"> <img src="{{URL::asset('/images/dashboard/wallet.png')}}" ></div>
            </div>

            <div class="dashboard-new-container">
                <div class="dashboard-subtitle">Capital</div>
                <div class="dashboard-data">$ {{$total_amount}}</div> 
                <div class="dashboard-image">  <img src="{{URL::asset('/images/dashboard/coins.png')}}" ></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="group-row2">
            <div class="dashboard-new-container" id="medium-container">
                <div class="dashboard-subtitle">Bienvenido,</div>
                <div class="dashboard-title">{{$user_name}}</div>
                <div class="dashboard-subtitle">Que gusto verlo de vuelta</div>
                <img src="{{URL::asset('/images/dashboard/Logo.png')}}" alt="" srcset="" id="logo-dashboard">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="group-row3">
             <div class="dashboard-new-container" id="large-container">
                <div class="dashboard-title">Historico de Ventas</div>
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
                <!-- <button onclick="document.getElementById('clientHistoryChartContainer').style.display='block'" class="btn">
                    Movimientos del Fondo
                </button> -->
                <div class="graph_line"> <div id="chart_client_test"></div> </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@endsection