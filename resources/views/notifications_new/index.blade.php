@extends('layouts_new.app')

@section('content')
    <strong">Notificaciones</strong>
    <div class="row" id="contracts-row-1">
       <div class="contracts-outher-table">
            <!-- <div class="card"> -->
               <!-- <div class="card-body"> -->
                   @include('notifications.table')

               <!-- </div> -->
            <!-- </div> -->
         </div>
    </div>



@endsection

