<?php 
    $status = [
        0 => 'En validación',
        1 => 'Aprobado',
        2 => 'Rechazado'
];
?>
<div class="table-responsive-sm">
    <table class="table table-striped" id="payments-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Monto</th>
                <th>Plan</th>
                <th>Fecha</th>
                <th>Cierre</th>
                <th>Fondo</th>
                <th>Referido</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td> {{$payment->client_payment->code}}</td>
                <td>$ {{ $payment->total }}</td>
                <td>{{$plans[$payment->client_payment->plan_id]}}</td>
                <td>{{ $payment->date_transaction }}</td>
                <td>{{ $payment->date_transaction->modify('+1 year')->modify('+1 day') }}</td>
                <td>{{$payment->month}}/{{$payment->date_transaction->format('Y')}}</td>
                <td>{{$payment->client_payment->referred_code}}</td>
                <td>{{$payment->status}}</td>
                <td>
                    <a href="{{ route('payment.client.detail', [$payment->id]) }}" class='btn btn-ghost-success'>Ver detalle</a>
                    @if ($payment->contract)
                        <a href="{{route('contracts.pdf',[$payment->contract->id])}}" target="_blank" class="btn btn-ghost-info"> Ver contrato </a>
                    @else
                        <a href="" class="btn btn-disabled disabled"> Ver contrato </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
