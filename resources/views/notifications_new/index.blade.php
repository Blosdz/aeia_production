@extends('layouts_new.app')

@section('content')
    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title">Notificaciones</div>
             <div class="row" id="contracts-row-1">

                <div class="contracts-outher-table">
                     <!-- <div class="card"> -->
                        <!-- <div class="card-body"> -->
                            @include('notifications.table')

                        <!-- </div> -->
                     <!-- </div> -->
                  </div>
            </div>
    </div>



@endsection

