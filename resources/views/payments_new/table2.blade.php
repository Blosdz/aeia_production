<div class="table-responsive-sm">
    <table class="table table-striped" id="payments-table">
        <thead>
            <tr>
                <th>Monto</th>
                <th>Fecha de depósito</th>
                <th>Fecha de cierre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>$ {{ $payment->total }}</td>
                <td>{{ $payment->date_transaction }}</td>
                <td>{{ $payment->date_transaction->modify('+1 year')->modify('+1 day') }}</td>
                <td>
                    <a href="{{ route('payments.show', [$payment->id]) }}" class='btn btn-ghost-success'>Ver detalle</a>
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