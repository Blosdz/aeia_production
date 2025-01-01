@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Coberturas de {{ $user->name }}</h1>
</div>

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detalles del Perfil</h6>
        </div>
        <div class="card-body">
            <h5>Información del Perfil</h5>
            <ul>
                <li><strong>Nombres:</strong> {{ $profile['first_name'] ?? 'N/A' }}</li>
                <li><strong>Apellidos:</strong> {{ $profile['lastname'] ?? 'N/A' }}</li>
                <li><strong>Dirección:</strong> {{ $profile['address'] ?? 'N/A' }}</li>
            </ul>

        {{-- <div class="accordion" id="accordionExample"> --}}
            <h5>USUARIOS REGISTRADOS A LA COBERTURA</h5>
            @foreach($insured_with_details as $persona_key => $details)
            {{-- <div class="accordion-item"> --}}
                <h2 class="accordion-header" id="heading{{ $persona_key }}">
                    <button class="accordion-button collapsed" 
                        type="button" 
                        data-bs-target="#collapse{{ $persona_key }}" 
                        aria-expanded="false" 
                        aria-controls="collapse{{ $persona_key }}">
                        {{ $details['nombre'] }} - {{ $details['dni'] }}
                    </button>
                </h2>
                {{-- <div id="collapse{{ $persona_key }}" class="accordion-collapse collapse" 
                     aria-labelledby="heading{{ $persona_key }}" 
                     data-bs-parent="#accordionExample"> --}}
                    {{-- <div class="accordion-body"> --}}
                        <p><strong>Dirección:</strong> {{ $details['address'] }}</p>
                        <p><strong>País:</strong> {{ $details['country_document'] }}</p>
                        <p>
                            <strong>Fotos:</strong> 
                            @if(isset($details['photo_url']['front']))
                                <img src="{{ asset('storage/insurance_dnis/' . basename($details['photo_url']['front'])) }}" alt="DNI Frontal" style="max-width: 200px; height: auto;">
                                <img src="{{ asset('storage/insurance_dnis/' . basename($details['photo_url']['back'])) }}" alt="DNI Frontal" style="max-width: 200px; height: auto;">
                            @else
                                <p>No disponible</p>
                            @endif
                            {{-- <a href="{{ $details['photo_url']['front'] }}" target="_blank">DNI Frontal</a> | 
                            <a href="{{ $details['photo_url']['back'] }}" target="_blank">DNI Reverso</a> --}}
                        </p>
                        <h5>Seguros:</h5>
                        @if(!empty($details['insurance_details']))
                            <ul>
                                @foreach($details['insurance_details'] as $insurance)
                                    <li>
                                        <strong>Fecha:</strong> {{ $insurance['fecha'] ?? 'N/A' }} <br>
                                        <strong>Monto:</strong> {{ $insurance['monto'] ?? 'N/A' }} <br>
                                        <strong>Tipo de Pago:</strong> {{ $insurance['monto_pay'] ?? 'N/A' }} <br>
                                        <strong>Comprobante:</strong> 
                                        @if(isset($insurance['img_url']))
                                            <a href="{{ $insurance['img_url'] }}" target="_blank">Ver Voucher</a>
                                        @else
                                            No disponible
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No hay seguros registrados para esta persona.</p>
                        @endif
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
            @endforeach
        </div>
    </div>
    

</div>

<script>


</script>
@endsection
