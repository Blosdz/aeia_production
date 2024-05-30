<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Notification Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notification', 'Notification:') !!}
    {!! Form::text('notification', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bells.index') }}" class="btn btn-secondary">Cancel</a>
</div>
