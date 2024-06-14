<table class="table table-striped">
    <tbody>
        <tr>
            <th>Estado:</th>
            <td>{{$payment->status}}</td>
        </tr>
        <tr>
            <th>Mes:</th>
            <td>{{$payment->month}}</td>
        </tr>
        <tr>
            <th>Total:</th>
            <td>$ {{$payment->total}}</td>
        </tr>
        <tr>
            <th>Fecha de transacción:</th>
            <td>{{$payment->date_transaction}}</td>
        </tr>
        <tr>
            <th>Fecha de cierre:</th>
            <td>{{$payment->date_transaction->modify('+1 day')->modify('+1 year')}}</td>
        </tr>
    </tbody>
</table>