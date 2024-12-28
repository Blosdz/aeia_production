@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Coberturas</h1>
</div>




<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Clientes Cobertura</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Usuarios Cubiertos</th>
                        <th>Estado</th>
                        <th>Pagos</th>
                        <th>Mes Contratado</th>
                        <th>Incidencias</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($profiles_user  as $profile)
                <tr>
                    <td>{{ $profile['name'] }}</td>
                    <td>{{ $profile['total_users'] }}</td>
                    <td>{{ $profile['total_users'] > 0 ? 'Activo' : 'Inactivo' }}</td>
                    <td>{{ $profile['insurance_payment'] ?? 'Sin pago' }}</td>
                    <td>{{ $profile['month'] ?? 'Sin mes' }}</td>
                    <td>{{ $profile['incidents'] ?? 'Sin incidencias' }}</td>
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
