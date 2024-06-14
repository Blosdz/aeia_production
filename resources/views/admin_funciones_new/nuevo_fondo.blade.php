@extends('layouts_new.app')
@section('content')
    <div>
        <h2>Ingresar Nuevo Monto</h2>
        <form action="{{ route('fondo.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="month">Mes:</label>
                <input type="number" name="month" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="year">Año:</label>
                <input type="number" name="year" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total">Total:</label>
		<p></p>
            </div>
            <div class="form-group">
                <label for="collected">Total Recolectado:</label>
                <input type="number" name="collected" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
</div>
@endsection
