@extends('layouts_new.app')

@section('content')
    <div class="row p-4 h-100 w-100">
        <strong>Depósitos</strong>
        <div class="detail-payment-card p-4 bg-1" id="rounded-container">
            Selecciona tu plan
            <a href="{{ route('payment.plan') }}" class="btn btn-danger float-right">Escoger otro plan</a>
            <div class="card-body row payment-card p-5">
                <div class="card mx-auto p-3" style="background-color: #1c2a5b; color: white !important; width: 25%;" id="rounded-container">
                    <span class="d-flex flex-column justify-content-center align-items-center">
                        <h1 class="float-left" style="color: white !important;">{{ $plan->name }}</h1>
                        <img class="card-img-top" style="width: 30%" src="/welcome_new/images/icons/{{ $plan->logo }}" alt="Card image cap">
                        &nbsp;
                    </span>
                    <div class="card-body text-center" style="color: white !important;">
                        <p class="card-text mt-4 text-left" style="color: white !important;">Deposito permitido desde:</p>
                        <h3 style="color: #eab226 !important;">
                            ${{ $plan->minimum_fee }} a {{ $plan->maximum_fee ? '$'.$plan->maximum_fee : "más" }}
                        </h3>
                        <p class="text-left" style="color: white !important; font-weight: bolder !important;">Membresía: ${{ $plan->annual_membership }} /Anual</p>
                        <p class="text-left" style="color: white !important; font-weight: bolder !important;">Comisión: {{ $plan->commission }}%</p>
                        <p style="color: white !important; font-weight: bolder !important;">"La comisión se ejecuta sobre la ganancia y se realiza al finalizar el ciclo de inversión"</p>
                        <p style="color: white !important; font-weight: bolder !important;">CTA dólares Banbif: 8028712533</p>
                        <p style="color: white !important; font-weight: bolder !important;">CCI: 038-730-208028712533-80</p>
                    </div>
                </div>

                <div class="card mx-5 p-3 w-50 bg-1" id="rounded-container">
                    <p class="text-center">Complete el formulario para adquirir el plan escogido.</p>

                    <!-- Mensaje de éxito -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {!! Form::open(['route' => 'client.payment', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3', 'id' => 'pay-form']) !!}
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-group col-sm-6 mb-5">
                            {!! Form::label('amount', 'Monto a depositar*:') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                {!! Form::number('amount', null, ['class' => 'form-control', 'min' => $plan->minimum_fee, 'max' => $plan->maximum_fee, 'required', 'placeholder' => $plan->minimum_fee, 'step' => 0.01, 'id' => 'amount-input']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-group col-sm-6 mb-5">
                            <p>
                                <strong>Capital a invertir: $<span id="total_inversion">0.00</span></strong>
                            </p>
                            <p>
                                <strong>Membresia: ${{ $plan->annual_membership }}</strong>
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
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-check col-sm-6">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              <a href="{{route('declaracion')}}" target="_blank"> Acepta la declaración de sus Fondos. </a>
                            </label>
                        </div>
                    </div>

                    <div class="text-align-center align-items-center justify-content-center d-flex p-4">
                        <button type="button" class="btn btn-primary btn-xl p-2" data-toggle="modal" data-target="#exampleModal" id="modal-btn" disabled>
                            <h3>¡Depositar ahora!</h3>
                        </button>
                    </div>
                    {!! Form::hidden('plan_id', $plan->id, []) !!}
                    {!! Form::hidden('name', $plan->id, []) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-1" role="document">
            <div class="modal-content bg-1">
                <div class="modal-body">
                    <p class="text-center">
                        Total invertido: $<span id="amount-modal">0.00</span> USD.
                    </p>
                    <input type="checkbox" id="myCheckbox" name="terminos" value="opcion">
                    <label for="terminos">Al hacer clic acepta el <a href="{{ route('pdf', ['id' => $plan->id]) }}" target="_blank">contrato</a> y las condiciones del servicio</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="submitButton" disabled>Ya realicé el pago</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let anual = parseFloat({{ $plan->annual_membership }});

            document.getElementById('amount-input').addEventListener('input', function() {
                let amount = parseFloat(this.value);
                let totalInversion = document.getElementById('total_inversion');
                let amountModal = document.getElementById('amount-modal');

                if (!isNaN(amount)) {
                    let total = (amount + anual).toFixed(2);
                    totalInversion.textContent = total;
                    amountModal.textContent = total;
                } else {
                    totalInversion.textContent = '0.00';
                    amountModal.textContent = '0.00';
                }
            });

            document.getElementById('modal-btn').addEventListener('click', function() {
                let form = document.getElementById('pay-form');
                if (!form.checkValidity()) {
                    form.querySelector(':submit').click();
                    return false;
                }

                let amount = parseFloat(document.getElementById('amount-input').value);
                let amountModal = document.getElementById('amount-modal');
                if (!isNaN(amount)) {
                    amountModal.textContent = (amount + anual).toFixed(2);
                } else {
                    amountModal.textContent = '0.00';
                }
            });

            document.getElementById('flexCheckDefault').addEventListener('change', function() {
                document.getElementById('modal-btn').disabled = !this.checked;
            });

            document.getElementById('myCheckbox').addEventListener('change', function() {
                document.getElementById('submitButton').disabled = !this.checked;
            });

            document.getElementById('submitButton').addEventListener('click', function(event) {
                event.preventDefault();
                send();
            });

            function send() {
                let form = document.getElementById('pay-form');
                if (!form.checkValidity()) {
                    form.querySelector(':submit').click();
                    return false;
                }

                let formData = new FormData(form);
                let submitButton = document.getElementById('submitButton');
                submitButton.disabled = true;

                $.ajax({
                    type: "POST",
                    url: "{{ route('client.payment') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        // Cierra la ventana modal
                        $('#exampleModal').modal('hide');
                        // Aquí puedes manejar la respuesta del servidor si es necesario
                        window.location.href = "{{ route('payment.plan') }}";
                    },
                    error: function(error) {
                        console.error(error);
                        submitButton.disabled = false; // Habilita el botón si hay un error
                    }
                });
            }
        });
    </script>
@endsection
