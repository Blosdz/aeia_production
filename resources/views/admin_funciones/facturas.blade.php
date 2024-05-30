@extends('layouts.app')
@section('content')
<div class="table-responsive-sm">
    <table class="table table-striped" id="payments-table">
    <thead>
            <tr>
                <th>Usuario</th>
                <th>Mes</th>
                <th>Total</th>
                <th>Status</th>
                <th>Fecha de transaccion</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user ? $payment->user->name: 'N/A'}}</td>
                <td>{{ $payment->month }}</td>
                <td>{{ $payment->total }}</td>
                <td>{{ $payment->status }}</td>
	        <td>{{ $payment->date_transaction }}</td>
		<td>
                    <form action="{{ route('facturas.store_voucher', $payment->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="pdf_file">
                        <button type="submit">Subir</button>
                    </form>
		</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
