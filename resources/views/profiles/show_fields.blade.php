<!-- Dni Field -->
<div class="form-group">
    {!! Form::label('dni', 'Dni:') !!}
    <br>
    <img src="{{ url('/storage', $profile->dni) }}" width="300px"/>
</div>

<!-- First Name Field -->
<div class="form-group">
    {!! Form::label('first_name', 'Nombres:') !!}
    <p>{{ $profile->first_name }}</p>
</div>

<!-- Lastname Field -->
<div class="form-group">
    {!! Form::label('lastname', 'Apellidos:') !!}
    <p>{{ $profile->lastname }}</p>
</div>

<!-- Country Document Field -->
<div class="form-group">
    {!! Form::label('country_document', 'Pais de Documento:') !!}
    <p>{{ $profile->country_document }}</p>
</div>

<!-- Type Document Field -->
<div class="form-group">
    {!! Form::label('type_document', 'Tipo de Documento:') !!}
    <p>{{ $profile->type_document }}</p>
</div>

<!-- Birthdate Field -->
<div class="form-group">
    {!! Form::label('birthdate', 'Fecha de Nacimiento') !!}
    <p>{{ $profile->birthdate }}</p>
</div>

<!-- Nacionality Field -->
<div class="form-group">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    <p>{{ $profile->nacionality }}</p>
</div>

<!-- City Field -->
<div class="form-group">
    {!! Form::label('city', 'Ciudad:') !!}
    <p>{{ $profile->city }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Creado en:') !!}
    <p>{{ $profile->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Actualizado en:') !!}
    <p>{{ $profile->updated_at }}</p>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('card_number', 'Numero de cuenta:') !!}
    <p>{{ $profile->card_number }}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('card_number', 'Entidad Bancaria:') !!}
    <p>{{ $profile->bank_name}}</p>
</div>



<div class="form-group col-sm-6">
    {!! Form::label('cci_card', 'CCI:') !!}
    <p>{{ $profile->cci_card }}</p>
</div>


