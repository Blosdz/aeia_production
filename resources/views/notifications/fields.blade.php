<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', 'Titulo de Notificación:') !!}
    {!! Form::select('title', ['Declaración de cuenta' => 'Declaración de cuenta', 'Reunión programada' => 'Reunión programada'], null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Información:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Nombre del Usuario:') !!}
    {!! Form::text('user_id', $users,null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('notifications.index') }}" class="btn btn-secondary">Cancel</a>
</div>
