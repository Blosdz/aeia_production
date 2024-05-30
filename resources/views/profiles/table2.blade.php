@php
    $verified_list = [0=>'En validacion', 1=>'Informacion enviada', 2=>'Validado', 3=>'Rechazado'];
@endphp
@inject('carbon', 'Carbon\Carbon')
<div class="table-responsive-sm">
    <table class="table table-striped" id="profiles-table">
        <thead>
            <tr>
        <th>Codigo</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Estado de Licencia</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profiles as $profile)
            <tr>
            <td>{{ $profile->user->link}}</td>
            <td>{{ $profile->first_name}}</td>
            <td>{{ $profile->lastname}}</td>
            <td>{{ $profile->user->email}}</td>
            <td>{{ $profile->user->last_paid_payment}}</td>
            <td>
                <div class='btn-group'>
                    <a href="{{ route('profiles.show', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-eye"></i></a>
                </div>
            </td>
        @endforeach
        </tbody>
    </table>
</div>
