@extends('layouts_new.app')

@section('content')

@php
  $user_session = Auth::user();
  $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp

@if ($user_session->rol == 3)
    <strong>Recibos</strong>

    <div class="row bg-1 w-100 h-100 p-4" id="rounded-container">
        <div class="row col-12">
        </div>
        <div class="row bg-1 flex-grow-1 p-4 overflow-auto" id="rounded-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Plan</th>
                        <th>Monto de Plan</th>
                        <th>Descargar</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($vouchers->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center height-display">
                                <i class="fa-regular fa-rectangle-xmark" style="font-size: 50px;"></i>
                                <p>Aún no se han encontrado documentos</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->created_at->format('d/m/Y') }}</td>
                                <td>{{ $voucher->plan_id }}</td>
                                <td>{{ $voucher->total }}</td>
                                <td>
                                    <a href="{{ asset($voucher->route_path) }}" class="btn btn-primary" download>
                                        Descargar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif

@endsection
