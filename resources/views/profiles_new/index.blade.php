@extends('layouts_new.app')

@section('content')
    <strong>Perfiles a verificar</strong>
    <div class="container">
        <div class="row bg-1 h-100 w-100 rounded p-4" >

            <!-- <div class="card-body"> -->
                @if(auth()->user()->rol !== 5 )     
                    @include('profiles_new.filters')
                    @include('profiles_new.table')
                @else
                    @include('profiles_new.filters2')
                    @include('profiles_new.table2')
                @endif
                 <!-- <div class="pull-right mr-3">

                 </div> -->
        </div>
    </div>
 
@endsection

