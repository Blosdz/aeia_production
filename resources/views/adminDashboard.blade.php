@extend('layouts_new.app')

@section('content')
@php
    $user_session = Auth::user();
    $user = Auth::user();
    $profile = $user->profile;

@endphp

@if($user_session->rol==1)
    <strong>Dashboard</strong>

    <div class="row">
        <div class="col-3 p-3">
            <div class="counter h-100 w-100 bg-1" id="rounded-container">
                <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                        <div class="col h-100">
                            <h2 class="fw-bolder">$ {{$membresias->membership_collected ?? ''}} </h2>
                            <span>Total Membresias</span>
                        </div>
                        <div class="col-3 h-100">
                            <span class="rounded-span">
                                <i class="fa-duotone fa-solid fa-chart-line"></i>
                            </span>
                            {{-- <i></i> --}}
                        </div>
                        {{-- <span class="rounded-span">
                            <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i>
                            </span>
                            <h2 class="text-light fw-bolder">$ <span class="count">{{$totalInversionYBeneficio ?? ''}}</span></h2>
                            <span>Total</span>--}}
                    {{-- 
                        <div class="count-r h-100 w-50 text-end align-self-end">
                            <span class="text-success fw-bold"></span>
                        </div> 
                    --}}
                </div>
            </div>
        </div>
        <div class="col-3 p-3">
            <div class="counter h-100 w-100 bg-1 "  id="rounded-container">
                <div class="row w-100 p-3 d-flex justify-content-between align-items-center">
                    <div class="col h-100">
                        <h2 class="fw-bolder">${{$totalsumado ?? ''}}</h2>
                        <span>Capital Comisionado</span>
                    </div>
                    <div class="col-3 h-100">
                        <span class="rounded-span">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            {{-- <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i> --}}
                        </span>
                    </div>
                    {{-- <div class="h-100 w-50">
                        <div class="count-i rounded-circle i-bg wht position-relative align-content-center">
                            <i class="far fa-eye  d-flex text-align-center align-items-center justify-content-center"></i>
                        </div>
                        <h2 class="text-light fw-bolder">$ <span class="count">{{$totalInversionPlanes ?? ''}}</span></h2>
                        <span>Total Recaudado</span>
                        </div>
                        <div class="count-r h-100 w-50 text-end align-self-end">
                            <span class="text-success fw-bold"></span>
                        </div> 
                    --}}
                </div>
            </div>
        </div>

        <div class="col-3 p-3">
            <div class="counter h-100 w-100 bg-1 "  id="rounded-container">
                <div class="w-100 p-3 d-flex justify-content-between align-items-center">
                    <div class="col h-100">
                        <h2 id="countdown"></h2>
                        <span>Usuarios Conectados </span>
                    </div>
                    <div class="col-3 h-100">
                        <span class="rounded-span">
                            <i class="fa-regular fa-clock"></i>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">    
        <div class="col">
            <div class="h-100 w-100 bg-1 d-flex justify-content-center "  id="rounded-container">

                <div class="container w-100 p-4">
                    <div class="graph_general">
                    </div>
                    <div class="container w-40 h-100 d-flex-end" >
                        <ul>
                        {{--@foreach($fondos as $fondo)
                            <li>$fondo->id</li>
                        @endforeach--}}
                        </ul>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
    
    <strong>Tokens </strong> 
    <div class="row">
        <div class="col">
            <div class="h-100 w-100 bg-1 d-flex justify-content-center p-2" id="rounded-container">
                <table class="w-100" id="rounded-container">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <th>Prices</th>
                            <th>Porcentage</th>
                            <th>Action</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@endsection