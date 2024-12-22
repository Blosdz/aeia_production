
<div class="justify-content-center text-align-center p-5">
    <div class="form-group col">
        {!! Form::label('dni2', 'Cargar foto de DNI frontal:') !!}
        <div class="row" id="dni_file">
            <div class="custom-file col-6 ml-2" id="rrr">
                {!! Form::label('dni2', "Select file", ['class' => 'custom-file-label', 'for'=>'image', 'id'=>'file_input_label_dni2']) !!}
                <input type="file" accept="image/*" class="custom-file-input" name="dni2" id="dni2" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)" >
                <input type="text" class="d-none" id="hide_dni2" value="{{ $profile->dni2 }}">
            </div>

            <div class="col-5 d-none" id="show_progress_bar_dni">
                <button class="btn btn-primary" id="loading_btn_dni" type="button" disabled >
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                    <span id="load_percentage_dni"></span>
                </button>
                <button type="button" id="cancel_btn_dni" class="btn btn-secondary "> Cancelar Carga </button>
            </div>

            @if ($profile->dni2)
                <div id="alert" class="alert_wrapper_dni fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->dni2}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
            @else
                <div class="col-5 d-none" id="alert_wrapper_dni">
                </div>
            @endif

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

            <div class="col-5 d-none" id="show_progress_bar_dni_r">
                <button class="btn btn-primary" id="loading_btn_dni_r" type="button" disabled >
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                    <span id="load_percentage_dni_r"></span>
                </button>
                <button type="button" id="cancel_btn_dni_r" class="btn btn-secondary "> Cancelar Carga </button>
            </div>

            @if ($profile->dni2_r)
                <div id="alert_wrapper_dni_r" class="alert_wrapper_dni_r fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->dni2_r}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
            @else
                <div class="col-5 d-none" id="alert_wrapper_dni_r">
                </div>
            @endif
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

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Enviar a revisión', ['class' => 'btn btn-primary save-business', 'id'=>'btn-send']) !!}
    </div>
</div>