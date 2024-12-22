@php
    $user_session = Auth::user();
    $user = Auth::user();
    $user_code = $user->unique_code; 
    $profile = $user->profile;

@endphp
@extends('layouts_new.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Seguro</h1>
</div>

<div class=" card shadow mb-4 row  " id="rounded-container">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mt-1">Llena la información    
        </h6>
    </div>
    <div class="card-body">
        <div class="detail-payment-card p-4 bg-1">
            <div class="card-body row payment-card p-5">
                <div class="card mx-auto p-3" style="background-color: #1c2a5b; color: white !important; width: 25%;" id="rounded-container">
                    <span class="d-flex flex-column justify-content-center align-items-center">
                        <h1 class="float-left" style="color: white !important;">Seguro de Deportistas</h1>
                        <img class="card-img-top" style="width: 30%" src="/welcome_new/images/icons/{{ URL::asset('/images/dashboard/aa seguros 1-1.webp')}}" alt="Card image cap">
                        &nbsp;
                    </span>
                    <div class="card-body text-center" style="color: white !important;">
                        <p class="card-text mt-4 text-left" style="color: white !important;">Deposito permitido desde:</p>
                        <h3 style="color: #eab226 !important;">
                            100.00 PEN
                        </h3>
                        <p style="color: white !important; font-weight: bolder !important;">CTA Interbank:</p>
                        <p style="color: white !important; font-weight: bolder !important;">CCI:</p>
                    </div>
                </div>

                <div class="card mx-5 p-3 w-50 bg-1" id="rounded-container">
                    <p class="text-center">Complete el formulario para adquirir el plan escogido.</p>


                    {!! Form::open(['route' => 'insurance.create', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3', 'id' => 'pay-form']) !!}
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-group col-sm-6 mb-5">
                            {!! Form::label('amount', 'Monto a depositar*:') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                {!! Form::number('amount', null, ['class' => 'form-control', 'step' => 0.01, 'id' => 'amount-input']) !!}
                            </div>
                        </div>

                    </div>
                     
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-group col-sm-6 mb-5">
                            <p>
                                <strong>Capital a invertir: $<span id="total_monto">0.00</span></strong>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-group col-sm-6 mb-5">
                            <p><strong>Sube tu voucher:</strong></p>
                            <div class="input-group">
                                {!! Form::label('voucher_picture', "Seleccionar archivo", ['class' => 'custom-file-label', 'for' => 'voucher_picture', 'id' => 'file_input_voucher']) !!}
                                {!! Form::file('voucher_picture', ['class' => 'custom-file-input', 'id' => 'voucher_picture', 'oninput' => 'input_filename(event);', 'tofill' => '', 'onclick' => 'check_progress_bar(event);']) !!}
                            </div>
                            <input type="text" class="d-none" id="hide_voucher">
                        </div>
                    </div>

                    <div class="text-align-center align-items-center justify-content-center d-flex p-4">
                        <button type="button" class="btn btn-primary btn-xl p-2" data-toggle="modal" data-target="#exampleModal" id="modal-btn" disabled>
                            <h3>¡Depositar ahora!</h3>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-1" style="width:400px !important;">
            <div class="modal-body">
                <p class="text-center">
                    Total Depositado: $<span id="amount-modal">0.00</span> USD.
                </p>
                <input type="checkbox" id="myCheckbox" name="terminos" value="opcion">
                {{-- <label for="terminos">Al hacer clic acepta el <a href="{{ route('pdf', ['id' => $plan->id]) }}" target="_blank">contrato</a> y las condiciones del servicio</label> --}}
            </div>

                         <!-- Integración del Canvas -->

            {!! Form::close() !!}
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="submitButton" disabled>Ya realicé el pago</button>
            </div>
        </div>
    </div>
</div>



@endsection
