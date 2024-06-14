<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $plan->name }}</p>
</div>

<!-- Minimum Fee Field -->
<div class="form-group">
    {!! Form::label('minimum_fee', 'Minimum Fee:') !!}
    <p>{{ $plan->minimum_fee }}</p>
</div>

<!-- Maximum Fee Field -->
<div class="form-group">
    {!! Form::label('maximum_fee', 'Maximum Fee:') !!}
    <p>{{ $plan->maximum_fee }}</p>
</div>

<!-- Annual Membership Field -->
<div class="form-group">
    {!! Form::label('annual_membership', 'Annual Membership:') !!}
    <p>{{ $plan->annual_membership }}</p>
</div>

<!-- Commission Field -->
<div class="form-group">
    {!! Form::label('commission', 'Commission:') !!}
    <p>{{ $plan->commission }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $plan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $plan->updated_at }}</p>
</div>

