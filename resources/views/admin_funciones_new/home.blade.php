@extends('layouts_new.app')

@section('content')
@php
    $user_session = Auth::user();
    $user = Auth::user();
    $profile = $user->profile;

@endphp
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row  row-fil3-client">
    <div class="col p-3">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="fondoDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccionar Fondo
            </button>
            <div class="dropdown-menu" aria-labelledby="fondoDropdown">
                @foreach($fondos as $fondo)
                    <a class="dropdown-item" href="#" onclick="showFondoData({{ $fondo->id }})">
                        {{ $fondo->fondo_name }} ({{ $fondo->created_at->format('d-m-Y') }})
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col p-3">
            <div class="counter h-100 w-100 bg-1" id="rounded-container">
                <div class="col h-100 p-3">
                    <div class="chart_general_data">
                        <div id="fondoChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-3 p-3">
        <div class="counter h-50 w-100 bg-1" id="rounded-container">
            <div class="col h-100 p-3">
                <h5>Información del Fondo</h5>
                <p><strong>Nombre:</strong> <span id="fondoName">{{ $fondos->first()->fondo_name }}</span></p>
                <p><strong>Fecha:</strong> <span id="fondoDate">{{ $fondos->first()->created_at->format('d-m-Y') }}</span></p>
                <p><strong>Total Comisiones:</strong> <span id="fondoComisiones">{{ $fondos->first()->total_comisiones }}</span></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col p-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">

                <thead>
                    <tr>
                        <th>Crypto</th>
                        <th>Valor USD</th>
                        <th>Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($cryptos) && is_iterable($cryptos))
                        @foreach ($cryptos as $crypto)
                            <tr>
                                <td>{{ $crypto->name }}</td>
                                <td>{{ $crypto->rates }}</td>
                                <td>{{ $crypto->percentage }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No hay datos disponibles.</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div> 
</div>

<div class="row">
    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1" id="rounded-container">
            <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                    <div class="col h-100">
                        <h2 class="fw-bolder">$ {{$membresias->membership_collected ?? ''}} </h2>
                        <span>Total Membresias</span>
                    </div>
                    <div class="col-3 h-100">
                        <span class="rounded-span">
                            <i class="fa-duotone fa-solid fa-chart-line"></i>
                        </span>
                        {{-- <i></i> --}}
                    </div>
                    {{-- <span class="rounded-span">
                        <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i>
                        </span>
                        <h2 class="text-light fw-bolder">$ <span class="count">{{$totalInversionYBeneficio ?? ''}}</span></h2>
                        <span>Total</span>--}}
                {{-- 
                    <div class="count-r h-100 w-50 text-end align-self-end">
                        <span class="text-success fw-bold"></span>
                    </div> 
                --}}
            </div>
        </div>
    </div>
    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1 "  id="rounded-container">
            <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="col h-100">
                    <h2 class="fw-bolder">${{$totalsumado ?? ''}}</h2>
                    <span>Capital Comisionado</span>
                </div>
                <div class="col-3 h-100">
                    <span class="rounded-span">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        {{-- <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i> --}}
                    </span>
                </div>
                {{-- <div class="h-100 w-50">
                    <div class="count-i rounded-circle i-bg wht position-relative align-content-center">
                        <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i>
                    </div>
                    <h2 class="text-light fw-bolder">$ <span class="count">{{$totalInversionPlanes ?? ''}}</span></h2>
                    <span>Total Recaudado</span>
                    </div>
                    <div class="count-r h-100 w-50 text-end align-self-end">
                        <span class="text-success fw-bold"></span>
                    </div> 
                --}}
            </div>
        </div>
    </div>

    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1 "  id="rounded-container">
            <div class="w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="col h-100">
                    <h2 id="countdown"></h2>
                    <span>Usuarios Conectados </span>
                </div>
                <div class="col-3 h-100">
                    <span class="rounded-span">
                        <i class="fa-regular fa-clock"></i>
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">    
    <div class="col">
        <div class="h-100 w-100 bg-1 d-flex justify-content-center "  id="rounded-container">

            <div class="container w-100 p-4">
                <div class="graph_general">
                </div>
                <div class="container w-40 h-100 d-flex-end" >
                    <ul>
                    {{--@foreach($fondos as $fondo)
                        <li>$fondo->id</li>
                    @endforeach--}}
                    </ul>
                </div>                   
            </div>
        </div>
    </div>
</div>
    
<strong>Tokens </strong> 
<div class="row">
    <div class="col">
        <div class="h-100 w-100 bg-1 d-flex justify-content-center p-2" id="rounded-container">
            <table class="w-100" id="rounded-container">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <th>Prices</th>
                        <th>Porcentage</th>
                        <th>Action</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Pasar los datos de Blade a una variable JavaScript

    var fondosChartData = @json($fondosChartData);
    var fondos = @json($fondos);

</script>

<script src="{{URL::asset('/js/app_admin.js')}}"></script>
@endsection


