@php
    $user_session = Auth::user();
    $user = Auth::user();
    $user_code = $user->unique_code; 
    $profile = $user->profile;

@endphp
@extends('layouts_new.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Depósitos</h1>
</div>

<div class=" card shadow mb-4 row  " id="rounded-container">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mt-1">Selecciona tu plan    
        <a href="{{ route('payment.plan') }}" class="btn btn-danger float-right">Escoger otro plan</a>
        </h6>

    </div>
    <div class="card-body">
        <div class="detail-payment-card p-4 bg-1">
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
                        <p style="color: white !important; font-weight: bolder !important;">Interbank: 4623340100022 </p>
                        <p style="color: white !important; font-weight: bolder !important;">CCI: 00346201334010002298</p>
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
                    @if($user_session->rol==4)
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="form-group col-sm-6 mb-5">
                            <!-- Cambia 'rescue' a 'rescue_money' -->
                            {!! Form::checkbox('rescue_money', '1', null, ['class' => 'form-check-input', 'id' => 'rescue_money']) !!}
                            {!! Form::label('rescue_money', 'Habilitar Rescatar Fondo') !!}
                        </div>
                    </div>
                    @endif
                     
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
                        Total invertido: $<span id="amount-modal">0.00</span> USD.
                    </p>
                    <input type="checkbox" id="myCheckbox" name="terminos" value="opcion">
                    <label for="terminos">Al hacer clic acepta el <a href="{{ route('pdf', ['id' => $plan->id]) }}" target="_blank">contrato</a> y las condiciones del servicio</label>
                </div>

                             <!-- Integración del Canvas -->
                <!-- <div class="image_signature"> -->
                    <canvas id="can" width="400" height="400" style="border:2px solid; z-index:7"></canvas>
                    <input type="button" value="clear" id="clr" onclick="erase()">
                    <img id="canvasimg" style="display:none;" src="" alt="">
                <!-- </div> -->

                <!-- Campo oculto para la firma -->
                {!! Form::hidden('canvas', null, ['id' => 'canvas_image']) !!}

                {!! Form::close() !!}
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="submitButton" disabled>Ya realicé el pago</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            init();
            let anual = parseFloat({{ $plan->annual_membership }});

            document.getElementById('amount-input').addEventListener('input', function() {
                let amount = parseFloat(this.value);
                let totalInversion = document.getElementById('total_inversion');
                let rescueMoneyCheckbox=document.getElementById('rescue_money');
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


            function save() {
                document.getElementById("canvasimg").style.border = "2px solid";
                var dataURL = canvas.toDataURL();
                document.getElementById("canvasimg").src = dataURL;
                document.getElementById("canvasimg").style.display = "none";
            }

            function send() {
                let form = document.getElementById('pay-form');
                if (!form.checkValidity()) {
                    form.querySelector(':submit').click();
                    return false;
                }
            
                let formData = new FormData(form);
                let submitButton = document.getElementById('submitButton');
                submitButton.disabled = true;
            
                // Guardar la imagen del canvas antes de enviar
                save();
            
                // Convertir el canvas a base64
                let canvas = document.getElementById('can');
                let dataURL = canvas.toDataURL('image/png'); // Convertir a formato PNG
            
                // Añadir el valor de base64 al formulario
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'canvas_image'; // Nombre del campo que se enviará al backend
                input.value = dataURL; // Imagen en base64
            
                // Asegurarse de añadir el input al formulario antes de enviarlo
                form.appendChild(input);
            
                // Agregar el input a formData para asegurarse de que se envíe
                formData.append('canvas_image', dataURL);
            
                $.ajax({
                    type: "POST",
                    url: "{{ route('client.payment') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        window.location.href = "{{ route('payment.plan') }}";
                    }
                });

            }
        });
</script>
<script>
    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",  // Color de trazo inicializado a negro
        y = 2;  // Grosor del trazo

    function init() {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;

        // Configurar eventos del mouse
        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
    }

    function draw() {
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;  // Asegura el color del trazo
        ctx.lineWidth = y;  // Asegura el grosor del trazo
        ctx.stroke();
        ctx.closePath();
    }

    function erase() {
        var m = confirm("¿Quieres borrar?");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }

    function findxy(res, e) {
        let canvasRect = canvas.getBoundingClientRect();  // Obtener la posición precisa del canvas

        if (res === 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvasRect.left;  // Ajuste de coordenadas usando getBoundingClientRect
            currY = e.clientY - canvasRect.top;

            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.fillStyle = x;
                ctx.fillRect(currX, currY, 2, 2);  // Cambia el tamaño a 2x2 para que sea visible
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res === 'up' || res === "out") {
            flag = false;
        }
        if (res === 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvasRect.left;  // Ajuste de coordenadas
                currY = e.clientY - canvasRect.top;
                draw();
            }
        }
    }

</script>


@endsection
