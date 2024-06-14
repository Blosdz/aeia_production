<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $clientPayment->user_id }}</p>
</div>

<!-- Payment Id Field -->
<div class="form-group">
    {!! Form::label('payment_id', 'Payment Id:') !!}
    <p>{{ $clientPayment->payment_id }}</p>
</div>

<!-- Referred Code Field -->
<div class="form-group">
    {!! Form::label('referred_code', 'Referred Code:') !!}
    <p>{{ $clientPayment->referred_code }}</p>
</div>

<!-- Referred User Id Field -->
<div class="form-group">
    {!! Form::label('referred_user_id', 'Referred User Id:') !!}
    <p>{{ $clientPayment->referred_user_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $clientPayment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $clientPayment->updated_at }}</p>
</div>

