@extends('layouts_new.app')

@section('content')
    <strong>Clientes</strong>
    <!-- <div class="container"> -->
        <div class="row bg-1 h-100 w-100 rounded p-4" >
            @if(auth()->user()->rol !== 5 )     
                <!-- @include('profiles_new.filters') -->
                @include('profiles_new.table')
            @else
                <!-- @include('profiles_new.filters2') -->
                @include('profiles_new.table2')
            @endif
        </div>
    <!-- </div> -->
 
@endsection


