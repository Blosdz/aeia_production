@php
    $roles = [2=>"Suscriptor", 3=>"Cliente", 4=>"Business"];
    $validates = ["Sin Validar", "Validado"];
    //$validates = [0 =>"Sin Validar", 1=>'En validacion', 2=>'Informacion enviada', 3=>'Validado', 4=>'Rechazado']
@endphp

<div class="table-responsive-sm">
    <table class="table table-striped" id="users-table">
        <thead>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Tipo</th>
        <th>Validado</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $roles[$user->rol] !!}</td>
                <td>{!! $validates[$user->validated] !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
