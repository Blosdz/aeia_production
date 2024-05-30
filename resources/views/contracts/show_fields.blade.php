<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $contract->user_id }}</p>
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $contract->type }}</p>
</div>

<!-- Full Name Field -->
<div class="form-group">
    {!! Form::label('full_name', 'Full Name:') !!}
    <p>{{ $contract->full_name }}</p>
</div>

<!-- Country Field -->
<div class="form-group">
    {!! Form::label('country', 'Country:') !!}
    <p>{{ $contract->country }}</p>
</div>

<!-- City Field -->
<div class="form-group">
    {!! Form::label('city', 'City:') !!}
    <p>{{ $contract->city }}</p>
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', 'State:') !!}
    <p>{{ $contract->state }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $contract->address }}</p>
</div>

<!-- Country Document Field -->
<div class="form-group">
    {!! Form::label('country_document', 'Country Document:') !!}
    <p>{{ $contract->country_document }}</p>
</div>

<!-- Type Document Field -->
<div class="form-group">
    {!! Form::label('type_document', 'Type Document:') !!}
    <p>{{ $contract->type_document }}</p>
</div>

<!-- Identification Number Field -->
<div class="form-group">
    {!! Form::label('identification_number', 'Identification Number:') !!}
    <p>{{ $contract->identification_number }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $contract->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $contract->updated_at }}</p>
</div>

