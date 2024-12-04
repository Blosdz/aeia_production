<!-- Dni Field -->
<div class="form-group col-sm-6">
    <img src="{{ url('/storage', $profile->dni) }}" width="300px"/>
    <img src="{{ url('/storage', $profile->dni_r) }}" width="300px"/>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres del representante legal:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => '30']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Apellidos del representante legal:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control','maxlength' => '30']) !!}
</div>

<!-- Type Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_document', 'Tipo de documento de identidad del representante legal:') !!}
    {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
</div>

<!-- Number Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_document', 'Número de documento de indentidad del representante legal:') !!}
    {!! Form::text('identification_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
</div>

<!-- Country Document Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_document', 'País emisor del documento de identidad del representante legal:') !!}
    {!! Form::text('country_document', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
</div>

<!-- Birthdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthdate', 'Fecha de nacimiento del representante legal:') !!}
    {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_sel', 'Seleccione país, región y ciudad:') !!}
</div>

<div class="form-inline">
<!-- City Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('country', 'País:') !!}
        {!! Form::text('country', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('city', 'Región:') !!}
        {!! Form::text('city', null, ['class' => 'form-control','maxlength' => '20']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('state', 'Cuidad:') !!}
        {!! Form::text('state', null, ['class' => 'form-control','maxlength' => '20']) !!}
    </div>
</div>
<br>


@php
    $url1 = url('/storage/', $profile->business_file);
    $url2 = url('/storage/', $profile->power_file);
    $url3 = url('/storage/', $profile->taxes_file);
    $file_name = 'Descargar archivo';
@endphp

<div class="form-group col-sm-6">
    {!! Form::label('business_file', 'Acta de constitución de la empresa:') !!}
    <p>
        <a href="{{ $url1 }}"  class='btn btn-ghost-info' download>
            {{$file_name}} <i class="fa fa-download"></i>
        </a>
    </p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('power_file', 'Vigencia de poderes no mayor a 3 meses:') !!}
    <p>
        <a href="{{ $url2 }}"  class='btn btn-ghost-info' download>
            {{$file_name}} <i class="fa fa-download"></i>
        </a>
    </p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('taxes_file', 'Ficha de ruc o ID Taxes:') !!}
    <p>
        <a href="{{ $url3 }}"  class='btn btn-ghost-info' download>
            {{$file_name}} <i class="fa fa-download"></i>
        </a>
    </p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
    {!! Form::text('address_wallet', null, ['class' => 'form-control','maxlength' => '100']) !!}

</div>
        <!-- BANK USER -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_name', 'Entidad Bancaria:') !!}
    {!! Form::text('bank_name', null, ['class' => 'form-control','maxlength' => '20']) !!}
</div>
<!-- CARD NUMBER -->
<div class="form-group col-sm-6">
    {!! Form::label('card_number', 'Número de tarjeta:') !!}
    {!! Form::text('card_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '16']) !!}
</div>
<!-- CCI -->
<div class="form-group col-sm-6">
    {!! Form::label('cci_card', 'CCI:') !!}
    {!! Form::text('cci_card', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '30']) !!}
</div>



<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('phone', 'Número de celular:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>
<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job', 'Ocupación o profesión:') !!}
    {!! Form::text('job', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>