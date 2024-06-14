@extends('layouts_new.app')

@section('content')

    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title" >Depósitos</div>
            <li class="breadcrumb-item active">Detalle</li>
                <div class="row">
                    <div class="contracts-outher-table">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Estado:</th>
                                    <td>{{$payment->status}}</td>
                                </tr>
                                <tr>
                                    <th>Código:</th>
                                    <td>{{$payment->client_payment->code}}</td>
                                </tr>
                                <tr>
                                    <th>Plan:</th>
                                    <td>{{$payment->client_payment->plan->name}}</td>
                                </tr>
                                <tr>
                                    <th>Fondo:</th>
                                    <td>{{$payment->month}}/{{$payment->date_transaction->format('Y')}}</td>
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
                                <tr>
                                    <th>Codigo referido:</th>
                                    <td>{{$payment->client_payment->referred_code}}</td>
                                </tr>
                                @if ($payment->client_payment->referred_user)
                                    <th>Usuario:</th>
                                    <td>{{$payment->client_payment->referred_user->name}}                                            
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
