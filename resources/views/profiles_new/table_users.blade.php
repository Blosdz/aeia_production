@extends('layouts_new.app')
@section('content')
@php
    $verified_list = [0 => 'En validación', 1 => 'Información enviada', 2 => 'Validado', 3 => 'Rechazado'];
    $user_type = [1 => 'Admin', 2 => 'Suscriptor', 3 => 'Cliente', 4 => 'Business', 5 => 'Gerente', 6 => 'Verificador'];
@endphp
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perfiles a verificar</h1>
</div>



<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Verificación</h6>
    </div>
    <div class="card-body">
        <form id="deleteForm" method="POST" action="{{ route('profiles.massDestroy') }}">
            @csrf
            @method('DELETE')
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Nombres</th>
                            <th>Estado</th>
                            <th>Rol</th>
                            <th>KYC</th>
                            <th>Más Información</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $profile->id }}" class="select-checkbox">
                                </td>
                                <td>
                                    {{ $profile->first_name . ' ' . $profile->lastname }}
                                    <br>
                                    {{ isset($profile->user) ? $profile->user->email : 'No email disponible' }} 
                                </td>
                                <td>
                                    {{ $verified_list[$profile->verified]}}
                                </td>
                                <td>
                                    @if(!empty($profile->KYC))
                                        <a href="{{ url('/storage/' . $profile->KYC) }}" target="_blank" class="btn btn-sm btn-primary">
                                            Ver KYC
                                        </a>
                                    @else
                                        No disponible
                                    @endif

                                </td>
                                <td>
                                    {{-- {{ $user_type[$profile->user->rol]}} --}}
                                </td>
                                <td>
                                    <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-ghost-info'>
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar los perfiles seleccionados?')">
                    Eliminar seleccionados
                </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    var table = $('#dataTable');

    // Ejemplo de recarga de datos
    table.clear().rows.add(newData).draw();

    // Seleccionar/deseleccionar todos los checkboxes
    $('#selectAll').on('click', function () {
        $('.select-checkbox').prop('checked', this.checked);
    });
});
$('#dataTable').DataTable({
    columns: [
        { title: "Select" , defaultContent: 'No disponible' },
        { title: "Nombres" , defaultContent: 'No disponible' },
        { title: "Estado" , defaultContent: 'No disponible' },
        { title: "Rol" , defaultContent: 'No disponible' },
        { title: "Mas Información" , defaultContent: 'No disponible' }
    ]
});


</script>

@endsection
