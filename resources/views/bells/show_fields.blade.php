<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $bells->user_id }}</p>
</div>

<!-- Notification Field -->
<div class="form-group">
    {!! Form::label('notification', 'Notification:') !!}
    <p>{{ $bells->notification }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bells->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bells->updated_at }}</p>
</div>

