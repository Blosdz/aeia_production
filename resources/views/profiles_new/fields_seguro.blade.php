<div class="form-group col">
    {!! Form::label('dni2', 'Cargar foto de DNI frontal:') !!}
    <div class="row" id="dni_file">
        <div class="custom-file col-6 ml-2" id="rrr">
            {!! Form::label('dni2', "Select file", ['class' => 'custom-file-label', 'for'=>'image', 'id'=>'file_input_label_dni2']) !!}
            <input type="file" accept="image/*" class="custom-file-input" name="dni2" id="dni2" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)" >
            <input type="text" class="d-none" id="hide_dni2" value="{{ $profile->dni2 }}">
        </div>
    </div>
</div>

<div class="form-group col">
    {!! Form::label('dni2_r', 'Cargar foto de DNI posterior:') !!}
    <div class="row" id="dni_file2">
        <div class="custom-file col-6 ml-2" id="rrr2">
            {!! Form::label('dni2_r', "Select file", ['class' => 'custom-file-label', 'for'=>'image', 'id'=>'file_input_label_dni2_r']) !!}
            <input type="file" accept="image/*" class="custom-file-input" name="dni2_r" id="dni2_r" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
            <input type="text" class="d-none" id="hide_dni2_r" value="{{ $profile->dni2_r }}">    
        </div>
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('first_name2', 'Nombres:') !!}
    {!! Form::text('first_name2', null, ['class' => 'form-control', 'maxlength' => '30']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('lastname2', 'Apellidos:') !!}
    {!! Form::text('lastname2', null, ['class' => 'form-control', 'maxlength' => '30']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('type_document2', 'Tipo de documento de identidad:') !!}
    {!! Form::select('type_document2', $document_types, null, ['class' => 'form-control', 'empty'=>'Seleccionar']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country_document2', 'País emisor del documento de identidad:') !!}
    {!! Form::select('country_document2', $countries, null, ['class' => 'form-control', 'autocomplete'=>'off']) !!}
</div>

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('birthdate2', 'Fecha de nacimiento:') !!}
    {!! Form::date('birthdate2', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('nacionality2', 'Nacionalidad:') !!}
    {!! Form::text('nacionality2', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('country2', 'País:') !!}
    {!! Form::select('country2', $countries, null, ['class' => 'form-control client_country', 'autocomplete'=>'off']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('city2', 'Región:') !!}
    {!! Form::text('city2', null, ['class' => 'form-control', 'maxlength' => '20']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('state2', 'Ciudad:') !!}
    {!! Form::text('state2', null, ['class' => 'form-control', 'maxlength' => '20']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('address2', 'Dirección de residencia:') !!}
    {!! Form::text('address2', null, ['class' => 'form-control', 'maxlength' => '50']) !!}
</div>

<div class="form-group col-sm-6" style="display: none;">
    {!! Form::label('job2', 'Ocupación o profesión:') !!}
    {!! Form::text('job2', null, ['class' => 'form-control', 'value'=>'-']) !!}
</div>

