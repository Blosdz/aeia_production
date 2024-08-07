<!-- Dni Field -->
<div class="row">
    <div class="col-2">
    </div>
    <div class="col-10">
        <div class="form-group col">
            {!! Form::label('dni', 'Cargar foto de DNI frontal:') !!}
            <div class="row" id="dni_file">
                <div class="custom-file col-6 ml-2" id="rrr">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni" id="dni" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni" value={{ $profile->dni }}>
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni">
                    <button class="btn btn-primary" id="loading_btn_dni" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                        <span id="load_percentage_dni"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni)
                <div id="alert" class="alert_wrapper_dni fade show">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <img src="/storage/{{$profile->dni}}" style="max-width: 20vw; max-height: 10vh;" />
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
                <div class="custom-file col-6 ml-2" id="rrr2">
                    {!! Form::label('dni_r', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni_r')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni_r" id="dni_r" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni_r" value={{ $profile->dni_r }}>
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni_r">
                    <button class="btn btn-primary" id="loading_btn_dni_r" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                        <span id="load_percentage_dni_r"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni_r" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni_r)
                <div id="alert_wrapper_dni_r" class="alert_wrapper_dni_r fade show">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <img src="/storage/{{$profile->dni_r}}" style="max-width: 20vw; max-height: 10vh;" />
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_dni_r">
                    </div>
                @endif

            </div>

        </div>

        <!-- First Name Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('first_name', 'Nombres:') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('lastname', 'Apellidos:') !!}
            {!! Form::text('lastname', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Type Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
            {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Number Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
            {!! Form::text('identification_number', null, ['class' => 'form-control', 'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
        </div>

        <!-- Country Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
            {!! Form::select('country_document', $countries, null, ['class' => 'form-control subscribe_country','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Sex Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('sex', 'Sexo:') !!}
            {!! Form::select('sex', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Birthdate Field -->
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
            {!! Form::date('birthdate', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nacionality Field -->

        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('nacionality', 'Nacionalidad:') !!}
            {!! Form::text('nacionality', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-8">
            {!! Form::label('country_sel', 'Seleccione país, región y ciudad:') !!}
        </div>

        <div class="form-inline">
            <!-- City Field -->
            <div class="form-group col-sm-2">
                {!! Form::label('country', 'Pais:') !!}
                {!! Form::select('country', $countries, null, ['class' => 'form-control subscribe_country', 'style' => 'width: 180px; ','empty'=>'Seleccionar']) !!}
            </div>

            <div class="form-group col-sm-2">
                {!! Form::label('city', 'Region:') !!}
                {!! Form::text('city', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label('state', 'Cuidad:') !!}
                {!! Form::text('state', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
        </div>

        <div class="form-group col-sm-8">
            {!! Form::label('address', 'Dirección de recidencia:') !!}
            {!! Form::text('address', null, ['class' => 'form-control','maxlength' => '50']) !!}
        </div>
        <div class="form-group col-sm-6">
            {!! Form::label('phone_code', 'Código de país:') !!}
            {!! Form::select('phone_code', [
                '+51' => '+51 (Peru)',
                '+1' => '+1 (USA/Canada)',
                '+44' => '+44 (UK)',
                '+52' => '+52 (Mexico)',
                '+91' => '+91 (India)',
            ], null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-6" >
            {!! Form::label('phone', 'Número de celular:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
        </div>
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('phone', 'Número de celular:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('job', 'Ocupación o profesión:') !!}
            {!! Form::text('job', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col">
            {!! Form::label('photo', 'Carga una foto de perfil:') !!}
            <div class="row" id="file3">
                <div class="custom-file col-6 ml-2" id="rrr3">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_profile_picture')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="profile_picture" id="profile_picture" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_profile_picture" value={{ $profile->profile_picture }}>
                </div>

                <div class="col-5 d-none" id="show_progress_bar_profile_picture">
                    <button class="btn btn-primary" id="loading_btn_profile_picture" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                        <span id="load_percentage_profile_picture"></span>
                    </button>
                    <button type="button" id="cancel_btn_profile_picture" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->profile_picture)
                <div id="alert_wrapper_profile_picture" class="alert_wrapper_profile_picture fade show">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <img src="/storage/{{$profile->profile_picture}}" style="max-width: 20vw; max-height: 10vh;" />
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



        <div class="form-group col-sm-8">
            {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
            {!! Form::text('address_wallet', null, ['class' => 'form-control','maxlength' => '100']) !!}
            <span class="float-right">¿No tienes un wallet? <a href="https://accounts.binance.com/es-LA/register" target="_blank">Regístrate aquí.</a></span>
        </div>
        <div class="form-group col-sm-8">
            {!! Form::label('address_wallet', 'Cuenta de Telegram:') !!}
            <div class="d-flex flex-row">
               <i style="font-size: 2rem; margin-right: 10px;" class="fa fa-telegram fa-10x"></i> {!! Form::text('telegram', null, ['placeholder'=>'Ingrese usuario Telegram','class' => 'form-control','maxlength' => '32']) !!}
            </div>
        </div>



        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary','id'=>'save-socio-main']) !!}
        </div>
    </div>
</div>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
