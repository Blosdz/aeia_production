@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Depósitos</h1>
</div>

<div class=" card shadow mb-4 row  " id="rounded-container">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Selecciona tu plan</h6>
    </div>
    <div class="card-body">

        
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false"> <!-- Agrega data-interval="false" para desactivar el movimiento automático -->
            <div class="carousel-inner">
                @for($i = 0; $i < 6; $i++)
                    @if($i % 3 == 0)
                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center">
                    @endif
                                    <div class="col-md-3 d-flex align-items-stretch">
                                        <div class="card bg-1 m-2 text-center" style="width: 18rem; height:45rem;">
                                            <div class="d-flex justify-content-center p-3">
                                                <img class="card-img-top" src="/welcome_new/images/icons/{{$plans[$i]->logo}}" alt="Card image cap" style="width:6vw">
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{$plans[$i]->name}}</h5>
                                                {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                                <p class="card-text mt-4 text-left"> Deposito permitido desde: </p>
                                                <p><h1 class="" style="color: #eab226"><b>${{$plans[$i]->minimum_fee}} a {{$plans[$i]->maximum_fee ? '$'.$plans[$i]->maximum_fee : "más"}}</b></h1></p>
                                                <p class="text-left"><b>Membresía: </b> ${{$plans[$i]->annual_membership}}/Anual</p>
                                                <p class="text-left"><b>Comisión: </b> {{$plans[$i]->commission}}%</p>
                                                <p>"La comisión se ejecuta sobre la ganancia y se realiza al finalizar el ciclo de inversión"</p>
                                                <a href="{{ route('payment.detail', [$plans[$i]->id]) }}" class="btn btn-success btn-xl px-5"><h2>Invertir</h2></a>
                                            </div>
                                        </div>
                                    </div>
                    @if($i % 3 == 2 || $i == 5)
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
            <a class="carousel-control-prev custom-carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next custom-carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</div>

@endsection

<style>
    .carousel-control-prev-icon{
        background-color: #646464 !important;
        border-radius: 2vw;
        padding: 2vw !important;
        /* width: 40px; */
        /* height: 40px; */
        /* display: flex; */
        /* align-items: center; */
        /* justify-content: center; */
    }
    .custom-carousel-control .carousel-control-prev-icon,
    .custom-carousel-control .carousel-control-next-icon {
        background-size: 100%, 100%;
    }
</style>
    
    

<style>
.carousel-control-next-icon {
    /* background-color: #000000 !important; */
    border-radius: 2vw;
    padding: 2vw !important;
    animation: breath 3s infinite;
}

@keyframes breath {
    0%, 100% {
        background-color: #000000;
    }
    50% {
        background-color: silver;
    }
}

.custom-carousel-control .carousel-control-prev-icon,
.custom-carousel-control .carousel-control-next-icon {
    background-size: 100%, 100%;
}
</style>
