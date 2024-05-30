@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Depositos</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Selecciona tu plan
                        </div>
                        <div class="card-body">
                            
                            <div class="pull-right mx-3">
                                <div class="card-columns">
                                    @for ($i = 0 ; $i < 3 ; $i ++)
                                        <div class="card p-3" style="background-color: #1c2a5b; color:white">
                                            <span>
                                                <h1 class="float-left">{{$plans[$i]->name}}</h1> 
                                                <img class="card-img-top float-right" style ="width: 15%" src="/welcome_new/images/icons/{{$plans[$i]->logo}}" alt="Card image cap">
                                                &nbsp;
                                            </span>
                                            <div class="card-body text-center">
                                                <p class="card-text mt-4 text-left"> Deposito permitido desde: </p>
                                                <p><h1 class="" style="color: #eab226"><b>${{$plans[$i]->minimum_fee}} a {{$plans[$i]->maximum_fee?'$'.$plans[$i]->maximum_fee:"más"}}</b></h1></p>
                                                <p class="text-left"><b>Membresía: </b> ${{$plans[$i]->annual_membership}}/Anual</p>
                                                <p class="text-left"><b>Comisión: </b> {{$plans[$i]->commission}}%</p>
                                                <p>"La comisión se ejecuta sobre la ganancia y se realiza al finalizar el ciclo de inversión"</p>
                                                
                                                <a href="{{ route('payment.detail', [$plans[$i]->id]) }}" class="btn btn-success btn-xl px-5"><h2>Invertir</h2></a>
                                            </div>
                                        </div>
                                        <div class="card p-3" style="background-color: #1c2a5b; color:white">
                                            <span>
                                                <h1 class="float-left">{{$plans[$i+3]->name}}</h1> 
                                                <img class="card-img-top float-right" style ="width: 15%" src="/welcome_new/images/icons/{{$plans[$i+3]->logo}}" alt="Card image cap">
                                                &nbsp;
                                            </span>
                                            <div class="card-body text-center">
                                                <p class="card-text mt-4 text-left"> Deposito permitido desde: </p>
                                                <p><h1 class="" style="color: #eab226"><b>${{$plans[$i+3]->minimum_fee}} a {{$plans[$i+3]->maximum_fee?'$'.$plans[$i+3]->maximum_fee:"más"}}</b></h1></p>
                                                <p class="text-left"><b>Membresía: </b> ${{$plans[$i+3]->annual_membership}}/Anual</p>
                                                <p class="text-left"><b>Comisión: </b> {{$plans[$i+3]->commission}}%</p>
                                                <p>"La comisión se ejecuta sobre la ganancia y se realiza al finalizar el ciclo de inversión"</p>
                                                
                                                <a href="{{ route('payment.detail', [$plans[$i+3]->id]) }}" class="btn btn-success btn-xl px-5"><h2>Invertir</h2></a>
                                            </div>
                                        </div>
                                    @endfor
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection