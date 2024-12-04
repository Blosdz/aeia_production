@extends('layouts_new.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fondos</h1>
</div>




<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pagos</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('create.fondo') }}" id="fondo-form">
            @csrf
            <div class="form-group">
                <label for="fondo_name">Ingresa nombre para el fondo</label>
                <input type="text" id="fondo_name" name="fondo_name" class="form-control" required>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
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
                            <td>
                                <input class="select-checkbox" type="checkbox" name="payments[]" value="{{ $payment->id }}">

                            </td>
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
            </div>
        </form>
    </div>
</div>
            
<script>
    document.getElementById('select-all-btn').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('input[type="checkbox"][name="payments[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = true);
    });
</script>
@endsection     