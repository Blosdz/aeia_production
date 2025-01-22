@php
    $totalAmount = (is_array($insuredPersons) ? count($insuredPersons) : 0) * $costPerPerson ?? 0;

    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp

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
                
                <div class="col-sm col-lg col-md mx-2 bg-1" id="rounded-container">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif         
                    @include('profiles_new.fields_seguro')
                    <label for="">Ya estoy registrado: </label>
                    <a href="{{ route('insurance.pay') }}" class="btn btn-primary">Continuar con el pago</a>


                    {{-- <form id="insuranceForm" action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5>Personas aseguradas:</h5>
                        @if (!empty($insuredPersons))
                            @foreach ($insuredPersons as $index => $person)
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="paid_persons[]" value="{{ $index }}"> 
                                        {{ $person['first_name'] }} {{ $person['lastname'] }} - Monto: ${{ $costPerPerson }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <p>No hay personas aseguradas disponibles.</p>
                        @endif

                        <p><strong>Total a depositar: $<span id="total_monto">{{ $totalAmount }}</span></strong></p>

                        <div class="form-group">
                            {!! Form::label('voucher_picture', 'Sube tu voucher:') !!}
                            {!! Form::file('voucher_picture', ['class' => 'form-control', 'required' => true]) !!}
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Completar pago</button>
                        </div>
                    </form> --}}
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[name="paid_persons[]"]');
        const costPerPerson = {{ $costPerPerson }};
        const totalMonto = document.getElementById('total_monto');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                let total = 0;

                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        total += costPerPerson;
                    }
                });

                totalMonto.textContent = total.toFixed(2);
            });
        });
    });
</script>

@endsection
    