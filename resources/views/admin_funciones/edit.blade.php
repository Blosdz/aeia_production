@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Actualizar Fondo</h1>
        <form action="{{ route('fondos.update', $fondo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="collected">Nuevo Monto Collected</label>
                <input type="number" step="0.01" class="form-control" id="collected" name="collected" value="{{ old('collected', $fondo->collected) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection

