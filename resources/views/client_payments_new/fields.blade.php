<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Payment Id:') !!}
    {!! Form::text('payment_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Referred Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('referred_code', 'Referred Code:') !!}
    {!! Form::text('referred_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Referred User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('referred_user_id', 'Referred User Id:') !!}
    {!! Form::text('referred_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('clientPayments.index') }}" class="btn btn-secondary">Cancel</a>
</div>
