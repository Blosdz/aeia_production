@php
    $verified_list = [0=>'En validacion', 1=>'Informacion enviada', 2=>'Validado', 3=>'Rechazado'];
@endphp
<div class="table-responsive-sm">
    <table class="table table-striped" id="profiles-table">
        <thead>
            <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Pais Emisor</th>
        <th>Tipo de documento</th>
        <th>Fecha Nacimiento</th>
        <th>Nacionalidad</th>
        <th>Estado</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
            <td>{{ $profile->first_name }}</td>
            <td>{{ $profile->lastname }}</td>
            <td>{{ $profile->country_document }}</td>
            <td>{{ $profile->type_document }}</td>
            <td>{{ $profile->birthdate }}</td>
            <td>{{ $profile->nacionality }}</td>
            <td>{{ $verified_list[$profile->verified] }}</td>
            @php
            if (auth()->user()->rol !== 5){
            @endphp
            <td>
                <div class='btn-group'>
                    <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    <a href="{{ route('rejectionHistory', [$profile->user_id]) }}" class='btn btn-ghost-info'><i class="fa fa-file"></i></a>
                </div>
            </td>
            </tr>
            @php
            }
            @endphp

            @php
            if(auth()->user()->rol === 5){ //gestor
            @endphp
            <td>
                <div class='btn-group'>
                    <a href="{{ route('profiles.show', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-eye"></i></a>
                </div>
            </td>
            @php
            }
            @endphp
        @endforeach
        </tbody>
    </table>
</div>
