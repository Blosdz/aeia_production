@extends('layouts_new.app')
@section('content')
<strong>Fondos</strong>
<div class="container bg-1 w-100 h-100 p-5" id="rounded-container">

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

   <!-- Formulario para actualizar ganancia de capital -->
    <div class="row p-2">
        <form action="{{ route('fondos.update-ganancia', $fondo->id) }}" method="POST">
        @csrf
        <div class="product-area-wrapper tableView">
            <div class="products-header">
                <div class="product-cell">Moneda</div>
                <div class="product-cell">Tipo de Cambio</div>
                <div class="product-cell">Actualizar Ganancia</div>
            </div>
            <div class="products-row">
                <div class="product-cell">EUR - USD </div>
                <div class="product-cell"> {{$currencies->where('base','EUR')->first()->rates['USD']}}</div>
                <div class="product-cell">
                    <input type="number" name="ganancia_de_capital_usd" class="form-control w-100" placeholder="Valor en USD" >
                </div> 
            </div>
            <div class="products-row">
                <div class="product-cell">USD - EUR</div>
                <div class="product-cell"> {{$currencies->where('base','USD')->first()->rates['EUR']}}</div>
                <div class="product-cell">
                    <input type="number" name="ganancia_de_capital_eur" class="form-control" placeholder="Valor en EUR" >
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
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
                            <input type="number" name="porcentaje[]" class="form-control" placeholder="Porcentaje">
                        </div>                                   
                        <div class="product-cell"></div>                
                    </div>
                    @endif
                @endforeach
              
            </div>
            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
        </form>
    </div>

    <!-- Formulario para agregar pagos -->
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
