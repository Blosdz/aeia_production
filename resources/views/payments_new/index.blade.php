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

{{-- Si el rol es 3 --}}
@if ($user_session->rol == 3)
    {{-- @if ($user_session->validated == 1) --}}
        {{-- <a href="{{ route('payment.plan') }}" style="background-color:green" class="form-control btn btn-success">Nuevo depósito</a> --}}
    {{-- @else --}}
        {{-- <button type="button" class="form-control btn btn-success" onclick="showAlert()">Nuevo depósito</button> --}}
    {{-- @endif --}}

    <div class="row bg-1 flex-grow-1 p-4 overflow-auto" id="rounded-container">
        @include('payments_new.table_clientes')
    </div>
@endif

{{-- Si el rol es 1 o 6 --}}
@if ($user_session->rol == 1 || $user_session->rol == 6)
    @include('payments_new.table_admin')
@endif

<script>
    function showAlert() {
        document.getElementById('verificationAlert').style.display = 'block';
    }

    function closeAlert() {
        document.getElementById('verificationAlert').style.display = 'none';
    }
</script>

@endsection
