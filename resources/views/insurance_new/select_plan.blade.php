@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cobertura</h1>
</div>

<div class=" card shadow mb-4 row   " id="rounded-container">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Selecciona tu plan</h6>
    </div>
    <div class="card-body d-flex flex-column justify-content-center align-items-center">
        <div class="card d-flex flex-column justify-content-center align-items-center" style="width: 18rem;">
            <img src="{{ asset('/images/dashboard/aa seguros 1-1.webp') }}" class="card-img-top d-flex justify-content-center align-items-center" alt="..." style="width:30%">
            <div class="card-body">
              <h5 class="card-title">Fondo de Cobertura de Deportistas</h5>

              <h6 style="font-weight:bolder !important">FCD menores de 18</h6>

              <p class="card-text">

                <p class="card-text mt-4 text-left" style="color: rgb(0, 0, 0) !important;">Deposito permitido desde:</p>
                    <h3 style="color: #eab226 !important;">
                         S/ 15 o  S/ 180 soles
                    </h3>
                    <ul>
                        <li>
                            <p style="color: rgb(0, 0, 0) !important; font-weight: bolder !important;">
                            Pago Anual:</p>S/.180.00 soles (carencia  2 meses de la suscripción)
                        </li>
                        <li>
                            <p style="color: rgb(0, 0, 0) !important; font-weight: bolder !important;">
                            Pago Mensual: </p>S/.15.00 soles (carencia 3 meses de la suscripción)
                        </li>
                        <li>
                            <p style="color: rgb(0, 0, 0) !important; font-weight: bolder !important;">
                            Cobertura:</p>S/.1000.00 soles
                        </li>


                    </ul>
                </p>
              <a href="{{route('insurance.create')}}" class="btn btn-primary">Contratar</a>
            </div>
        </div>
    </div>
</div>

@endsection
