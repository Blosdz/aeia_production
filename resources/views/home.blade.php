@extends('layouts_new.app')

@section('content')
@php
    $user_session = Auth::user();
    $user = Auth::user();
    $user_code = $user->unique_code; 
    $profile = $user->profile;

@endphp
@if($user->validated==0)
<div class="alert alert-info" role="alert">
        Tu perfil no está verificado. Ingresa a la opción Verificación del menú lateral y completa la información requerida.
</div>
@endif
@if($user_session->rol==2)


@elseif($user_session->rol == 3 || $user_session->rol == 4)
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row justify-content-center align-items-center">

        {{-- ingresos --}}
        <div class="col-xl-4 col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Balance General</div>
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

        <div class="col-xl-4 col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Cierre De Ciclo
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="countdown">

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-6 col-md-3 mb-4">
            <div class="card shadow d-flex "  id="rounded-container">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <h1 class="display-4">Bienvenido</h1>
                            <br>
                            <p class="lead">¡Qué gusto verte de nuevo! {{ $userProfile->first_name ?? '' }}</p>
                            @if($user->validated == 1)
                                <h4 class="text-success fw-bold">Su cuenta ha sido verificada, ya puedes invertir</h4>
                            @else
                                <h4 class="text-danger fw-bold">Su cuenta aún no esta verificada</h4>
                            @endif
                        </div>
                        <div class="col-auto">
                                @if ($profile && $profile->profile_picture)
                                    <img src="/storage/{{$profile->profile_picture}}" class="img-fluid profile-picture"  style="width: 10vw !important; border-radius:100% !important;" />
                                @else 
                                    <img src="/images/user-icon.png" class="img-fluid profile-picture" style="width: 45px !important; border-radius:100% !important;" />
                                @endif
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="col-md-6"> --}}
        <div class="col-xl-6 col-auto">

            <div class="stack ">
                @if(isset($plans) && count($plans) > 0)
                    @foreach($plans as $plan)
                        <div class="card d-flex flex-row align-items-center m-2">
                            <div class="d-flex justify-content-center p-3">
                                <img src="/welcome_new/images/icons/{{ $plan->logo }}" alt="Logo" style="width:6vw">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span>Plan: {{$plan->name}}</span>
                                    <p>Depósito permitido desde:</p>
                                <b>${{ $plan->minimum_fee }} a {{ $plan->maximum_fee ? '$' . $plan->maximum_fee : 'más' }}</b>
                                <p>Membresía: ${{$plan->annual_membership}}</p>
                                <p>Comisión: {{$plan->commission}}%</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No hay planes disponibles.</p>
                @endif
            </div>
        </div>
        {{-- </div> --}}
    </div>

    <div class="row  row-fil3-client">
        <div class="col p-3">
          <div class="counter w-100 h-100 bg-1 d-flex text-align-center align-items-center justify-content-center container-size"  id="rounded-container">

            @if (!empty($planData ?? ''))
                <div id="chart" class="rounded p-4"></div>
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
            <div class="counter bg-1 w-100 h-100 d-flex text-align-center align-items-center justify-content-center container-size"  id="rounded-container">

                @if (!empty($porcentajeInvertido ?? ''))
                    <div id="chart-dona" class="p-4"></div>
                @else
                    <div class="chart-container">
                        <div class="chart-overlay">Ejemplo</div>
                        <div id="chart-demo-dona" style="height:16vw ; width: 35vw;" ></div>

                    </div>
                    {{-- <p class="text-center text-muted mt-5">No hay información disponible para realizar un gráfico.</p> --}}
                @endif         

            </div>
        </div>
    </div>

    @if($planData ?? '')
        @foreach($planData ?? '' as $planName => $data)
        <div class="row row-fil1-client h-100 w-100">
            <div class="col-4">
                <div class="w-100 p-4 d-flex justify-content-between align-items-center bg-1 " id="rounded-container">
                    <div class="h-100 w-100 row">
                        <div class="col   d-flex text-align-center align-items-center justify-content-center  ">
                            <img src="/welcome_new/images/icons/{{$planName}}.png" alt="Logo" style="width:3vw">
                        </div>
                        <div class="col">
                            <h2 class="fw-bolder">$ <span class="count">{{$data['inversion_inicial']}}</span></h2>
                            <span>Total Invertido En plan {{ $planName }}</span>
 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 p-4">
                <div class="w-100 h-100 d-flex bg-1 " id="rounded-container">
                        @if (!empty($data['data']))
                          <div id="chart_{{ $planName }}" class="rounded p-4"></div>
                        @else
                            <p class="text-center text-muted mt-5">No hay información disponible para realizar un gráfico.</p>
                        @endif
                </div>
            </div>
        </div>
        @endforeach
    @endif
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     let stack = document.querySelector(".stack");
    
    //     [...stack.children].reverse().forEach(i => stack.append(i));
    
    //     stack.addEventListener("click", swap);
    
    //     function swap(e) {
    //         let card = document.querySelector(".card:last-child");
    //         if (e.type === 'click' && e.target !== card) return;
    //         card.style.animation = "swap 700ms forwards";
        
    //         setTimeout(() => {
    //             card.style.animation = "";
    //             stack.prepend(card);
    //         }, 700);
    //     }
    
    //     // Cambiar tarjeta automáticamente cada 5 segundos
    //     setInterval(() => {
    //         swap(new Event('autoSwap'));
    //     }, 5000);
    // });


