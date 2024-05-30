@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tus recibos</div>

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
</div>
@endsection
