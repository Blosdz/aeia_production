@php
    $totalAmount = 0;
    // Si hay personas aseguradas y se seleccionó el pago mensual o anual
    if (is_array($insuredPersons)) {
        // Si se usa el pago anual o mensual, se puede establecer un monto base
        $paymentAmount = ($paymentType ?? '' == 'annual') ? 180 : 15;
    }
    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp


{{-- <!-- <script type="text/javascript" -->
<!--         src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js" -->
<!--         kr-public-key="87601604:testpublickey_feXRj9DJp4IFcXyVk6P25ZksbQGTYHobft23o18tjNbPg" -->
<!--         kr-post-url-success="{{route('izi_pay.success')}}" -->
<!--         kr-language="en-EN"> -->
<!--  </script> -->
<!----> --}}

{{-- <script src="https://sandbox-checkout.izipay.pe/payments/v1/js/index.js"></script> --}}
{{-- <!--  theme NEON should be loaded in the HEAD section   --> --}}
{{-- <!-- <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon-reset.min.css"> --> --}}


@extends('layouts_new.app')



@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">Cobertura</h1>
</div>

<div class="card shadow mb-4 row" id="rounded-container">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary mt-1">Llena la información</h6>
    </div>
    <div class="card-body">
        <div class="detail-payment-card p-4 bg-1">
            <div class="row payment-card d-flex text-align-center align-elements-center align-items-center justify-content-center">

                @include('insurance_new.information')
               <div class="col-sm col-lg-3 col-md-5 mx-2 bg-1" id="rounded-container">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form id="insuranceForm" action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5>Personas Cubiertas:</h5>
                        @if (!empty($insuredPersons))
                            @foreach ($insuredPersons as $index => $person)
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="paid_persons[]" value="{{ $index }}">
                                        {{ $person['first_name'] }} {{ $person['lastname'] }} - Monto: S/<span class="person_amount">0</span>
                                    </label>
                                    <input type="hidden" name="first_names[]" value="{{ $person['first_name'] }}">
                                    <input type="hidden" name="last_names[]" value="{{ $person['lastname'] }}">
                                </div>
                            @endforeach
                        @else
                            <p>No hay personas cubiertas.</p>
                        @endif


                        <div class="form-group">
                            <label for="payment_type">Seleccione el tipo de pago:</label><br>

                            <input type="radio" name="payment_type" value="annual" id="annualPayment" {{ $paymentType ?? '' == 'annual' ? 'checked' : '' }}> Pago Anual (S/.180)<br>
                            <input type="radio" name="payment_type" value="monthly" id="monthlyPayment" {{ $paymentType ?? '' == 'monthly' ? 'checked' : '' }}> Pago Mensual (S/.15)<br>
                        </div>
                        {{-- izipay Form--}}
                        {{-- <form action="">
                            <button id="btnPayNow" class="buttonPay" type="button" disabled>
                                loading...
                            </button>
                            <pre id="payment-message"></pre>
                        </form> --}}

                        <label for="">Depositar a:</label>
                        <p style="color: rgb(0, 0, 0) !important; font-weight: bolder !important;">Interbank: 4623340100022 </p>
                        <p style="color: rgb(0, 0, 0) !important; font-weight: bolder !important;">CCI: 00346201334010002298</p>
                        <!-- Botón que abre el modal -->
                        <button type="button" class="btn mb-4" data-bs-toggle="modal" data-bs-target="#imageModal" style="background-color:#720E9E; font-weight:bolder; color:aliceblue;" >
                            Paga con Yape
                        </button>
                         
                        <p><strong>Total a depositar: S/ <span id="total_monto"> </span></strong></p>

                        <div class="form-group mt-4">
                            {!! Form::label('voucher_picture', 'Sube tu voucher:') !!}
                            {!! Form::file('voucher_picture', ['class' => 'form-control', 'required' => true]) !!}
                        </div>

                        {{-- qr cod iziPay card payment  --}}
                            {{-- <img src="data:image/png;base64,{{$qrCode ?? ''}} " alt="QR Code">

                        <div class="form-group text-center">

                            <div class="kr-smart-form" kr-popin kr-form-token="{{ $formToken ?? '' }}">
                            <img src="data:image/png;base64,{{$qrCode ?? ''}} " alt="QR Code"> --}}
                            <button type="submit" class="btn btn-success">Completar pago</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Yape</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" style="background-color:#720E9E">
                <img src="{{ asset('images/dashboard/yape_cobertura.webp') }}" alt="Imagen" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="paid_persons[]"]');
        const totalMonto = document.getElementById('total_monto');
        const annualPayment = document.getElementById('annualPayment');
        const monthlyPayment = document.getElementById('monthlyPayment');
        const personAmounts = document.querySelectorAll('.person_amount');

        // Función para recalcular el monto total
        function updateTotalAmount() {
            let total = 0;
            let costPerPerson = annualPayment.checked ? 180 : 15;

            // Calcular el monto según las personas seleccionadas
            checkboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    total += costPerPerson;
                    // Actualizar el monto de cada persona
                    personAmounts[index].textContent = costPerPerson;
                } else {
                    personAmounts[index].textContent = 0;  // Si no está seleccionado, el monto es 0
                }
            });

            totalMonto.textContent = total.toFixed(2);
        }

        // Actualizar el monto cuando se cambien los checkboxes o los radios
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotalAmount);
        });

        annualPayment.addEventListener('change', updateTotalAmount);
        monthlyPayment.addEventListener('change', updateTotalAmount);

        // Inicializar el monto total
        updateTotalAmount();
    });

    // Manejo de carga de archivos y previsualización
    $(document).on('change', '.file-input', function (e) {
        const inputId = $(this).attr('id');
        const file = e.target.files[0];
        const reader = new FileReader();
        const progressId = `progress-${inputId}`;
        const previewId = `preview-${inputId}`;

        $(`#${progressId}`).show();
        $(`#${progressId} .progress-bar`).css('width', '0%').text('0%');

        reader.onloadstart = function () {
            $(`#${previewId}`).hide();
        };

        reader.onprogress = function (event) {
            if (event.lengthComputable) {
                const percentComplete = Math.round((event.loaded / event.total) * 100);
                $(`#${progressId} .progress-bar`).css('width', `${percentComplete}%`).text(`${percentComplete}%`);
            }
        };

        reader.onload = function (event) {
            $(`#${previewId}`).attr('src', event.target.result).show();
        };

        reader.onloadend = function () {
            $(`#${progressId}`).hide();
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>

{{-- <script type="module" src="{{asset('iziPay/pay.js')}}"></script> --}}

@endsection