</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const interval = @json($interval ?? '');
        const days = interval.days;
        const hours = interval.h;
        const minutes = interval.i;
        const seconds = interval.s;

        let countdownDate = new Date();
        countdownDate.setDate(countdownDate.getDate() + days);
        countdownDate.setHours(countdownDate.getHours() + hours);
        countdownDate.setMinutes(countdownDate.getMinutes() + minutes);
        countdownDate.setSeconds(countdownDate.getSeconds() + seconds);

        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const d = Math.floor(distance / (1000 * 60 * 60 * 24));
            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = d + "d " + h + "h " + m + "m " + s + "s ";

            if (distance < 0) {
                clearInterval(x);
                countdownElement.innerHTML = "EXPIRED";
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>

<script>
    var planData = @json($planData ?? '');
    var donaDataClient = @json($porcentajeInvertido ?? '');
    var donaSeries=[donaDataClient,100-donaDataClient];
    console.log(planData); // Verifica que los datos se están pasando correctamente
    // console.log(donaDataClient); // Verifica que los datos se están pasando correctamente
    // console.log(donaSeries); // Verifica que los datos se están pasando correctamente
</script>
<script src="{{mix('js/charts.js')}}"></script>

@elseif ($user_session->rol == 5)
<div class="row">
    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="h-100 w-100">
                    <div class="count-i rounded-circle i-bg wht position-relative align-content-center">
                        <i class="far fa-eye      d-flex text-align-center align-items-center justify-content-center  "></i>
                    </div>
                    <h2>Invitar a nuevos usuarios</h2>
                    <h2 class="text-light fw-bolder"> 
                        <p>Invita a nuevos usuarios utilizando el siguiente enlace:</p>
                    </h2>

                    <input type="text" class="form-control" id="inviteLink" value="{{$inviteLink ?? ''}}" readonly>
                </div>
                <div class="count-r h-100 w-50 text-end align-self-end">
                    <span class="text-success fw-bold">
                        <button class="btn btn-primary" onclick="copyToClipboard('#inviteLink')">Copiar Enlace</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="h-100 w-50">
                    <div class="count-i rounded-circle i-bg wht position-relative align-content-center">
                        <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i>
                    </div>
                    <h2 class="text-light fw-bolder">$ <span class="count">{{$montoGenerado ?? ''}}</span></h2>
                    <span>Total Generado</span>
                </div>
                <div class="count-r h-100 w-50 text-end align-self-end">
                    <span class="text-success fw-bold"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="h-100 w-50">
                    <div class="count-i rounded-circle i-bg wht position-relative align-content-center">
                        <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center "></i>
                    </div>
                    <h2 class="text-light fw-bolder"><span class="count">{{ $dataInvitados ?? ''}}</span></h2>
                    <span>Total de Suscriptores</span>
                </div>
                <div class="count-r h-100 w-50 text-end align-self-end">
                    <span class="text-success fw-bold"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 p-3">
        <div class="counter h-100 w-100 bg-1"  id="rounded-container">
            <div class="w-100 p-3 d-flex justify-content-between align-items-center">
                <div class="h-100 w-50">
                    <div class="count-i rounded-circle i-bg wht position-relative align-content-center">
                        <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center "></i>
                    </div>
                    <h2 class="text-light fw-bolder"><span class="count">{{ $totalPlanesVendidos ?? ''}}</span></h2>
                    <span>Planes vendidos de Suscriptores</span>
                </div>
                <div class="count-r h-100 w-50 text-end align-self-end">
                    <span class="text-success fw-bold"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-md-6">
            <div class="h-100 w-100 bg-1 d-flex justify-content-center "  id="rounded-container">
                <div class="container w-60 p-4">
                    <h1 class="display-4">Bienvenido</h1>
                    <br>
                    <p class="lead">¡Qué gusto verte de nuevo!</p>
                    <p>Controla tus inversiones</p>
                </div>
                <div class="container w-40 h-100">
                    <div class="content h-100 justify-content-center align-items-center text-center mt-5">
                        @include('layouts_new.nav')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="h-100 w-50 bg-1 "  id="rounded-container">
                <div class="h-100 justify-content-center overflow-scroll align-content-center">
                    {{-- qrdata --}}
                </div>
            </div>

        </div>
    <div class="col-3">
        <div class="counter bg-1  h-100  d-flex text-align-center align-items-center justify-content-center"  id="rounded-container">

            @if (!empty($Total ?? ''))
                <div id="chart_dona" class="" style="height: 16vw; width: 35vw;"></div>
            @else
                <p class="text-center text-muted mt-5">No hay información disponible para realizar un gráfico.</p>
            @endif         

        </div>
    </div>
</div>

<div class="row">
    <div class="col p-3">
      <div class="counter h-100 w-100 bg-1   d-flex text-align-center align-items-center justify-content-center "  id="rounded-container">

        @if (!empty($totalVentas ?? ''))
            <div id="chart_monto_generado" class="bg-1 rounded" style="height: 16vw; width: 35vw;"></div>
        @else
            <p class="text-center text-muted justify-content-center align-content-center d-flex"> No hay información disponible para realizar un gráfico.</p>
        @endif

      </div>
    </div>
    <div class="col p-3">
      <div class="counter h-100 w-100 bg-1   d-flex text-align-center align-items-center justify-content-center "  id="rounded-container">

        @if (!empty($porcentajeInvitados ?? '' ?? '')) 
            <div id="porcentaje_subs" class="bg-1 rounded" style="height: 16vw; width: 35vw;"></div>
        @else
            <p class="text-center text-muted justify-content-center align-content-center d-flex"> No hay información disponible para realizar un gráfico.</p>
        @endif

      </div>
    </div>

</div>
<script>
    var chartValues=@json($chartValues ?? '');
    var porcentajeInvitados=@json($porcentajeInvitados ?? '' ?? '');
    var chartLabels=@json($chartLabels ?? '');
</script>

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

@elseif ($user_session->rol == 6 )


@elseif ($user_session->rol == 8 )
    <div class="row w-100 h-100 bg-1 p-5" id="rounded-container">
        <div class="col-md-5 h-100 w-100">
            <div class="card-header bg-1">
                <h2>Bienvenido, Banco</h2>
            </div>
            <div class="card-body">
                <p>Estimado Banco,</p>
                <p>Nos complace darte la bienvenida a nuestra plataforma. Aquí podrás visualizar y gestionar los datos de nuestros clientes. A continuación, encontrarás algunas de las funcionalidades que podrás utilizar:</p>
                <ul>
                    <li><b>Visualización de Clientes:</b> Accede a información detallada de todos tus clientes, incluyendo datos personales, estado de verificación y historial de pagos.</li>
                    {{-- <li><b>Gestión de Pagos:</b> Revisa y gestiona todos los pagos realizados por tus clientes. Podrás ver el total de pagos acumulados y los detalles de cada transacción.</li> --}}
                    <li><b>Documentación:</b> Consulta y descarga documentos importantes relacionados a nuestros clientes, como contratos, comprobantes de pago y otros archivos relevantes.</li>
                    {{-- <li><b>Informes Personalizados:</b> Genera informes detallados sobre la actividad de tus clientes, permitiéndote tomar decisiones informadas y estratégicas.</li> --}}
                </ul>
                <p>Estamos comprometidos a proporcionarte las herramientas necesarias para que puedas llevar a cabo tu labor de manera óptima. Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nuestro equipo de soporte.</p>
                <p>¡Gracias por confiar en nosotros!</p>
                <p>Atentamente,<br>El equipo de AEIA INVESMENT</p>
            </div>
       </div>
        <div class="col-md-5 h-100 w-100" id="rounded-container">
            <div class="card-header bg-1">
                <h2>AEIA INVESMENT</h2>
            </div>
            <div class="card-body">
                <p><b>Contáctanos</b></p>
                <p>Teléfono: +123 456 7890</p>
                <p>Email: soporte@aeiainvestment.com</p>
                <p>Estamos aquí para ayudarte con cualquier duda o consulta que puedas tener. No dudes en ponerte en contacto con nosotros.</p>
            </div>

        </div>
    </div>
@endif

@endsection


@section('content_mobile')
    @if($user_session->rol==3 || $user_session->rol==4)
        <div class="row  p-3">
            <div class="counter w-100 h-100 bg-1 d-flex text-align-center align-items-center justify-content-center container-size"  id="rounded-container">

            </div> 
        </div>
        <div class="row p-3">
            <div class="counter bg-1 w-100 h-100 d-flex text-align-center align-items-center justify-content-center container-size"  id="rounded-container">

            </div>
        </div>
        <div class="row">
            <div class="col p-3">
                <div class="row p-3 d-flex justify-content-between align-items-center bg-1" id="rounded-container">
                    <div class="col">
                        <h2 class="fw-bolder">$ {{$totalInversionYBeneficio ?? ''}} </h2>
                        <span>Balance General</span>
                    </div>
                    <div class="col">
                        <span class="rounded-span">
                            <i class="fa-duotone fa-solid fa-chart-line"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col p-3">
                <div class="row p-3 d-flex justify-content-between align-items-center bg-1" id="rounded-container">
                    <div class="col">
                        <h2 class="fw-bolder">$ {{$paymentsTotal ?? ''}} </h2>
                        <span>Capital Invertido</span>
                    </div>
                    <div class="col">
                        <span class="rounded-span">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col p-3">
                <div class="counter w-100"  >
                    <div class="w-100 p-3 d-flex justify-content-between align-items-center bg-1" id="rounded-container">
                        {{-- count down to this 28 timer --}}
                        <div class="col h-100">
                            <h2 id="countdown"></h2>
                            <span>Cierre de Ciclo </span>
                        </div>
                        <div class="col-3 h-100">
                            <span class="rounded-span">
                                <i class="fa-regular fa-clock"></i>
                            </span>
                        </div>
                        {{-- .col-3 --}}
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="stack">
                @if(isset($plans) && count($plans) > 0)
                    @foreach($plans as $plan)
                        <div class="card d-flex flex-row align-items-center m-2">
                            <div class="d-flex justify-content-center p-3">
                                <img src="/welcome_new/images/icons/{{ $plan->logo }}" alt="Logo" style="width:6vw">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <span>Plan: {{$plan->name}}</span>
                                    <p>Depósito permitido desde:</p>
                                <b>${{ $plan->minimum_fee }} a {{ $plan->maximum_fee ? '$' . $plan->maximum_fee : 'más' }}</b>
                                <p>Membresía: ${{$plan->annual_membership}}</p>
                                <p>Comisión: {{$plan->commission}}%</p>
                            </div>
                        </div>
                    @endforeach
                    @else
                        <p>No hay planes disponibles.</p>
                @endif
            </div>
        </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let stack = document.querySelector(".stack");
    
        [...stack.children].reverse().forEach(i => stack.append(i));
    
        stack.addEventListener("click", swap);
    
        function swap(e) {
            let card = document.querySelector(".card:last-child");
            if (e.type === 'click' && e.target !== card) return;
            card.style.animation = "swap 700ms forwards";
        
            setTimeout(() => {
                card.style.animation = "";
                stack.prepend(card);
            }, 700);
        }
    
        // Cambiar tarjeta automáticamente cada 5 segundos
        setInterval(() => {
            swap(new Event('autoSwap'));
        }, 5000);
    });


</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const interval = @json($interval ?? '');
        const days = interval.days;
        const hours = interval.h;
        const minutes = interval.i;
        const seconds = interval.s;

        let countdownDate = new Date();
        countdownDate.setDate(countdownDate.getDate() + days);
        countdownDate.setHours(countdownDate.getHours() + hours);
        countdownDate.setMinutes(countdownDate.getMinutes() + minutes);
        countdownDate.setSeconds(countdownDate.getSeconds() + seconds);

        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const d = Math.floor(distance / (1000 * 60 * 60 * 24));
            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = d + "d " + h + "h " + m + "m " + s + "s ";

            if (distance < 0) {
                clearInterval(x);
                countdownElement.innerHTML = "EXPIRED";
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>

<script>
    var planData = @json($planData ?? '');
    var donaDataClient = @json($porcentajeInvertido ?? '');
    var donaSeries=[donaDataClient,100-donaDataClient];
    // console.log(planData); // Verifica que los datos se están pasando correctamente
    // console.log(donaDataClient); // Verifica que los datos se están pasando correctamente
    // console.log(donaSeries); // Verifica que los datos se están pasando correctamente
</script>

@endif

@endsection