<!-- Dni Field -->
<div class="form-group col-sm-6">
    <img src="{{ url('/storage', $profile->dni3) }}" width="300px"/>
    <img src="{{ url('/storage', $profile->dni3_r) }}" width="300px"/>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres:') !!}
    {!! Form::text('first_name3', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos:') !!}
    {!! Form::text('lastname3', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::text('type_document3', null, ['class' => 'form-control']) !!}
</div>

<!-- Number Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
    {!! Form::text('identification_number3', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
    {!! Form::text('country_document3', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('phone_extension', 'Código de país:') !!}
    {!! Form::select('phone_extension', [
        51 => '+51 (Peru)',
        1 => '+1 (USA/Canada)',
        44 => '+44 (UK)',
        52 => '+52 (Mexico)',
        91 => '+91 (India)',
    ], 'phone_extension', ['class' => 'form-control']) !!} <!-- Default to '1' if not set -->
</div>

<div class="form-group col-sm-6" >
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sex', 'Sexo:') !!}
    {!! Form::select('sex3', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
    {!! Form::text('birthdate3', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionality Field -->

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    {!! Form::text('nacionality3', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel3', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('country', 'País:') !!}
        {!! Form::text('country3', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('city', 'Región:') !!}
        {!! Form::text('city3', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state3', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección de recidencia:') !!}
    {!! Form::text('address3', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone3', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job3', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'foto de perfil:') !!}
    <br>
    <img src="{{ url('/storage', $profile->profile_picture3) }}" width="300px"/>

</div>
<div class="form-group col-sm-6">
    {!! Form::label('address_wallet', 'Dirección Wallet:') !!}
    {!! Form::text('address_wallet3', null, ['class' => 'form-control']) !!}
</div>
<!-- BANK USER -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_name', 'Entidad Bancaria:') !!}
    {!! Form::text('bank_name', null, ['class' => 'form-control','maxlength' => '20']) !!}
</div>
<!-- CARD NUMBER -->
<div class="form-group col-sm-6">
    {!! Form::label('card_number', 'Número de cuenta:') !!}
    {!! Form::text('card_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '16']) !!}
</div>
<!-- CCI -->
<div class="form-group col-sm-6">
    {!! Form::label('cci_card', 'CCI:') !!}
    {!! Form::text('cci_card', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '30']) !!}
</div>