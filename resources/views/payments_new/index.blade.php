@extends('layouts_new.app')

@section('content')
    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title">Depositos</div>
             <div class="row" id="contracts-row-1">
                <div class="contracts-outher-table">
                    @include('payments.table')
                </div>
             </div>
         </div>
    </div>
@endsection

