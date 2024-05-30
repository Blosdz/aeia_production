@php
    $user = Auth::user();
    $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp

@extends('layouts.app')

<style>
    .center-img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>

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
                             Depositos
                         </div>
                         <div class="card-body">
                         @php
                            if($user->validated) {
                        @endphp
                            <div class="row col-12">
                                {!!Form::open(['route'=>'clients.filter','class'=>'col-10 row'])!!}
                                <div class="form-group col-sm-4">
                                    {!! Form::label('plan', 'Planes:') !!}
                                    {!! Form::select('plan', ["Todos"]+$plans,null, ['class' => 'form-control', 'value'=>'-']) !!}
                                </div>
                                <div class="form-group col-sm-3">
                                    {!! Form::label('funds', 'Fondos:') !!}
                                    {!! Form::select('funds', $months,null, ['class' => 'form-control', 'value'=>'-']) !!}
                                </div>
                                <div class="form-group col-sm-3">
                                    {!! Form::label('year', 'Año:') !!}
                                    {!! Form::number('year',null, ['class' => 'form-control','min'=>'0']) !!}
                                </div>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('filtrar', '&nbsp;') !!}
                                    {!! Form::submit('Filtrar', ['class' => 'form-control btn btn-primary']) !!}
                                </div>
                                {!!Form::close()!!}
                                <div class="form-group col-sm-2">
                                    {!! Form::label('filtrar', '&nbsp;') !!}
                                    <a href="{{route('payment.plan')}}" class="form-control btn btn-success">Nuevo depósito</a>
                                </div>
                            </div>
                             @include('payments.clients_table')
                        @php
                            } else {
                        @endphp
                            <div class="alert alert-danger" role="alert">
                                No tiene habilitado esta accion hasta que su cuenta se validada
                            </div>
                        @php
                            }
                        @endphp
                         </div>

                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

