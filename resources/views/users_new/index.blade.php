@extends('layouts_new.app')

@section('content')

<strong>Suscriptores / Clientes / Business</strong>

    <div class="row">
        <div class="animated fadeIn">
             @include('flash::message')
            <div class="row" id="contracts-row-1">
                <div class="contracts-outher-table">
                      @include('users.table')
                
                </div>    
            </div>
        </div>
    </div>
@endsection


