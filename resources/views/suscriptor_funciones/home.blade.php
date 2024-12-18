@extends('layouts_new.app')

@section('content')
@php
    $user_session = Auth::user();
    $user = Auth::user();
    $user_code = $user->unique_code; 
    $profile = $user->profile;

@endphp
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>


<div class="row justify-content-center align-items-center">
    <div class="col-xl-4 col-md-3 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Invitar a nuevos usuarios
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$totalInversionYBeneficio ?? ''}} </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-duotone fa-solid fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-3 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Capital Invertido
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{$paymentsTotal ?? ''}} </div>
                    </div>
                    <div class="col-auto">

                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="row row-fil1-client">
    <div class="col p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="col h-100">
                    <h2>Invitar a nuevos usuarios</h2>
                    <input type="text" class="form-control" id="inviteLink" value="{{$inviteLink ?? ''}}" readonly>

                </div>
                <div class="col-3 h-100">
                    <span class="rounded-span">
                        <i class="fa-solid fa-link" style="cursor:pointer;" onclick="copyToClipboard('#inviteLink')"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="col h-100 ">
                    <h2 class="fw-bolder">$ {{$montoGenerado ?? ''}}</h2>
                    <span>Total Generado</span>
                </div>
                <div class="col-3 h-100">
                    <span class="rounded-span">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="col h-100 w-50">
                   <h2 class="fw-bolder">{{ $dataInvitados ?? ''}}</h2>
                    <span>Total de Clientes</span>
                </div>
                <div class="col-3 h-100">
                    <span class="rounded-span">
                        <i class="fa-solid fa-users"></i>
                    </span>
                </div>

            </div>
        </div>
    </div>
    <div class="col p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="col h-100 w-50">
                    <h2 class="fw-bolder">{{ $totalPlanesVendidos ?? ''}}</h2>
                    <span>Planes Vendidos</span>
                </div>
                <div class="col-3 h-100">
                    <span class="rounded-span">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="row2-content-suscriber">
        <div class="col">
            <div class="h-100 w-100 bg-1 d-flex justify-content-center "  id="rounded-container">
                <div class="container w-60 p-4">
                    <h1 class="display-4">Bienvenido</h1>
                    <br>
                    <p class="lead">¡Qué gusto verte de nuevo! {{ $userProfile->first_name ?? '' }}</p>
                    @if($user->validated == 1)
                        <h4 class="text-success fw-bold">Su cuenta ha sido verificada, ya puedes invertir</h4>
                    @else
                        <h4 class="text-danger fw-bold">Su cuenta aún no esta verificada</h4>
                    @endif
                </div>
                <div class="container w-40 h-100">
                    <div class="content h-100 justify-content-center align-items-center text-center mt-5">
                        @include('layouts_new.nav')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3 p-3">
            <div class="bg-1 p-3 overflow-auto table-comissions"  id="rounded-container" style="max-height:16vw;">
                    <div class="product-area-wrapper tableView">
                        <div class="products-header">
                            <div class="product-cell">Planes</div>
                            <div class="product-cell">Comisión</div>
                        </div>
                        <div class="products-row">
                            <div class="product-cell">Bronce</div>
                            <div class="product-cell">$14</div>
                        </div>
                        <div class="products-row">
                            <div class="product-cell">Plata</div>
                            <div class="product-cell">$35</div>
                        </div>
                        <div class="products-row">
                            <div class="product-cell">Oro</div>
                            <div class="product-cell">$70</div>
                        </div>
                        <div class="products-row">
                            <div class="product-cell">Platino</div>
                            <div class="product-cell">$84</div>
                        </div>
                        <div class="products-row">
                            <div class="product-cell">Diamante</div>
                            <div class="product-cell">$140</div>
                        </div>
                        <div class="products-row">
                            <div class="product-cell">VIP</div>
                            <div class="product-cell"></div>
                        </div>
                    </div>
                    {{-- <table class="styled-table ">
                        <thead>
                            <tr>
                                <th>Tipo de Plan</th>
                                <th>Comisión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bronce</td>
                                <td>$ 14</td>
                            </tr>
                            <tr class="active-row">
                                <td>Plata</td>
                                <td>$ 35</td>
                            </tr>
                            <tr>    
                                <td>Oro</td>
                                <td>$ 70 + 1 % de rentabilidad</td>
                            </tr>
                            <tr>
                                <td>Platino</td>
                                <td>$ 84 + 2 % de rentabilidad</td>
                            </tr>
                            <tr>
                                <td>Diamante</td>
                                <td>$ 140 + 3 % de rentabilidad</td>
                            </tr>
                            <tr>
                                <td>Vip</td>
                                <td>Consulta con el administrador</td>
                            </tr>
                            <!-- and so on... -->
                        </tbody>
                    </table> --}}
                     
            </div>

        </div>
    <div class="col-3">
        <div class="counter bg-1  h-100  d-flex text-align-center align-items-center justify-content-center p-3"  id="rounded-container">
            {{$qrCode ?? ''}}

        </div>
    </div>
</div>

<div class="row row-fil3-client">
    <div class="col p-3">
      <div class="counter h-100 w-100 bg-1   d-flex text-align-center align-items-center justify-content-center "  id="rounded-container">

        @if (!empty($chartDataSus ?? ''))
            <div id="chart-sus" class="bg-1 rounded" style="height: 16vw; width: 35vw;"></div>
        @else
            {{-- <div class="  bg-1 container-size"> --}}
                <div class="chart-container">
                    <div class="chart-overlay">Ejemplo</div>
                    <div id="chart-demo" style="height: 16vw; width: 35vw;"></div>

                </div>
                {{-- <p class="text-center text-muted justify-content-center align-content-center d-flex"> No hay información disponible para realizar un gráfico.</p> --}}
           {{-- </div> --}}
        @endif
      </div>
    </div>
    <div class="col p-3">
      <div class="counter h-100 w-100 bg-1   d-flex text-align-center align-items-center justify-content-center "  id="rounded-container">

        @if (!empty($porcentajeInvitados ?? '' )) 
            <div id="porcentaje_subs"  style="width: 26vw;"></div>
        @else
            <div class="chart-container">
                <div class="chart-overlay">Ejemplo</div>
                <div id="chart-demo-dona" style="width: 26vw;" ></div>
            </div>
            {{-- <p class="text-center text-muted mt-5">No hay información disponible para realizar un gráfico.</p> --}}
        @endif

      </div>
    </div>

</div>
<script>
    var chartDataSus=@json($chartDataSus ?? []);
    // console.log(chard)
    var porcentajeInvitados=@json($porcentajeInvitados ?? '');
    var chartLabels=@json($chartLabels ?? '');
</script>
<script src="{{mix('js/suscriptor.js')}}"></script>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        alert("Enlace copiado al portapapeles.");
    }
</script>

@endsection 
