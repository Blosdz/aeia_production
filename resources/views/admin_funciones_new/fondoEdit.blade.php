@extends('layouts_new.app')
@section('content')
<strong>Fondos</strong>
<div class="container bg-1 w-100 h-100 p-5" id="rounded-container">

    <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
        <strong> {{$fondo->fondo_name}} </strong>
        <div class="col">
            Rendimiento: <br>
            Fondo Inicial:  <br>
            Ganancia Neta: <br>
            Balance AEIA: <br>
            Creado en: <br>
            Ultima Actualización <br>
        </div>
        <div class="col">
            {{ $fondo->ganancia_de_capital }} <br>
            {{$fondo->total}} <br>
            {{$fondo->ganancia_de_capital - $fondo->total}}<br>
            {{ $fondo->total_comisiones }} <br>
            {{ $fondo->created_at }} <br>
            {{ $fondo->updated_at }} <br>
        </div>
   </div>
    <div class="row p-2">
         Actualizar Ganancia
            <form action="{{ route('fondos.update-ganancia', $fondo->id) }}" method="POST">
            @csrf
                <input type="number" name="ganancia_de_capital" class="form-control" placeholder="Nueva ganancia" required>
            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
            </form>
    </div>

    <div class="row">
        <form method="POST" action="{{ route('fondos.update-add-payments', $fondo->id) }}" id="add-payments-form">
            @csrf
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
            <button type="submit" class="btn btn-primary">Agregar Pagos al Fondo</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('select-all-btn').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="payments[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });
</script>
@endsection