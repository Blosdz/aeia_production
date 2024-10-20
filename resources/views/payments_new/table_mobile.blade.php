<div class="product-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell">Usuario</div>
            <div class="product-cell">Fecha</div>
            <div class="product-cell">Total</div>
            <div class="product-cell">Estado</div>
            <div class="product-cell">+</div>
        </div>


        @foreach($payments as $payment)
            <div class="products-row">
                    <div class="product-cell">{{$payment->user->name}}</div>
                    <div class="product-cell">{{$payment->date_transaction}}</div>
                    <div class="product-cell">{{$payment->total}}</div>
                    <div class="product-cell">{{$payment->status}}</div>
                    <!-- <div class="product-cell">
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary">Ver</a>
                        <form action="{{ route('payments.update.status', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Validar</button>
                        </form>
                    </div>
                    <div class="product-cell">
                        @if ($payment->voucher_picture != 'noimgadded')
                            <a href="{{ asset($payment->voucher_picture) }}" target="_blank">
                                <img src="{{ asset($payment->voucher_picture) }}" alt="Voucher" style="max-width: 100px; max-height: 100px;">
                            </a>
                        @else
                            No hay imagen
                        @endif
                    </div>
                    <div class="product-cell">
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
                    </div>-->
            </div> 

        @endforeach
    </div>
    
