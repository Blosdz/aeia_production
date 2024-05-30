<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userEvent->user_id }}</p>
</div>

<!-- Event Id Field -->
<div class="form-group">
    {!! Form::label('event_id', 'Event Id:') !!}
    <p>{{ $userEvent->event_id }}</p>
</div>

<!-- Inscription Date Field -->
<div class="form-group">
    {!! Form::label('inscription_date', 'Inscription Date:') !!}
    <p>{{ $userEvent->inscription_date }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userEvent->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userEvent->updated_at }}</p>
</div>

