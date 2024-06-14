@extends('layouts_new.app')
@section('content')
    <div class="container">
        <h1>Historial de Montos para Fondo {{ $fondo->id }}</h1>
        <a href="{{ route('fondos.index') }}" class="btn btn-primary mb-3">Volver a Fondos</a>
        @if ($fondo->historial->isEmpty())
            <p>No hay historial disponible.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Collected</th>
                        <th>Creado en</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fondo->historial as $historial)
                        <tr>
                            <td>{{ $historial->id }}</td>
                            <td>{{ $historial->collected }}</td>
                            <td>{{ $historial->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

