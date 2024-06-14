@extends('layouts_new.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Fondo</h1>
	<h2>Total recolectado {{$totalPayments}}</h2>
        <form action="{{ route('fondos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="year">Año</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="month">Mes</label>
                <input type="number" class="form-control" id="month" name="month" required>
            </div>
            <div class="form-group">
                <label for="collected">Recogido</label>
                <input type="number" step="0.01" class="form-control" id="collected" name="collected" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
