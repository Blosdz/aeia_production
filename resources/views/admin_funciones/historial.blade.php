@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historial de Fondos</h1>
        <a href="{{ route('fondos.index') }}" class="btn btn-primary mb-3">Volver a Fondos</a>
        @if ($fondos->isEmpty())
            <p>No hay historial disponible.</p>
        @else
            @foreach ($fondos as $key => $monthFondos)
                <h2>{{ $key }}</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th>Total</th>
                            <th>Recogido</th>
                            <th>Renta</th>
                            <th>Total Comisiones</th>
                            <th>Creado en</th>
                            <th>Actualizado en</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthFondos as $fondo)
                            <tr>
                                <td>{{ $fondo->id }}</td>
                                <td>{{ $fondo->year }}</td>
                                <td>{{ $fondo->month }}</td>
                                <td>{{ $fondo->total }}</td>
                                <td>{{ $fondo->collected }}</td>
                                <td>{{ $fondo->renta }}</td>
                                <td>{{ $fondo->total_comisiones }}</td>
                                <td>{{ $fondo->created_at }}</td>
                                <td>{{ $fondo->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @endif
    </div>
@endsection

