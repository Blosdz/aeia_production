@extends('layouts_new.app')

@section('content')
    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title" >Contratos</div>
        <div class="row" id="contracts-row-1" >
             @include('flash::message')
             <div class="contracts-outher-table">
                @include('contracts_new.table')
             </div> 
        </div>
    </div>

@endsection

