@extends('layouts_new.app')

@section('content')
@php
 $user_validated = [
    0 => 'sin datos',
    1 => 'Por validar',
    2 => 'Verificado',
    3 => 'Rechazado'
 ];

 function getValidationStatus($validated, $statuses) {
    return $statuses[$validated] ?? 'Estado desconocido';
 }

 function getStatusClass($validated) {
    $classes = [
        2 => 'active',
        0 => 'disabled',
        1 => 'sent',
        3 => 'refused'
    ];
    return $classes[$validated] ?? 'unknown';
 }
@endphp

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Clientes Referidos</h1>
</div>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Historial de Pagos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Monto Invertido</th>
                        <th>Más</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users_refered as $user)
                        <tr>
                            <td>{{$user['email']}}</td>
                            <td>{{$user['name']}}</td>
                            <td>
                                @php
                                    $statusText = getValidationStatus($user['validated'], $user_validated);
                                    $statusClass = getStatusClass($user['validated']);
                                @endphp
                                <div class="product-cell status-cell">
                                    <div class="status {{$statusClass}}">{{$statusText}}</div>
                                </div>
                            </td>
                            <td>{{$user['totalPayments']}}</td>
                            <td>                           
                                <a href="{{route('detailCliente',['id'=>$user['id']])}}">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection
