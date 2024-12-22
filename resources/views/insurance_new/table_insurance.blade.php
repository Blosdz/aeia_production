@extends('layouts_new.app')

@section('content')

<div class="alert alert-danger mt-3" id="verificationAlert" style="display: none;" role="alert">
    Tu Usuario aún no ha sido validado, por favor espera a que el administrador lo valide.
    {{-- Verifica tu usuario antes de realizar un nuevo depósito --}}
    <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert()"></button>
</div>

@if($user_session->rol == 3 || $user_session->rol == 4)
    <div class="row bg-1 flex-grow-1 p-4 overflow-auto" id="rounded-container">
        @include('insurance_new.table_clientes')
    </div>
@elseif($user_session->rol == 1 || $user_session->rol == 6)
    <div class="row bg-1 flex-grow-1 p-4 overflow-auto" id="rounded-container">
        @include('insurance_new.table_admin')
    </div>
@endif


@endsection