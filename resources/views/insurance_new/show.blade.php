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

            <h5>Titular</h5>
            <ul>
                <li><strong>Nombres:</strong> {{ $profile['first_name'] ?? 'N/A' }}</li>
                <li><strong>Apellidos:</strong> {{ $profile['lastname'] ?? 'N/A' }}</li>
                <li><strong>Dni:</strong> {{$profile['identification_number']}}</li>
                <li><strong>Telefono:</strong> {{$profile['phone']}}</li>
                <li><strong>Dirección:</strong> {{ $profile['address'] ?? 'N/A' }}</li>
            </ul>

        {{-- <div class="accordion" id="accordionExample"> --}}
            <h5>Beneficiarios</h5>
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
                            <p><strong>Número de Documento:</strong> {{$details['dni']}}</p>
                            <p><strong>Deporte:</strong> {{$details['deporte']}}</p>
                            <p><strong>Club:</strong> {{$details['Club']}}</p>
                            <p><strong>Dirección:</strong> {{ $details['address'] }}</p>
                            
                            <strong>Fotos del Documento:</strong> <br>
                            @if(isset($details['photo_url']['front']))
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal" 
                                   onclick="showImage('{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['front'])) }}')">
                                    <img src="{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['front'])) }}" alt="DNI Frontal" style="max-width: 200px; height: auto;" class="mb-5">
                                </a>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal" 
                                   onclick="showImage('{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['back'])) }}')">
                                    <img src="{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['back'])) }}" alt="DNI Posterior" style="max-width: 200px; height: auto;">
                                </a>
                            @else
                                <p>No disponible</p>
                            @endif 

                            @if(!empty($details['insurance_details']))
                            <hr>
                            <strong>Detalles de la cobertura:</strong>
                            <ul>
                                <!-- Mostrar el estado -->
                                <p><strong>Estado del Beneficiado:</strong> {{ $details['insurance_details']['status'] ?? 'sin validado' }}</p>
                        
                                <!-- Iterar sobre montos de pago -->
                                @if (!empty($details['insurance_details']['monto_pays']) && is_array($details['insurance_details']['monto_pays']))
                                    @foreach ($details['insurance_details']['monto_pays'] as $monto)
                                        @if ($monto == "monthly")
                                            <p><strong>Monto pagado:</strong> S/15</p>
                                        @else
                                            <p><strong>Monto pagado:</strong> S/180</p>
                                        @endif
                                    @endforeach
                                @endif
                        
                                <!-- Iterar sobre fechas -->
                                @if (!empty($details['insurance_details']['fechas']) && is_array($details['insurance_details']['fechas']))
                                    @foreach ($details['insurance_details']['fechas'] as $fecha)
                                        <p><strong>Fechas de Pago:</strong> {{ $fecha }}</p>
                                    @endforeach
                                @endif
                        
                                <!-- Mostrar imágenes de seguros -->
                                @if (!empty($details['insurance_details']['img_urls']) && is_array($details['insurance_details']['img_urls']))
                                    @foreach ($details['insurance_details']['img_urls'] as $imgs)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModal" 
                                           onclick="showImage('{{ Storage::url($imgs) }}')">
                                            <img src="{{ Storage::url($imgs) }}" alt="Voucher" style="max-width: 200px; height: auto;" class="mb-5"><br>
                                        </a>
                                    @endforeach
                                @endif
                             
                            </ul>
                        @else
                            <p>No hay datos de seguros disponibles.</p>
                        @endif
                         
                                   <!-- Formulario para actualizar los datos de seguros -->
                            <form action="{{ route('insurance.updateStatus', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
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
<!-- Modal -->
{{-- <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center" >
                <img src="{{ Storage::url('insurance_dnis/' . basename($details['photo_url']['front'])) }}" alt="DNI Frontal" style="max-width: 200px; height: auto;" class="mb-5"> <br>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Reutilizable -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
                <img id="modalImage" src="" alt="Imagen Modal" style="width: 100%; height: auto; max-height: 90vh; object-fit: contain;">
        </div>
    </div>
</div>



<script>
    function showImage(src) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
    }


</script>
@endsection
