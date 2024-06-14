<!-- Body Field -->
<div class="form-group">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $notification->body }}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Mensaje:') !!}
    <p>{{ $notification->body }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Usuario:') !!}
    <p>{{ $notification->user->email }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $notification->created_at }}</p>
</div>


