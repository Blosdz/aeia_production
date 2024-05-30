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
                                  <a href="{{ route('payments.index2') }}" class="btn btn-danger float-right ml-2">Regresar</a>

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
                                  @endif
                             </div>
                             <div class="card-body">
                                 @include('payments.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
