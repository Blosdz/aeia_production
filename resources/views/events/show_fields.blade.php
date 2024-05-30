@php
    $roles = [1=>"Administrador",2=>"Suscriptor",3=>"Cliente",4=>"Business"]
@endphp
<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Título:') !!}
    <p>{{ $event->title }}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Fecha:') !!}
    <p>{{ $event->date }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descripción:') !!}
    <p>{{ $event->description }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p> <img height="200" src="{{ asset('storage/'.$event->image) }}" alt="" title=""></p>

</div>

<!-- Link Meet Field -->
<div class="form-group">
    {!! Form::label('link_meet', 'Link Meet:') !!}
    <p>{{ $event->link_meet }}</p>
</div>

<!-- Link Recording Field -->
<div class="form-group">
    {!! Form::label('link_recording', 'Link Grabación:') !!}
    <p>{{ $event->link_recording }}</p>
</div>

<!-- Total Field -->
<div class="form-group">
    {!! Form::label('total', 'Total asistentes:') !!}
    <p>{{ $event->total }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Estado:') !!}
    @if($event->status == '1')
        <p>{{ "publicado" }}</p>
    @else
        <p>{{ "no publicado" }}</p>
    @endif
</div>

<h5>LISTADO DE ASISTENTES</h5>
<div class="table-responsive-sm">
    <table class="table table-striped" id="events-table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($user_events as $user_event)
            <tr>
                <td>{{ $roles[$user_event->user->rol] }}</td>
                <td>{{ $user_event->user->email }}</td>
                <td>{{ $user_event->user->profile ? $user_event->user->profile->first_name: '' }}</td>
                <td>{{ $user_event->inscription_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

 
