<!-- Dni Field -->
<div class="form-group col-sm-6">
    <img src="{{ url('/storage', $profile->dni) }}" width="300px"/>
    <img src="{{ url('/storage', $profile->dni_r) }}" width="300px"/>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>



<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
    {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Number Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
    {!! Form::text('identification_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
    {!! Form::text('country_document',null, ['class' => 'form-control','autocomplete'=>'off']) !!}
</div>

<!-- Sex Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sex', 'Sexo:') !!}
    {!! Form::select('sex', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
    {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Nacionality Field -->
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('nacionality', 'Nacionalidad:') !!}
    {!! Form::text('nacionality', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('country', 'País:') !!}
        {!! Form::text('country',null, ['class' => 'form-control client_country', 'style' => 'width: 180px; ','empty'=>'Seleccionar','autocomplete'=>'off']) !!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('city', 'Región:') !!}
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
    </div>
</div>



<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección residencia:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Foto de perfil:') !!}
    <br>
    <img src="{{ url('/storage', $profile->profile_picture) }}" width="300px"/>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address_wallet', 'Dirección Wallet:') !!}
    {!! Form::text('address_wallet', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check1" id="check1" checked> Acepto declaración jurada</label>
</div>
<div class="form-group col-sm-6" style="display: none;">
    <label><input type="checkbox" value="1" name="check2" id="check2" checked> Acepto contrato</label>
</div>




<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>
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


