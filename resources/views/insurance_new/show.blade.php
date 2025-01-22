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
            <div class="accordion" id="accordionExample">
                @foreach($insured_with_details as $persona_key => $details)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $persona_key }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $persona_key }}" aria-expanded="true" aria-controls="collapse{{ $persona_key }}">
                            {{ $details['nombre'] }} - {{ $details['dni'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $persona_key }}" class="accordion-collapse collapse show" aria-labelledby="heading{{ $persona_key }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Datos Generales:</strong>
                            <p><strong>País del documento:</strong> {{ $details['country_document'] }}</p>
                            <p><strong>Dirección:</strong> {{ $details['address'] }}</p>
                            
                            <strong>Fotos:</strong>
                            @if(isset($details['photo_url']['front']))
                            <img src="{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['front'])) }}" alt="DNI Frontal" style="max-width: 200px; height: auto;">
                            <img src="{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['back'])) }}" alt="DNI Posterior" style="max-width: 200px; height: auto;">
                             
                                {{-- <img src="{{asset('storage/insurance_dnis/basename/$details['photo_url']['front'] ')  }}" alt="DNI Frontal" style="max-width: 200px; height: auto;"> --}}
                                {{-- <img src="{{ $details['photo_url']['back'] }}" alt="DNI Posterior" style="max-width: 200px; height: auto;"> --}}
                            @else
                                <p>No disponible</p>
                            @endif
            
                            @if(!empty($details['insurance_details']))
                            <hr>
                            <strong>Detalles del Seguro:</strong>
                            <ul>
                                @foreach($details['insurance_details'] as $insurance)
                                <li>
                                    <p><strong>Mes:</strong> {{ $insurance['mes'] }}</p>
                                    <p><strong>Fecha:</strong> {{ $insurance['fecha'] }}</p>
                                    <p><strong>Método de pago:</strong> {{ $insurance['monto_pay'] }}</p>
                                    <p><strong>Monto:</strong> ${{ $insurance['monto'] }}</p>
                                    <p>
                                        <strong>Recibo:</strong> 
                                        <img src="{{ Storage::url('insurance_payment/' . basename($insurance['img_urls'])) }}" alt="Voucher del usuario" style="max-width: 200px; height: auto;">

                                    </p>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p>No hay datos de seguros disponibles.</p>
                            @endif
                                   <!-- Formulario para actualizar los datos de seguros -->
                            <form action="{{ route('insurance.updateStatus', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <p>{{$persona_key}}</p>
                                    <input type="hidden" name="persona_id" value="{{$persona_key}}">
                                    <input type="hidden" name="month" value="{{now()->format('Y-m-d')}}">
                                    <label for="dropdown{{ $persona_key }}" class="form-label">Seleccione acción</label>
                                    <select class="form-select" id="dropdown{{ $persona_key }}" name="status">
                                        <option value="validar">Validar</option>
                                        <option value="no_validar">No Validar</option>
                                        <option value="corregir_data">Corregir Datos</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
    </div>
    

</div>

<script>


</script>
@endsection
