@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Depósitos</h1>
</div>




<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Historial de Pagos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Status</th>
                        <th>Actualizar</th>
                        <th>Voucher</th>
                        <th>Mas Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($payments  as $payment)
                        <tr>
                            <td>{{$payment->user_name}}</td>
                            <td>{{$payment->date_transaction}}</td>
                            <td>{{$payment->total}}</td>

                            <td>{{$payment->status}}</td>
                            <td>
                                <form action="{{ route('payments.update.status', $payment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Validar</button>
                                </form>
                            </td>
                            <td>
                                @if ($payment->voucher_picture!="noimgadded")
                                    <a href="{{ Storage::url($payment->voucher_picture) }}" target="_blank" class="btn btn-info">Ver recibo</a>
                                @else
                                    <span class="text-danger">No hay recibo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary">Ver</a>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

{{--                        <th>Observaciones</th>
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




                            <td>
                                @if ($payment->voucher_picture != 'noimgadded')
                                    <a href="{{ asset($payment->voucher_picture) }}" target="_blank">
                                        <img src="{{ asset($payment->voucher_picture) }}" alt="Voucher" style="max-width: 100px; max-height: 100px;">
                                    </a>
                                @else
                                    No hay imagen
                                @endif
                            </td>
--}}
