@extends('layouts_new.app')

@section('content')
        <strong>Contratos</strong>
            @include('flash::message')

                <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
                   @include('contracts_new.table')
                </div> 


@endsection

