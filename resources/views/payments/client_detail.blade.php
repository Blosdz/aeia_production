@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('payments.index') }}">Depósitos</a>
            </li>
            <li class="breadcrumb-item active">Detalle</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalles</strong>
                                  <a href="{{ route('clients.index') }}" class="btn btn-danger float-right ml-2">Regresar</a>

                                  @if ($payment->status == 'PENDIENTE')
                                      <button type="button" data-toggle="modal" data-target="#paymentModal" class="btn btn-primary float-right">Ver QR</button>
                                      <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                  <div class="modal-body">
                                                      <p class="text-center">
                                                          Escanea el QR de nuestro Binance Pay y realiza el pago por el monto de: $<span id="amount">{{$payment->total}}</span> USD.
                                                      </p>
                                                      <img id="qrcode" class="w-100" src="{{ $payment->qr_url}} " alt="binance-qr">
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                      <button type="button" onclick="history.go(0)" class="btn btn-success" data-dismiss="modal">Ya realicé el pago</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  @endif

                             </div>
                             <div class="card-body">
                                <table class="table table-striped">
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
          </div>
    </div>
@endsection
