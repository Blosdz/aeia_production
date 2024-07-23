@extends('layouts_new.app')

@section('content')

@php
  $user_session = Auth::user();
  $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp

@php
if($user_session->rol == 3 ){
@endphp
    <strong>Recibos</strong>

    <div class="row bg-1 w-100 h-100 p-4 " id="rounded-container">
        <div class="row col-12">
        </div>
        <div class="row bg-1 flex-grow-1 p-4 overflow-auto" id="rounded-container">
            <table>
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
                        // @foreach ($payments as $payment)
                        //     <tr>
                        //     <td>{{ $payment->date_transaction }}</td>
                        //     <td>{{ $payment->total  }}</td>
                        //     <td>
                        //         <a href="{{ route('payments.show', [$payment->id]) }}" class='btn btn-success'>Ver detalle</a>
                        //         @if ($payment->contract)
                        //             <a href="{{route('contracts.pdf',[$payment->contract->id])}}" target="_blank" class="btn btn-info"> Ver contrato </a>
                        //         @else
                        //             <a href="" class="btn btn-disabled disabled"> Ver contrato </a>
                        //         @endif
                        //     </td>
                        //     </tr>
                        // @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@php
}
@endphp


@endsection