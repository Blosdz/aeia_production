{{-- <div class="row"> --}}
<div class="justify-content-center text-align-center p-5">
        <!-- Dni Field -->
        <div class="form-group col" >
            {!! Form::label('dni', 'Cargar foto de DNI frontal:') !!}
            <div class="row" id="dni_file">
                <div class="custom-file col ml-2" id="rrr">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni" id="dni" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)" >
                    <input type="text" class="d-none" id="hide_dni"   value = {{ $profile->dni }}>
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni">
                    <button class="btn btn-primary" id="loading_btn_dni" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_dni"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni)
                    <div id="alert" class="alert_wrapper_dni fade show" >
                        <div class="row">
                                <div class="col mt-2">
                                    <img src="/storage/{{$profile->dni}}" style="max-width: 20vw; max-height: 10vh;"/>
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
            {!! Form::label('dni_r', 'Cargar foto de DNI posterior:') !!}
            <div class="row" id="dni_file2">
                <div class="custom-file col ml-2" id="rrr2">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni_r')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni_r" id="dni_r" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni_r"   value = {{ $profile->dni_r }}>    
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni_r">
                    <button class="btn btn-primary" id="loading_btn_dni_r" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_dni_r"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni_r" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni_r)
                    <div id="alert_wrapper_dni_r" class="alert_wrapper_dni_r fade show" >
                        <div class="row">
                                <div class="col mt-2">
                                    <img src="/storage/{{$profile->dni_r}}" style="max-width: 20vw; max-height: 10vh;"/>
                                </div>
                        </div>
                    </div>
                @else
                    <div class="col d-none" id="alert_wrapper_dni_r">
                    </div>
                @endif
            </div>

        </div>

        <!-- First Name Field -->
        <div class="form-group col">
            {!! Form::label('first_name', 'Nombres:') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col">
            {!! Form::label('lastname', 'Apellidos:') !!}
            {!! Form::text('lastname', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Type Document Field -->
        <div class="form-group col">
            {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
            {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Number Document Field -->
        <div class="form-group col">
            {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
            {!! Form::text('identification_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
        </div>

        <!-- Country Document Field -->
        <div class="form-group col">
            {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
            {!! Form::select('country_document',$countries, null, ['class' => 'form-control','autocomplete'=>'off']) !!}
        </div>

        <div class="form-group col">
            {!! Form::label('phone_code', 'Código de país:') !!}
            {!! Form::select('phone_code', [
                '+51' => '+51 (Peru)',
                '+1' => '+1 (USA/Canada)',
                '+44' => '+44 (UK)',
                '+52' => '+52 (Mexico)',
                '+91' => '+91 (India)',
            ], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col" >
            {!! Form::label('phone', 'Número de celular:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
        </div>

        <!-- Sex Field -->
        <div class="form-group col">
            {!! Form::label('sex', 'Sexo:') !!}
            {!! Form::select('sex', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Birthdate Field -->
        <div class="form-group col" style="display: none;">
            {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
            {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nacionality Field -->
        <div class="form-group col" style="display: none;">
            {!! Form::label('nacionality', 'Nacionalidad:') !!}
            {!! Form::text('nacionality', null, ['class' => 'form-control', 'value'=>'-']) !!}
        </div>

        <div class="form-group col">
            {!! Form::label('country_sel', 'Seleccione país, región y ciudad:') !!}
        </div>

        <div class="form-group">
        <!-- City Field -->
            <div class="form-group col">
                {!! Form::label('country', 'País:') !!}
                {!! Form::select('country',$countries, null, ['class' => 'form-control client_country', 'style' => 'width: 180px; ','autocomplete'=>'off']) !!}
            </div>

            <div class="form-group col">
                {!! Form::label('city', 'Región:') !!}
                {!! Form::text('city', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
            <div class="form-group col">
                {!! Form::label('state', 'Cuidad:') !!}
                {!! Form::text('state', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
        </div>

        <div class="form-group col">
            {!! Form::label('address', 'Dirección de residencia:') !!}
            {!! Form::text('address', null, ['class' => 'form-control','maxlength' => '50']) !!}
        </div>

        <div class="form-group col">
            {!! Form::label('photo', 'Carga una foto de perfil:') !!}
            <div class="row" id="file3">
                <div class="custom-file col-6 ml-2" id="rrr3">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_profile_picture')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="profile_picture" id="profile_picture" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_profile_picture"   value = {{ $profile->profile_picture }}>    
                </div>

                <div class="col-5 d-none" id="show_progress_bar_profile_picture">
                    <button class="btn btn-primary" id="loading_btn_profile_picture" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_profile_picture"></span>
                    </button>
                    <button type="button" id="cancel_btn_profile_picture" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->profile_picture)
                <div id="alert_wrapper_profile_picture" class="alert_wrapper_profile_picture fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->profile_picture}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_profile_picture">
                    </div>
                @endif
            </div>

        </div>
	        <!-- BANK USER -->
        <div class="form-group col">
            {!! Form::label('bank_name', 'Entidad Bancaria:') !!}
            {!! Form::text('bank_name', null, ['class' => 'form-control','maxlength' => '20']) !!}
        </div>
        <!-- CARD NUMBER -->
        <div class="form-group col">
            {!! Form::label('card_number', 'Número de cuenta:') !!}
            {!! Form::text('card_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '16']) !!}
        </div>
        <!-- CCI -->
        <div class="form-group col">
            {!! Form::label('cci_card', 'CCI:') !!}
            {!! Form::text('cci_card', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '30']) !!}
        </div>

        <div class="form-group col" style="display: none;">
            {!! Form::label('photo', 'Foto de perfil:') !!}
            <p>{!! Form::file('photo', ['accept'=>'image/*']) !!}</p>
        </div>

        <div class="form-group col">
            {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
            {!! Form::text('address_wallet', null, ['class' => 'form-control','maxlength' => '100']) !!}
        </div>

        <div class="form-group col p-4" style="display: none;">
            <label><input type="checkbox" value="1" name="check1" id="check1" class="checks"> Acepto declaración jurada</label>
        </div>
        <div class="form-group col p-4" style="display: none;">
            <label><input type="checkbox" value="1" name="check2" id="check2" class="checks"> Acepto contrato</label>
        </div>



        <div class="form-group col p-4" style="display: none;">
            {!! Form::label('job', 'Ocupación o profesión:') !!}
            {!! Form::text('job', null, ['class' => 'form-control', 'value'=>'-']) !!}
        </div>
        <input type="text" class="d-none" id="csrftoken" value="DRkTPyJFOmAKia3Eg7gtdunSJvGIaLPvu6bkcu2G">

        <!-- Submit Field -->
        <div class="form-group col p-4">
            {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary save-client', 'id'=>'btn-send']) !!}
        </div>
</div>
<script src="{{ asset('upload_file.js') }}"></script>
<script>
    $( document ).ready(function() {
        
        $('.checks').change(function(){
            $('#btn-send').prop('disabled', true);
            if ( $('#check1').is(':checked') && $('#check2').is(':checked') ) {
                $('#btn-send').prop('disabled', false);
            }
        });
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

</script>

