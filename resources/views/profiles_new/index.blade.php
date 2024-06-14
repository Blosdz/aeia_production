@extends('layouts_new.app')

@section('content')
    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title" >Perfiles a verificar</div>
        <div class="row" id="contracts-row-1">

            <div class="contracts-outher-table">
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

 
    </div>
@endsection

