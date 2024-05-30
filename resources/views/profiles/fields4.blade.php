<div class="row">
    <div class="col-2">
    </div>
    <div class="col-10">
        <!-- Dni Field -->
        <div class="form-group col" >
            {!! Form::label('dni', 'Cargar foto de DNI frontal:') !!}
            <div class="row" id="dni_file3w">
                <div class="custom-file col-6 ml-2" id="rrr3w">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni3')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni3" id="dni3" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni3"   value = {{ $profile->dni3 }}>
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni3">
                    <button class="btn btn-primary" id="loading_btn_dni3" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_dni3"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni3" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni3)
                <div id="alert_wrapper_dni3" class="alert_wrapper_dni3 fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->dni3}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_dni3">
                    </div>
                @endif
                
            </div>

        </div>

        <div class="form-group col">
            {!! Form::label('dni_r', 'Cargar foto de DNI posterior:') !!}
            <div class="row" id="dni_file3_r">
                <div class="custom-file col-6 ml-2" id="rrr3_r">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_dni3_r')) !!}
                    <input type="file" accept="image/*" class="custom-file-input" name="dni3_r" id="dni3_r" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_dni3_r"   value = {{ $profile->dni3_r }}>    
                </div>

                <div class="col-5 d-none" id="show_progress_bar_dni3_r">
                    <button class="btn btn-primary" id="loading_btn_dni3_r" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_dni3_r"></span>
                    </button>
                    <button type="button" id="cancel_btn_dni3_r" class="btn btn-secondary "> Cancelar Carga </button>
                </div>

                @if ($profile->dni3_r)
                <div id="alert_wrapper_dni3_r" class="alert_wrapper_dni3_r fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->dni3_r}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_dni3_r">
                    </div>
                @endif
            </div>

        </div>

        <!-- First Name Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('first_name', 'Nombres:') !!}
            {!! Form::text('first_name3', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('lastname', 'Apellidos:') !!}
            {!! Form::text('lastname3', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Type Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
            {!! Form::select('type_document3', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Number Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
            {!! Form::text('identification_number3', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
        </div>

        <!-- Country Document Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('country_document3', 'País emisor del documento de identidad:') !!}
            {!! Form::select('country_document3',$countries, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Sex Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('sex', 'Sexo:') !!}
            {!! Form::select('sex3', $sex_list, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Birthdate Field -->
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('birthdate', 'Fecha de nacimiento:') !!}
            {!! Form::date('birthdate3', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Nacionality Field -->

        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('nacionality', 'Nacionalidad:') !!}
            {!! Form::text('nacionality3', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-8">
            {!! Form::label('country_sel3', 'Seleccione país, región y ciudad:') !!}
        </div>

        <div class="form-inline">
        <!-- City Field -->
            <div class="form-group col-sm-2">
                {!! Form::label('country3', 'Pais:') !!}
                {!! Form::select('country3',$countries, null, ['class' => 'form-control', 'style' => 'width: 180px; ','empty'=>'Seleccionar']) !!}
            </div>

            <div class="form-group col-sm-2">
                {!! Form::label('city', 'Region:') !!}
                {!! Form::text('city3', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
            <div class="form-group col-sm-2">
                {!! Form::label('state', 'Cuidad:') !!}
                {!! Form::text('state3', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
        </div>

        <div class="form-group col-sm-8">
            {!! Form::label('address', 'Dirección de recidencia:') !!}
            {!! Form::text('address3', null, ['class' => 'form-control','maxlength' => '50']) !!}
        </div>
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('phone', 'Número de celular:') !!}
            {!! Form::text('phone3', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-8" style="display: none;">
            {!! Form::label('job', 'Ocupación o profesión:') !!}
            {!! Form::text('job3', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col">
            {!! Form::label('photo', 'Carga una foto de perfil:') !!}
            <div class="row" id="file3_profile_picture3">
                <div class="custom-file col-6 ml-2" id="rrr3_profile_picture3">
                    {!! Form::label('dni', "Select file",array('class' => 'custom-file-label ','for'=>'image','id'=>'file_input_label_profile_picture3')) !!}
                    <input type="file"  accept="image/*"  class="custom-file-input" name="profile_picture3" id="profile_picture3" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                    <input type="text" class="d-none" id="hide_profile_picture3"   value = {{ $profile->profile_picture3 }}>    
                </div>

                <div class="col-5 d-none" id="show_progress_bar_profile_picture3">
                    <button class="btn btn-primary" id="loading_btn_profile_picture3" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Cargando...
                        <span id="load_percentage_profile_picture3"></span>
                    </button>
                    <button type="button" id="cancel_btn_profile_picture3" class="btn btn-secondary "> Cancelar Carga </button>
                </div>
                @if ($profile->profile_picture3)
                <div id="alert_wrapper_profile_picture3" class="alert_wrapper_profile_picture3 fade show" >
                    <div class="row">
                            <div class="col-12 mt-2">
                                <img src="/storage/{{$profile->profile_picture3}}" style="max-width: 20vw; max-height: 10vh;"/>
                            </div>
                    </div>
                </div>
                @else
                    <div class="col-5 d-none" id="alert_wrapper_profile_picture3">
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
            {!! Form::text('address_wallet3', null, ['class' => 'form-control','maxlength' => '100']) !!}
        </div-->

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Enviar a revision', ['class' => 'btn btn-primary','id'=>'save-socio-2']) !!}
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
