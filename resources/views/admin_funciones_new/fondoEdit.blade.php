@extends('layouts_new.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fondos</h1>
</div>


{{-- if user->rol == 1  --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Editar Fondos</h6>
    </div>

    <div class="card-body">
        <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
            <strong> {{$fondo->fondo_name}} </strong>
            <div class="col">
                Valor Actual: <br>
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

        <div class="row p-4">
            <form action="{{ route('fondos.update-ganancia', $fondo->id) }}" method="POST">
            @csrf
                <div class="table-responsive">
                    <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                         <thead>
                             <th>Moneda</th>
                             <th>Tipo de Cambio</th>
                             <th>Actualizar Ganancia</th>
                         </thead>
                         <tbody>
                            <tr>
                                <td>EUR a USD</td>
                                <td>{{$currencies->where('base','EUR')->first()->rates['USD']}}</td>
                                <td><input type="number" name="ganancia_de_capital_eur" class="form-control w-100" placeholder="Ingresar Precio en EUR" ></td>
                            </tr>
                            <tr>
                                <td>USD</td>
                                <td></td>
                                <td>
                                    <input type="number" name="ganancia_de_capital_usd" class="form-control" placeholder="Actualizar Precio USD" >
                                </td>
                            </tr>

                         </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                </div>
            </form>
        </div>


    <!-- Formulario para actualizar criptomonedas invertidas -->
    <div class="row">
        <form action="{{ route('fondos.update-invested-currencies', $fondo->id) }}" method="POST">
            @csrf
            <div class="product-area-wrapper tableView">
                <div class="products-header">
                    <div class="product-cell">Crypto</div>                
                    <div class="product-cell">Precio USD</div>                
                    <div class="product-cell">Precio EUR</div>                
                    <div class="product-cell">Porcentaje</div>                
                </div>
                @foreach ($currencies as $currency)
                    @if ($currency->base !== 'USD' && $currency->base !== 'EUR')
                    <div class="products-row">
                        <div class="product-cell">{{ $currency->base }}</div>                
                        <div class="product-cell">{{ $currency->rates['USD'] }}</div>                
                        <div class="product-cell">{{ $currency->rates['EUR'] }}</div>                
                        <div class="product-cell"> 
                            <!-- Aquí es donde corregimos el name para que se envíe un array -->
                            <input type="hidden" name="moneda[]" value="{{ $currency->base }}">
                            <input type="hidden" name="precio_usd[]" value="{{ $currency->rates['USD'] }}">
                            <input type="number" 
                                   name="porcentaje[]" 
                                   class="form-control" 
                                   placeholder="Porcentaje (0-100)"
                                   min="0" max="100" required>
                        </div>                                   
                    </div>
          
                    @endif
                @endforeach
              
            </div>
            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
        </form>
    </div>

    <!-- Formulario para agregar pagos -->
    <div class="row">
        <div class="table-responsive">
            <form method="POST" action="{{ route('fondos.update-add-payments', $fondo->id) }}" id="add-payments-form">
                @csrf
                <button type="button" id="select-all-btn" class="btn btn-secondary mb-3">Seleccionar Todo</button>

                    <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                        <thead>
                                <th>Select</th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Monto</th>
                                <th>Status</th>
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
</div>
<script>
    document.getElementById('select-all-btn').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="payments[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    });
</script>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const percentages = document.querySelectorAll('input[name="porcentaje[]"]');
        let total = 0;
        percentages.forEach(input => {
            total += parseFloat(input.value) || 0;
        });

        if (total > 100) {
            alert('La suma de los porcentajes no puede superar el 100%.');
            event.preventDefault();
        }
    });
</script>

@endsection
