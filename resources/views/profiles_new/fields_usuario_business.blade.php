<!-- Dni Field -->
<div class="justify-content-center text-align-center p-5">
    <div class="form-group col" >
        {!! Form::label('dni', 'Cargar foto de DNI frontal del representante legal:') !!}
        <div class="row" id="dni_file">
            <div class="custom-file col-6 ml-2" id="rrr">
                {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni')) !!}
                <input type="file" accept="image/*" class="custom-file-input" name="dni" id="dni" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
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

            <div class="col-5 d-none" id="alert_wrapper_dni">
            </div>
        </div>

    </div>

    <div class="form-group col">
        {!! Form::label('dni_r', 'Cargar foto de DNI posterior del representante legal:') !!}
        <div class="row" id="dni_file2">
            <div class="custom-file col-6 ml-2" id="rrr2">
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

            <div class="col-4 d-none" id="alert_wrapper_dni_r">
            </div>
        </div>

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
        {!! Form::select('country_document',$countries, null, ['class' => 'form-control','autocomplete'=>'off']) !!}
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
            {!! Form::select('country',$countries, null, ['class' => 'form-control client_country', 'style' => 'width: 180px; ','autocomplete'=>'off']) !!}
        </div>

        <div class="form-group col-sm-3">
            {!! Form::label('city', 'Región:') !!}
            {!! Form::text('city', null, ['class' => 'form-control','maxlength' => '20']) !!}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('state', 'Ciudad:') !!}
            {!! Form::text('state', null, ['class' => 'form-control','maxlength' => '20']) !!}
        </div>
    </div>
    <br>


    <div class="form-group col" >
        {!! Form::label('photo', 'Acta de constitución de la empresa:') !!}
        <div class="row" id="dni_fileewew">
            <div class="custom-file col-6 ml-2" id="rrrewewe">
                {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_business_file')) !!}
                <input type="file"  accept="application/pdf" class="custom-file-input" name="business_file" id="business_file" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                <input type="text" class="d-none" id="hide_business_file"   value = {{ $profile->business_file }}>
            </div>

            <div class="col-5 d-none" id="show_progress_bar_business_file">
                <button class="btn btn-primary" id="loading_btn_business_file" type="button" disabled >
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                    <span id="load_percentage_business_file"></span>
                </button>
                <button type="button" id="cancel_btn_business_file" class="btn btn-secondary "> Cancelar Carga </button>
            </div>

            <div class="col-5 d-none" id="alert_wrapper_business_file">
            </div>
        </div>
    </div>

    <div class="form-group col" >
        {!! Form::label('photo', 'Vigencia de poderes no mayor a 3 meses:') !!}
        <div class="row" id="power_file_sw">
            <div class="custom-file col-6 ml-2" id="power_file_rrrw">
                {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_power_file')) !!}
                <input type="file" accept="application/pdf" class="custom-file-input" name="power_file" id="power_file" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                <input type="text" class="d-none" id="hide_power_file"   value = {{ $profile->power_file }}>
            </div>

            <div class="col-5 d-none" id="show_progress_bar_power_file">
                <button class="btn btn-primary" id="loading_btn_power_file" type="button" disabled >
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                    <span id="load_percentage_power_file"></span>
                </button>
                <button type="button" id="cancel_btn_power_file" class="btn btn-secondary "> Cancelar Carga </button>
            </div>

            <div class="col-5 d-none" id="alert_wrapper_power_file">
            </div>
        </div>

    </div>

    <div class="form-group col" >
        {!! Form::label('photo', 'Ficha de ruc o ID Taxes:') !!}
        <div class="row" id="taxes_file_sw">
            <div class="custom-file col-6 ml-2" id="taxes_file_s2w">
                {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_taxes_file')) !!}
                <input type="file" accept="application/pdf" class="custom-file-input" name="taxes_file" id="taxes_file" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                <input type="text" class="d-none" id="hide_taxes_file"   value = {{ $profile->taxes_file }}>
            </div>

            <div class="col-5 d-none" id="show_progress_bar_taxes_file">
                <button class="btn btn-primary" id="loading_btn_taxes_file" type="button" disabled >
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Cargando...
                    <span id="load_percentage_taxes_file"></span>
                </button>
                <button type="button" id="cancel_btn_taxes_file" class="btn btn-secondary "> Cancelar Carga </button>
            </div>

            <div class="col-5 d-none" id="alert_wrapper_taxes_file">
            </div>
        </div>

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

    <div class="form-group col-sm-6">
        {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
        {!! Form::text('address_wallet', null, ['class' => 'form-control','maxlength' => '100']) !!}
    </div>

    <div class="form-group col-sm-6" style="display: none;">
        <label><input type="checkbox" value="1" name="check1"  id="check1" class="checks"> Acepto declaración jurada</label>
    </div>
    <div class="form-group col-sm-6" style="display: none;">
        <label><input type="checkbox" value="1" name="check2"  id="check2" class="checks"> Acepto contrato</label>
    </div>
    <div class="form-group col-sm-6" style="display: none;">
        <label><input type="checkbox" value="1" name="check3"  id="check3" class="checks"> Declaración OFAQ </label>
    </div>
    <div class="form-group col-sm-6" style="display: none;">
        <label><input type="checkbox" value="1" name="check4"  id="check4" class="checks"> Declaración de no estar expuesto políticamente </label>
    </div>
    <div class="form-group col-sm-6" style="display: none;">
        <label><input type="checkbox" value="1" name="check5"  id="check5" class="checks"> Declaración de fondos</label>
    </div>



    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary save-business', 'id'=>'btn-send']) !!}
    </div>
</div>

    <script>
        $( document ).ready(function() {

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
