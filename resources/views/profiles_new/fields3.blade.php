<div class="row">
    <div class="col-2">
    </div>
    <div class="col-10">
<!-- Dni Field -->
        <div class="form-group col" >
            {!! Form::label('dni', 'Cargar foto de DNI frontal:') !!}
            <div class="row" id="dni_file2w">
                <div class="custom-file col-6 ml-2" id="rrr2w">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni2')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni2" id="dni2" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni2"   value = {{ $profile->dni2 }}>
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni2">
                    <button class="btn btn-primary" id="loading_btn_dni2" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_dni2"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni2" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni2)
                <div id="alert_wrapper_dni2" class="alert_wrapper_dni2 fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->dni2}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_dni2">
                    </div>
                @endif
            </div>

        </div>

        <div class="form-group col">
            {!! Form::label('dni_r', 'Cargar foto de DNI posterior:') !!}
            <div class="row" id="dni_file2_r">
                <div class="custom-file col-6 ml-2" id="rrr2_r">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni2_r')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni2_r" id="dni2_r" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni2_r"   value = {{ $profile->dni2_r }}>    
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni2_r">
                    <button class="btn btn-primary" id="loading_btn_dni2_r" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_dni2_r"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni2_r" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni2_r)
                <div id="alert_wrapper_dni2_r" class="alert_wrapper_dni2_r fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->dni2_r}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_dni2_r">
                    </div>
                @endif

            </div>

        </div>

        <!-- First Name Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('first_name', 'Nombres:') !!}
            {!! Form::text('first_name2', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('lastname', 'Apellidos:') !!}
            {!! Form::text('lastname2', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Type Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
            {!! Form::select('type_document2', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Number Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
            {!! Form::text('identification_number2', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
        </div>

        <!-- Country Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('country_document2', 'País emisor del documento de identidad:') !!}
            {!! Form::select('country_document2',$countries, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Sex Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('sex', 'Sexo:') !!}
            {!! Form::select('sex2', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Birthdate Field -->
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
            {!! Form::date('birthdate2', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nacionality Field -->

        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('nacionality', 'Nacionalidad:') !!}
            {!! Form::text('nacionality2', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-8">
            {!! Form::label('country_sel2', 'Seleccione país, región y ciudad:') !!}
        </div>

        <div class="form-inline">
        <!-- City Field -->
            <div class="form-group col-sm-2">
                {!! Form::label('country2', 'País:') !!}
                {!! Form::select('country2', $countries, null, ['class' => 'form-control', 'style' => 'width: 180px; ','empty'=>'Seleccionar']) !!}
            </div>

            <div class="form-group col-sm-2">
                {!! Form::label('city', 'Región:') !!}
                {!! Form::text('city2', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label('state', 'Cuidad:') !!}
                {!! Form::text('state2', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
        </div>

        <div class="form-group col-sm-8">
            {!! Form::label('address', 'Dirección de recidencia:') !!}
            {!! Form::text('address2', null, ['class' => 'form-control','maxlength' => '50']) !!}
        </div>
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('phone', 'Número de celular:') !!}
            {!! Form::text('phone2', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('job', 'Ocupación o profesión:') !!}
            {!! Form::text('job2', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col">
            {!! Form::label('photo', 'Carga una foto de perfil:') !!}
            <div class="row" id="file3_profile_picture">
                <div class="custom-file col-6 ml-2" id="rrr3_profile_picture">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_profile_picture2')) !!}
                    <input type="file"  accept="image/*" class="custom-file-input" name="profile_picture2" id="profile_picture2" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_profile_picture2"   value = {{ $profile->profile_picture2 }}>    
                </div>

                <div class="col-5 d-none" id="show_progress_bar_profile_picture2">
                    <button class="btn btn-primary" id="loading_btn_profile_picture2" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_profile_picture2"></span>
                    </button>
                    </button>
                    <button type="button" id="cancel_btn_profile_picture2" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->profile_picture2)
                <div id="alert_wrapper_profile_picture2" class="alert_wrapper_profile_picture2 fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->profile_picture2}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_profile_picture2">
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



        <!--div class="form-group col-sm-8">
            {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
            {!! Form::text('address_wallet2', null, ['class' => 'form-control','maxlength' => '100']) !!}
        </div-->

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary','id'=>'save-socio-1']) !!}
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
