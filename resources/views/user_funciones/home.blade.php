@extends('layouts_new.app')
@section('content')
<style>
    .stack {
    position: relative; /* Para posicionar los elementos relativos al contenedor */
}

.stack > div {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    transition: opacity 0.5s ease, transform 0.5s ease;
    z-index: 0;
}

.stack > div.active {
    opacity: 1;
    z-index: 1; /* El elemento activo siempre estará al frente */
    transform: scale(1.05); /* Opcional: Añadir un pequeño zoom al elemento activo */
}

</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row justify-content-center align-items-center">

    {{-- ingresos --}}
    <div class="col-xl-4 col-md mb-4">
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
    <div class="col-xl-4 col-md mb-4">
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

    <div class="col-xl-4 col-md mb-4">
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
        <div class="card shadow ">
            <div class="card-header ">
                <div class="m-0 font-weight-bold text-primary">
                    Fondo General
                </div>

            </div>
            <div class="card-body">
                    <div id="chart" class="rounded p-4"></div>


            </div>
        </div>
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
                <div class="card shadow ">
                    <div class="card-header ">
                        <div class="m-0 font-weight-bold text-primary">
                            Fondo General
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="chart-dona" class="p-4"></div>
                    </div>
                </div>

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
        <div class="col-4 ">
            <div class="w-100 card border-left-primary shadow py-2 p-4 d-flex justify-content-between align-items-center " id="rounded-container">
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
            <div class="w-100 h-100 card shadow d-flex bg-1 " id="rounded-container">
                    @if (!empty($data['data']))
                    <div class="card-body">

                      <div id="chart_{{ $planName }}" class="rounded p-4"></div>

                    </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const stack = document.querySelector(".stack");
    if (stack) {
        const cards = Array.from(stack.children); // Obtener todos los elementos dentro del stack
        let currentIndex = 0;

        setInterval(() => {
            // Remover la clase "visible" del elemento actual
            cards[currentIndex].classList.remove("active");

            // Calcular el siguiente índice
            currentIndex = (currentIndex + 1) % cards.length;

            // Agregar la clase "visible" al siguiente elemento
            cards[currentIndex].classList.add("active");
        }, 5000); // Cambiar cada 5 segundos
    }
});

</script>

@endsection