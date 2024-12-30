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

        <h5>Personas Aseguradas</h5>
        <div class="accordion" id="accordionExample">
            @if(is_array($insured_with_payments) || is_iterable($insured_with_payments))
                @foreach($insured_with_payments as $personaKey => $person)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $personaKey }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $personaKey }}" aria-expanded="true" aria-controls="collapse{{ $personaKey }}">
                            {{ $person['first_name'] ?? 'Persona #' . $personaKey }} {{ $person['lastname'] ?? 'N/A' }}
                        </button>
                    </h2>
                    <div id="collapse{{ $personaKey }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $personaKey }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><strong>Nombre:</strong> {{ $person['first_name'] ?? 'N/A' }} {{ $person['lastname'] ?? 'N/A' }}</p>
                            <p><strong>Dirección:</strong> {{ $person['address'] ?? 'N/A' }}</p>
                            <p><strong>Documento:</strong> {{ $person['type_document'] ?? 'N/A' }}</p>
                            <p><strong>Documento ID:</strong> {{ $person['dni_number'] ?? 'N/A' }}</p>
                            
                            @if(isset($person['dni']))
                                <p><strong>Documento adjunto:</strong></p>
                                <img src="{{ asset('uploads/' . $person['dni']) }}" alt="Documento" style="max-width: 200px;">
                            @endif

                            @if(isset($person['payments']))
                                <h6>Pagos Relacionados</h6>
                                <ul>
                                    @foreach($person['payments'] as $payment)
                                        <li>
                                            <strong>Fecha:</strong> {{ $payment['fecha'] ?? 'N/A' }}<br>
                                            <strong>Monto:</strong> ${{ $payment['monto'] ?? 'N/A' }}<br>
                                            @if(isset($payment['voucher']))
                                                <strong>Voucher:</strong>
                                                <img src="{{ asset($payment['voucher']) }}" alt="Voucher" style="max-width: 200px;">
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p>No hay personas aseguradas disponibles.</p>
            @endif
        </div>

        <h5>Detalles del Seguro</h5>
        @if(is_array($insurance_data) || is_iterable($insurance_data))
        <ul>
            @foreach($insurance_data as $insurance)
            <li><strong>{{ $insurance->name ?? 'N/A' }}</strong>:
                {{-- @foreach($insurance->payments as $payment)
                <ul>
                    <li><strong>Fecha:</strong> {{ $payment->fecha ?? 'N/A' }}</li>
                    <li><strong>Tipo de Pago:</strong> {{ $payment->monto_pay ?? 'N/A' }}</li>
                    <li><strong>Monto:</strong> ${{ $payment->monto ?? 'N/A' }}</li>
                    @if(isset($payment->img_url))
                    <li><strong>Voucher:</strong></li>
                    <img src="{{ asset($payment->img_url) }}" alt="Voucher" style="max-width: 200px;">
                    @endif
                </ul> 
                @endforeach--}}
            </li>
            @endforeach
        </ul>
        @else
        <p>No hay datos del seguro disponibles.</p>
        @endif
    </div>
</div>

<script>
    // Asegurarse de que solo un acordeón esté abierto
    document.addEventListener('DOMContentLoaded', () => {
        const accordionButtons = document.querySelectorAll('.accordion-button');
        accordionButtons.forEach(button => {
            button.addEventListener('click', function () {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                accordionButtons.forEach(btn => {
                    const targetCollapse = document.querySelector(btn.getAttribute('data-bs-target'));
                    if (btn !== this) {
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                        targetCollapse.classList.remove('show');
                    }
                });
                const targetCollapse = document.querySelector(this.getAttribute('data-bs-target'));
                if (!isExpanded) {
                    this.classList.remove('collapsed');
                    this.setAttribute('aria-expanded', 'true');
                    targetCollapse.classList.add('show');
                }
            });
        });
    });
</script>

@endsection
