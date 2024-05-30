@extends('layouts.app')

@section('content')
<div class="container">
    <div class="table-responsive">
        <h1>Total Recolectado por Mes</h1>
        <a href="{{ route('fondo.create') }}" class="btn btn-primary mb-3">Editar</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Total Recolectado</th>
                    <th>Comisiones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentsByMonth as $payment)
                <tr>
                    <td>{{ $payment->month }}</td>
                    <td>{{ $payment->year }}</td>
                    <td>${{ $payment->total }}</td>
                    <td>${{ $payment->comisiones }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

