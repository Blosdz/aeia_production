@php
    $user = Auth::user();
@endphp

@extends('layouts.app')

<style>
    .center-img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 20%;
    }
</style>

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Depositos</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Depositos
                         </div>
                         <div class="card-body">
                         @php
                            if($user->validated) {
                        @endphp

                            @if($current)
                            @else
                              <img src="/images/binance-banner.jpg" alt="Binance Logo" data-position="center center" class="center-img py-4" data-toggle="modal" data-target="#exampleModal" id=""/>

                              <div class="row d-flex justify-content-center">
                                  <!-- {!! Form::button('test', ['onClick'=> 'send()', 'class' => 'btn btn-outline-primary btn-xl p-2']) !!} -->
                                  <button onclick="send()" type="button" class="btn btn-outline-primary btn-xl p-2" data-toggle="modal" data-target="#paymentModal" id="modal-btn">
                                      <h3>Depositar ahora</h3>
                                  </button>
                                </div>
                                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <p class="text-center">
                                                Escanea el QR de nuestro Binance Pay y realiza el pago por el monto de: $<span>{{ $total }}</span> USD.
                                            </p>
                                            <img id="qrcode" class="w-100" src="/images/loader.gif" alt="binance-qr">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            <button type="button" onclick="history.go(0)" class="btn btn-success" data-dismiss="modal">Ya realicé el pago</button>
                                            <!-- {!! Form::submit('Ya realicé el pago', ['class'=>'btn btn-success']) !!} -->
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- <a href="{{ route('payments.pay') }}" class="btn btn-primary lg-12">Hacer deposito</a> -->
                            @endif
                             @include('payments.table2')
                        @php
                            } else {
                        @endphp
                            <div class="alert alert-danger" role="alert">
                                No tiene habilitado esta accion hasta que su cuenta se validada
                            </div>
                        @php
                            }
                        @endphp
                         </div>

                     </div>
                  </div>
             </div>
         </div>
    </div>
    <script>
        let qrCodeLink = ""
        let amount = {{$total}};


     // $("#amount").text(amount);
        function send() {
            $.ajax({
                type: "POST",
                url: "{{ route('payments.pay') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "total": amount.toFixed(7),
                    "name": "Suscription",
                    "details": "Suscription",
                },
                success: function(data) {
                    console.log(data)
                    $("#qrcode").attr("src", data.data.qrcodeLink)
                }
            });
        }
    </script>
@endsection
