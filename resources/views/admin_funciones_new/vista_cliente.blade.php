@extends('layouts_new.app')

@section('content')
    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title" >Tus recibos</div>
        <div class="row" id="contracts-row-1">
            <div class="contracts-outher-table">
                <div class="card-body">
                    @if (count($vouchers) > 0)
                        <ul>
                            @foreach ($vouchers as $voucher)
                                <li>
                                    <a href="{{ asset($voucher->route_path) }}">{{ $voucher->route_path }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No se han encontrado recibos subidos.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
