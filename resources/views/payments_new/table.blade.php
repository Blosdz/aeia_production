<div class="table-responsive-sm">
    <table class="table table-striped" id="payments-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Mes</th>
                <th>Total</th>
                <th>Status</th>
                <th>Fecha de transaccion</th>
                <th>voucher</th>
                <th>Acciones</th>
                <th>Observaciones</th>
                <th>Comentar</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->user ? $payment->user->name : 'N/A' }}</td>
                <td>{{ $payment->month }}</td>
                <td>{{ $payment->total }}</td>
                <td>{{ $payment->status }}</td>
                <td>{{ $payment->date_transaction }}</td>
                <td>
                    @if ($payment->voucher_picture != 'noimgadded')
                        <a href="{{ asset($payment->voucher_picture) }}" target="_blank">
                            <img src="{{ asset($payment->voucher_picture) }}" alt="Voucher" style="max-width: 100px; max-height: 100px;">
                        </a>
                    @else
                        No hay imagen
                    @endif
                </td>
                <td>
                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary">Ver</a>
                    <form action="{{ route('payments.update.status', $payment->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Validar</button>
                    </form>
                    <!-- <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-secondary">Editar</a> -->
                </td>
                <td>{{ $payment->comments_on_payment }}</td>
                <td>
                    <form action="{{ route('payments.update.comments', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <input type="text" class="form-control" name="comments_on_payment" placeholder="Agregar observaciones">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
