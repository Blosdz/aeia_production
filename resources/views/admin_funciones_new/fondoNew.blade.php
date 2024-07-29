@extends('layouts_new.app')
@section('content')
<strong>Fondos</strong>
<div class="container bg-1 w-100 h-100 p-5" id="rounded-container">


    <strong>Pagos Anual</strong>
    <form method="POST" action="{{ route('create.fondo') }}" id="fondo-form">
        @csrf
        <div class="form-group">
            <label for="fondo_name">Ingresa nombre para el fondo</label>
            <input type="text" id="fondo_name" name="fondo_name" class="form-control" required>
        </div>
        <button type="button" id="select-all-btn" class="btn btn-secondary mb-3">Seleccionar Todo</button>
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td><input class="form-check-input" type="checkbox" name="payments[]" value="{{ $payment->id }}"></td>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->user_name }}</td>
                    <td>{{ $payment->created_at }}</td>
                    <td>{{ $payment->total }}</td>
                    <td>{{ $payment->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Crear Fondo</button>
    </form>

    <strong>Pagos con Rescate</strong>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Status</th>
        </tr>
    </table>
</div>

<script>
    document.getElementById('select-all-btn').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('input[type="checkbox"][name="payments[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = true);
    });
</script>
@endsection     