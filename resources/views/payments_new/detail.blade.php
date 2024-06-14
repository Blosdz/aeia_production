@extends('layouts_new.app')

@section('content')
    <div class="container_dashboard_background" id="contracts_table">
        <div class="dashboard-new-title" >Depósitos</div>
            <div class="detail-payment-card">
                Selecciona tu plan
                <a href="{{route('payment.plan')}}" class="btn btn-danger float-right"> Escoger otro plan</a>
                <div class="card-body row payment-card">
                    <div class="card mx-5 p-3 w-25" style="background-color: #1c2a5b; color:white">
                        <span>
                            <h1 class="float-left">{{$plan->name}}</h1>
                            <img class="card-img-top float-right" style ="width: 15%" src="/welcome_new/images/icons/{{$plan->logo}}" alt="Card image cap">
                            &nbsp;
                        </span>
                        <div class="card-body text-center">
                            <p class="card-text mt-4 text-left"> Deposito permitido desde: </p>
                            <p><h1 class="" style="color: #eab226"><b>${{$plan->minimum_fee}} a {{$plan->maximum_fee?'$'.$plan->maximum_fee:"más"}}</b></h1></p>
                            <p class="text-left"><b>Membresía: </b>$<span id="anual_membership">{{$plan->annual_membership}}</span>/Anual</p>
                            <p class="text-left"><b>Comisión: </b> {{$plan->commission}}%</p>
                            <p>"La comisión se ejecuta sobre la ganancia y se realiza al finalizar el ciclo de inversión"</p>
				            <p>CTA dólares Banbif: 8028712533 </p>
				            <p>CCI: 038-730-208028712533-80</p>
                        </div>

                    </div>
                    <div class="card mx-5 p-3 w-50">
                        <p class="text-center">Complete el formulario para adquirir el plan escogido.</p>
			            {!! Form::open(['route' => 'client.payment', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3', 'id' => 'pay-form']) !!}
                            <div class="row">
                                <div class="col-3"></div>
                                    <div class="form-group col-sm-6 mb-5">
                                        {!! Form::label('amount', 'Monto a depositar*:') !!}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            {!! Form::number('amount', null, ['class' => 'form-control','min'=>$plan->minimum_fee,'max'=>$plan->maximum_fee,'required','placeholder'=>$plan->minimum_fee,'step'=>0.01,'id'=>'amount-input']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="form-group col-sm-6 mb-5">
                                        <p>
                                            <strong>Capital a invertir: <span id="total_inversion"></span></strong>
                                        </p>
                                        <p>
                                            <strong>Membresia: ${{ $plan->annual_membership }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </div>
				</div>
				<div class="row">
				    <div class="col-3" id="voucher_file"></div>
				        <div class="form-group col-sm-6 mb-5" id="rrr">

						<p><strong>Sube tu comprobante de pago</strong></p>
						<div class="input-group">
				            {!! Form::label('voucher_picture', "Seleccionar archivo", ['class' => 'custom-file-label', 'for' => 'voucher_picture', 'id' => 'file_input_voucher']) !!}
				            {!! Form::file('voucher_picture', ['class' => 'custom-file-input', 'id' => 'voucher_picture', 'oninput' => 'input_filename(event);', 'tofill' => '', 'onclick' => 'check_progress_bar(event);']) !!}
						</div>
				            <input type="text" class="d-none" id="hide_voucher">
				        </div>
					        <!-- Agrega una sección para mostrar el progreso de la carga del archivo si lo deseas -->
				</div>
                                <div class="row">
                                    <div class="col-3"></div>
                                        <div class="form-group col-sm-6 mb-5">
                                            {!! Form::label('code', '¿Tiene Código de suscriptor?:') !!}
                                            {!! Form::text('code', null, ['class' => 'form-control','placeholder'=>'ABC123']) !!}
                                        </div>
                                        {!! Form::hidden('plan_id', $plan->id, []) !!}
                                        {!! Form::hidden('name', $plan->id, []) !!}
                                </div>

                                <div class="row d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary btn-xl p-2" data-toggle="modal" data-target="#exampleModal" id="modal-btn">
                                        <h3>¡Depositar ahora!</h3>
                                    </button>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
					    <p class="text-center">
                                                Total invertido: $<span id="amount-modal">0.00</span> USD.
                                            </p>
                                            <!-- <img id="qrcode" class="w-100" src="/images/loader.gif" alt="binance-qr"> -->
					 <input type="checkbox" id="myCheckbox" name="terminos" value="opcion">
                                            <label for="terminos">Al hacer clic acepta el <a href="{{route('pdf',['id'=>$plan->id])}}" target="_blank">contrato</a> y las condiciones del servicio</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            {!! Form::submit('Ya realicé el pago', ['class'=>'btn btn-success', 'id' => 'submitButton', 'disabled']) !!}

                                        </div>
                                            <!-- {!! Form::submit('Ya realicé el pago', ['class'=>'btn btn-success']) !!} -->
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    let qrCodeLink = ""
    let anual = parseInt($('#anual_membership').html())
 console.log(anual)

    $("#modal-btn").click(send);
 $('#amount-input').on('input', function(){
     let amount = parseInt($(this).val())
     let totalInversion = $('#total_inversion')
     totalInversion.text(amount + anual)
 })

    function send(){
        var $myForm = $('#pay-form');
        if (!$myForm[0].checkValidity()) {
            $myForm.find(':submit').click();
            return false;
        }

        $("#amount-modal").html(parseFloat(parseInt($("#amount-input").val()) + anual ).toFixed(2));

        $.ajax({
            type: "POST",
            url: "{{ route('client.payment') }}",
            data:formData,
            success: function(data) {
                console.log(data);
                $("#qrcode").attr("src", data.data.qrcodeLink)
            }
        })
    }
  document.getElementById('myCheckbox').addEventListener('change', function() {
    // Habilita el botón de "Aceptar" si el checkbox está marcado
    document.getElementById('submitButton').disabled = !this.checked;
  });


</script>

@endsection
