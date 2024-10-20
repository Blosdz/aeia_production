@extends('layouts_new.app')

@section('content')
<div class="alert alert-danger mt-3" id="verificationAlert" style="display: none;" role="alert">
    Verifica tu usuario antes de realizar un nuevo depósito
    <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert()"></button>
</div>

@php
  $user_session = Auth::user();
  $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp

@php
if($user_session->rol == 3){
@endphp
    <strong>Depósitos</strong>
    <div class="row bg-1 w-100 h-100 p-4 " id="rounded-container">
        <div class="row col-12">
            {!! Form::open(['route'=>'clients.filter','class'=>'col-10 row']) !!}
            <div class="form-group col-sm-4">
                {!! Form::label('plan', 'Planes:') !!}
                {!! Form::select('plan', ["Todos"] + $plans, null, ['class' => 'form-control', 'value'=>'-']) !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::label('funds', 'Fondos:') !!}
                {!! Form::select('funds', $months, null, ['class' => 'form-control', 'value'=>'-']) !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::label('year', 'Año:') !!}
                {!! Form::number('year', null, ['class' => 'form-control','min'=>'0']) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label('filtrar', '&nbsp;') !!}
                {!! Form::submit('Filtrar', ['class' => 'form-control btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
            <div class="form-group col-sm-2">
                {!! Form::label('filtrar', '&nbsp;') !!}
                @if ($user_session->validated == 1)
                    <a href="{{ route('payment.plan') }}" style="background-color:green" class="form-control btn btn-success">Nuevo depósito</a>
                @else
                    <button type="button" class="form-control btn btn-success" onclick="showAlert()">Nuevo depósito</button>
                @endif
            </div>
        </div>
        <div class="row bg-1 flex-grow-1 p-4 overflow-auto" id="rounded-container">
            @include('payments_new.table2')
        </div>
    </div>
@php
}
@endphp

@php
if($user_session->rol == 1 || $user_session->rol == 6){
@endphp
    <strong>Depositos</strong>
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-1">
                    <div class="card-header bg-1">
                        <i class="fa fa-align-justify text-center align-content-center"></i>
                    </div>
                    <div class="card-body">
                        @include('payments_new.table')
                        <div class="pull-right mr-3">
                            <!-- Other elements here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@php
}
@endphp

<script>
    function showAlert() {
        document.getElementById('verificationAlert').style.display = 'block';
    }

    function closeAlert() {
        document.getElementById('verificationAlert').style.display = 'none';
    }
</script>

@endsection


@section('content_mobile')

@if($user_session->rol ==1 || $user_session->rol==6)

    <strong>Depósitos</strong>
    <div class="animated fadeIn">
        <div class="row">
           <div class="col-lg-12">
               <div class="card bg-1">
                       @include('payments_new.table_mobile')
               </div>
           </div>
        </div>   
    </div>
@elseif($user_session->rol == 3)
    <strong>Depósitos</strong>
    <div class="row bg-1 w-100 h-100 pt-4 " id="rounded-container">
        <div class="row col">
            {!! Form::open(['route'=>'clients.filter','class'=>'col-10 row']) !!}
            <div class="form-group col">
                {!! Form::label('plan', 'Planes:') !!}
                {!! Form::select('plan', ["Todos"] + $plans, null, ['class' => 'form-control', 'value'=>'-']) !!}
            </div>
            <div class="form-group col">
                {!! Form::label('funds', 'Fondos:') !!}
                {!! Form::select('funds', $months, null, ['class' => 'form-control', 'value'=>'-']) !!}
            </div>
            <div class="form-group col">
                {!! Form::label('year', 'Año:') !!}
                {!! Form::number('year', null, ['class' => 'form-control','min'=>'0']) !!}
            </div>

        </div>
        <div class="form-group row p-3">
            {!! Form::label('filtrar', '&nbsp;') !!}
            {!! Form::submit('Filtrar', ['class' => 'form-control btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
        <div class="form-group row p-3">
            {!! Form::label('filtrar', '&nbsp;') !!}
            @if ($user_session->validated == 1)
                <a href="{{ route('payment.plan') }}" style="background-color:green" class="form-control btn btn-success">Nuevo depósito</a>
            @else
                <button type="button" class="form-control btn btn-success" onclick="showAlert()">Nuevo depósito</button>
            @endif
        </div>
        <div class="row flex-grow-1 overflow-auto pb-3" id="rounded-container">
            @include('payments_new.table2_mobile')
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll(".accordion-button");

        buttons.forEach(button => {
            button.addEventListener("click", () => {
                const parentRow = button.closest(".products-row.item");
                const infoRow = parentRow.nextElementSibling;

                // Alternar la visibilidad de la fila de información adicional
                parentRow.classList.toggle("active");
                infoRow.style.display = infoRow.style.display === "none" || infoRow.style.display === "" ? "block" : "none";
            });
        });
    });
</script>


@endsection