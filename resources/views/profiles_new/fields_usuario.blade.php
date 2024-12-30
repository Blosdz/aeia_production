{{-- <div class="row"> --}}

{!! Form::model($profile, ['route' => ['profiles.update2', $profile->id], 'method' => 'post', 'files' => true]) !!}
<div class="justify-content-center text-align-center p-5">
        <!-- Dni Field -->
        <div class="form-group col" >
            {!! Form::label('dni', 'Cargar foto de DNI frontal:') !!}
            <div class="row" id="dni_file">
                <div class="custom-file col-6 ml-2" id="rrr">
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
                                <div class="col-12 mt-2">
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

                @if ($profile->dni_r)
                    <div id="alert_wrapper_dni_r" class="alert_wrapper_dni_r fade show" >
                        <div class="row">
                                <div class="col-12 mt-2">
                                    <img src="/storage/{{$profile->dni_r}}" style="max-width: 20vw; max-height: 10vh;"/>
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
        <div class="form-group col-sm-6">
            {!! Form::label('first_name', 'Nombres:') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Lastname Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('lastname', 'Apellidos:') !!}
            {!! Form::text('lastname', null, ['class' => 'form-control','maxlength' => '30']) !!}
        </div>

        <!-- Type Document Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('type_document', 'Tipo de documento de identidad:') !!}
            {!! Form::select('type_document', $document_types, null, ['class' => 'form-control','empty'=>'Seleccionar']) !!}
        </div>

        <!-- Number Document Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('number_document', 'Número de documento de indentidad:') !!}
            {!! Form::text('identification_number', null, ['class' => 'form-control',  'onkeypress'=>'return isNumber(event)','maxlength' => '9']) !!}
        </div>

        <!-- Country Document Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('country_document', 'País emisor del documento de identidad:') !!}
            {!! Form::select('country_document',$countries, null, ['class' => 'form-control','autocomplete'=>'off']) !!}
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('phone_extension', 'Código de país:') !!}
            {!! Form::select('phone_extension', [
                51 => '+51 (Peru)',
                1 => '+1 (USA/Canada)',
                44 => '+44 (UK)',
                52 => '+52 (Mexico)',
                91 => '+91 (India)',
            ], null , ['class' => 'form-control']) !!} <!-- Default to '1' if not set -->
        </div>

        <div class="form-group col-sm-6" >
            {!! Form::label('phone', 'Número de celular:') !!}
            {!! Form::text('phone', null, ['class' => 'form-control', 'value'=>'-']) !!}
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

        <div class="form-group">
        <!-- City Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('country', 'País:') !!}
                {!! Form::select('country',$countries, null, ['class' => 'form-control client_country', 'style' => 'width: 180px; ','autocomplete'=>'off']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('city', 'Región:') !!}
                {!! Form::text('city', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('state', 'Ciudad:') !!}
                {!! Form::text('state', null, ['class' => 'form-control','maxlength' => '20']) !!}
            </div>
        </div>

        <div class="form-group col-sm-6">
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

        <div class="form-group col-sm-6" style="display: none;">
            {!! Form::label('photo', 'Foto de perfil:') !!}
            <p>{!! Form::file('photo', ['accept'=>'image/*']) !!}</p>
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('address_wallet', 'Dirección de tu Wallet:') !!}
            {!! Form::text('address_wallet', null, ['class' => 'form-control','maxlength' => '100']) !!}
        </div>

        <div class="form-group col-sm-6" style="display: none;">
            <label><input type="checkbox" value="1" name="check1" id="check1" class="checks"> Acepto declaración jurada</label>
        </div>
        <div class="form-group col-sm-6" style="display: none;">
            <label><input type="checkbox" value="1" name="check2" id="check2" class="checks"> Acepto contrato</label>
        </div>



        <div class="form-group col-sm-6" style="display: none;">
            {!! Form::label('job', 'Ocupación o profesión:') !!}
            {!! Form::text('job', null, ['class' => 'form-control', 'value'=>'-']) !!}
        </div>
        <input type="text" class="d-none" id="csrftoken" value="DRkTPyJFOmAKia3Eg7gtdunSJvGIaLPvu6bkcu2G">

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Enviar a revisión', ['class' => 'btn btn-primary save-client', 'id'=>'btn-send']) !!}
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

<script>
    $( document ).ready(function() {
        
        function copy(selector){
            var $temp = $("<div>");
            $("body").append($temp);
            $temp.attr("contenteditable", true)
                .html($(selector).html()).select()
                .on("focus", function() { document.execCommand('selectAll',false,null); })
                .focus();
            document.execCommand("copy");
            $temp.remove();
        }
        
    });

    var cancel_btn;
    var alert_wrapper;
    var show_progress_bar; 
    var input; 
    var file_input_label; 
    var list_alert_wrapper = [];
    var data = '{"alert_wrapper":[]}';
    var hide_file;
    var loading_btn;
    var can_upload_file = true;
    var load_percentage;
    $( document ).ready(function() {

        if ($("#hide_dni").length)
            $("#hide_dni").val($("#hide_dni").val().substring($("#hide_dni").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_dni_r").length)
            $("#hide_dni_r").val($("#hide_dni_r").val().substring($("#hide_dni_r").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_profile_picture").length)
            $("#hide_profile_picture").val($("#hide_profile_picture").val().substring($("#hide_profile_picture").val().lastIndexOf('/') + 1)) ;

        if ($("#hide_dni2").length)
            $("#hide_dni2").val($("#hide_dni2").val().substring($("#hide_dni2").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_dni2_r").length)
            $("#hide_dni2_r").val($("#hide_dni2_r").val().substring($("#hide_dni2_r").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_profile_picture2").length)
            $("#hide_profile_picture2").val($("#hide_profile_picture2").val().substring($("#hide_profile_picture2").val().lastIndexOf('/') + 1)) ;

        if ($("#hide_dni3").length)
            $("#hide_dni3").val($("#hide_dni3").val().substring($("#hide_dni3").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_dni3_r").length)
            $("#hide_dni3_r").val($("#hide_dni3_r").val().substring($("#hide_dni3_r").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_profile_picture3").length)
            $("#hide_profile_picture3").val($("#hide_profile_picture3").val().substring($("#hide_profile_picture3").val().lastIndexOf('/') + 1)) ;

        if ($("#hide_business_file").length)
            $("#hide_business_file").val($("#hide_business_file").val().substring($("#hide_business_file").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_power_file").length)
            $("#hide_power_file").val($("#hide_power_file").val().substring($("#hide_power_file").val().lastIndexOf('/') + 1)) ;
        if ($("#hide_taxes_file").length)
            $("#hide_taxes_file").val($("#hide_taxes_file").val().substring($("#hide_taxes_file").val().lastIndexOf('/') + 1)) ;

    });

    function check_progress_bar(e){

        input_w = document.getElementById(e.target.id);
        input_parentNode_w = document.getElementById(input_w.parentNode.id);
        input_grandpa_w = document.getElementById(input_parentNode_w.parentNode.id);
        var alert_wrapper_w = document.getElementById(input_grandpa_w.children[2].id);

        if(can_upload_file){
            //ok you can upload files
        }else{
            e.preventDefault();
            alert_wrapper_w.classList.remove("d-none");
            show_alert(`hay un archivo en cola`, "primary",alert_wrapper_w);
        }
        
    }
    function show_alert(message, alert,alert_wrapper) {

        alert_wrapper.innerHTML = `
        <div id="alert" class="alert-${alert} alert-dismissible fade show" >
        <div class="row">
                <div class="col-10 mt-2">
                    <span >${message}</span>
                </div>
                <div class="col-2">
                    <button  id =${alert_wrapper.id} type="button" class="close" data-dismiss="alert" aria-label="Close" code = ${alert_wrapper.id}>
                        <span aria-hidden="true">&times;</span>
                    </button>                
                </div>
        </div>
        </div>
        `
    }

    function show_image(message, alert,alert_wrapper) {

        alert_wrapper.innerHTML = `
            <div id="alert" class="alert-${alert} fade show" >
            <div class="row">
                    <div class="col-12 mt-2">
                        <img src="/storage/profile/${message}" style="max-width: 20vw; max-height: 10vh;"/>
                    </div>
            </div>
            </div>
            `
    }

    function upload(alert_wrapper,show_progress_bar) {

        var data = new FormData();
        var request = new XMLHttpRequest();
        request.responseType = "json";
        alert_wrapper.innerHTML = "";
        input.disabled = true;
        alert_wrapper.classList.remove("d-none");
        show_progress_bar.classList.remove("d-none");

        var file = input.files[0];
        var filename = file.name;
        var filesize = file.size;
        document.cookie = `filesize=${filesize}`;
        data.append(input.id, file);

        request.upload.addEventListener("progress", function (e) {
            var loaded = e.loaded;
            var total = e.total
            var percent_complete = (loaded / total) * 100;
            load_percentage.innerHTML = Math.floor(percent_complete) + "%";
        })

        request.addEventListener("load", function (e) {

            if (request.status == 200) {
                hide_file.value = request.response.file_name;
                show_image(`${request.response.file_name}`, "success",alert_wrapper);
            }
            else {
                show_alert(`Error al cargar el archivo`+request.status, "danger",alert_wrapper);
            }
                reset();
        });

        request.addEventListener("error", function (e) {
            reset();
            show_alert(`Error al cargar el archivo`, "warning",alert_wrapper);
        });

        request.addEventListener("abort", function (e) {
            reset();
            show_alert(`Carga cancelado`, "primary",alert_wrapper);
        });

    
        const XSRF_TOKEN = getCookie('XSRF-TOKEN');

        request.open('post', '{{ route('upload_file')}}');
        //request.open('post', window.location.origin+"/"+"upload-file");
        //request.setRequestHeader('x-csrf-token',$('#csrftoken').val());
        request.setRequestHeader('x-csrf-token','{{csrf_token() }}');
        request.send(data);

        cancel_btn.addEventListener("click", function () {
            request.abort();
            reset();
            show_alert(`Carga cancelado`, "primary",alert_wrapper);

        })

        function getCookie(name) {
            let cookieValue = null;
            if (document.cookie && document.cookie !== '') {
                const cookies = document.cookie.split(';');
                for (let i = 0; i < cookies.length; i++) {
                    const cookie = cookies[i].trim();
                    if (cookie.substring(0, name.length + 1) === (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }

        

    }

    function input_filename(e) {

        input = document.getElementById(e.target.id);
        input_parentNode = document.getElementById(input.parentNode.id);
        input_grandpa = document.getElementById(input_parentNode.parentNode.id);

        file_input_label_s = document.getElementById(input_grandpa.children[0].id);
        file_input_label = document.getElementById(file_input_label_s.children[0].id);
        file_input_label.innerText = input.files[0].name;

        hide_file = document.getElementById(file_input_label_s.children[2].id);


        show_progress_bar = document.getElementById(input_grandpa.children[1].id);
        loading_btn = document.getElementById(show_progress_bar.children[0].id);
        load_percentage = document.getElementById(loading_btn.children[1].id);

        alert_wrapper = document.getElementById(input_grandpa.children[2].id);

        console.log(input_grandpa.children[2]);
        cancel_btn = document.getElementById(show_progress_bar.children[1].id)

        can_upload_file = false; //a file begins to upload and with which no more processes will be allowed

        upload(alert_wrapper,show_progress_bar);
    }
 

    function reset() {
        input.value = null;
        input.disabled = false;
        show_progress_bar.classList.add("d-none");
        file_input_label.innerText = "Select file";
        can_upload_file = true;
    }

    $(".save-client").on('click',function(){

        var dni = document.getElementById("dni");
        var dni_r = document.getElementById("dni_r");
        var profile_picture = document.getElementById("profile_picture");

        dni.removeAttribute("required");
        dni_r.removeAttribute("required");
        profile_picture.removeAttribute("required");

        dni.setCustomValidity("");
        dni_r.setCustomValidity("");
        profile_picture.setCustomValidity("");
        
        dni.setAttribute(((document.getElementById("hide_dni").value == "") ? "required" : "tofill" ), "");
        dni_r.setAttribute(((document.getElementById("hide_dni_r").value == "") ? "required" : "tofill" ), "");
        profile_picture.setAttribute(((document.getElementById("hide_profile_picture").value == "") ? "required" : "tofill" ), "");

        if(!can_upload_file){
            input.disabled = false;
            input.setCustomValidity("este campo aún no ha sido completado");
        }
    }).on('mouseup',function(){
        input.disabled = true;
    });

    $("#save-socio-main").click(function() {

        var dni = document.getElementById("dni");
        var dni_r = document.getElementById("dni_r");
        var profile_picture = document.getElementById("profile_picture");

        dni.removeAttribute("required");
        dni_r.removeAttribute("required");
        profile_picture.removeAttribute("required");

        dni.setCustomValidity("");
        dni_r.setCustomValidity("");
        profile_picture.setCustomValidity("");

        dni.setAttribute(((document.getElementById("hide_dni").value == "") ? "required" : "tofill" ), "");
        dni_r.setAttribute(((document.getElementById("hide_dni_r").value == "") ? "required" : "tofill" ), "");
        profile_picture.setAttribute(((document.getElementById("hide_profile_picture").value == "") ? "required" : "tofill" ), "");

        if(!can_upload_file){
            input.disabled = false;
            input.setCustomValidity("este campo aún no ha sido completado");
        }

        var dni2 = document.getElementById("dni2");
        var dni2_r = document.getElementById("dni2_r");
        var profile_picture2 = document.getElementById("profile_picture2");

        var dni3 = document.getElementById("dni3");
        var dni3_r = document.getElementById("dni3_r");
        var profile_picture3 = document.getElementById("profile_picture3");

        dni2.setCustomValidity("");
        dni2_r.setCustomValidity("");
        profile_picture2.setCustomValidity("");

        dni3.setCustomValidity("");
        dni3_r.setCustomValidity("");
        profile_picture3.setCustomValidity("");

        dni2.removeAttribute("required");
        dni2_r.removeAttribute("required");
        profile_picture2.removeAttribute("required");

        dni3.removeAttribute("required");
        dni3_r.removeAttribute("required");
        profile_picture3.removeAttribute("required");
    });

    $("#save-socio-1").click(function() {

        var dni2 = document.getElementById("dni2");
        var dni2_r = document.getElementById("dni2_r");
        var profile_picture2 = document.getElementById("profile_picture2");

        dni2.removeAttribute("required");
        dni2_r.removeAttribute("required");
        profile_picture2.removeAttribute("required");

        dni2.setCustomValidity("");
        dni2_r.setCustomValidity("");
        profile_picture2.setCustomValidity("");

        dni2.setAttribute(((document.getElementById("hide_dni2").value == "") ? "required" : "tofill" ), "");
        dni2_r.setAttribute(((document.getElementById("hide_dni2_r").value == "") ? "required" : "tofill" ), "");
        profile_picture2.setAttribute(((document.getElementById("hide_profile_picture2").value == "") ? "required" : "tofill" ), "");

        if(!can_upload_file){
            input.disabled = false;
            input.setCustomValidity("este campo aún no ha sido completado");
        }

        var dni = document.getElementById("dni");
        var dni_r = document.getElementById("dni_r");
        var profile_picture = document.getElementById("profile_picture");

        var dni3 = document.getElementById("dni3");
        var dni3_r = document.getElementById("dni3_r");
        var profile_picture3 = document.getElementById("profile_picture3");

        dni.setCustomValidity("");
        dni_r.setCustomValidity("");
        profile_picture.setCustomValidity("");

        dni3.setCustomValidity("");
        dni3_r.setCustomValidity("");
        profile_picture3.setCustomValidity("");

        dni.removeAttribute("required");
        dni_r.removeAttribute("required");
        profile_picture.removeAttribute("required");

        dni3.removeAttribute("required");
        dni3_r.removeAttribute("required");
        profile_picture3.removeAttribute("required");
    });

    $("#save-socio-2").click(function() {

        var dni3 = document.getElementById("dni3");
        var dni3_r = document.getElementById("dni3_r");
        var profile_picture3 = document.getElementById("profile_picture3");

        dni3.removeAttribute("required");
        dni3_r.removeAttribute("required");
        profile_picture3.removeAttribute("required");

        dni3.setCustomValidity("");
        dni3_r.setCustomValidity("");
        profile_picture3.setCustomValidity("");

        dni3.setAttribute(((document.getElementById("hide_dni3").value == "") ? "required" : "tofill" ), "");
        dni3_r.setAttribute(((document.getElementById("hide_dni3_r").value == "") ? "required" : "tofill" ), "");
        profile_picture3.setAttribute(((document.getElementById("hide_profile_picture3").value == "") ? "required" : "tofill" ), "");

        if(!can_upload_file){
            input.disabled = false;
            input.setCustomValidity("este campo aún no ha sido completado");
        }
        

        var dni2 = document.getElementById("dni2");
        var dni2_r = document.getElementById("dni2_r");
        var profile_picture2 = document.getElementById("profile_picture2");

        var dni = document.getElementById("dni");
        var dni_r = document.getElementById("dni_r");
        var profile_picture = document.getElementById("profile_picture");

        dni.setCustomValidity("");
        dni_r.setCustomValidity("");
        profile_picture.setCustomValidity("");

        dni2.setCustomValidity("");
        dni2_r.setCustomValidity("");
        profile_picture2.setCustomValidity("");

        dni2.removeAttribute("required");
        dni2_r.removeAttribute("required");
        profile_picture2.removeAttribute("required");

        dni.removeAttribute("required");
        dni_r.removeAttribute("required");
        profile_picture.removeAttribute("required");
    });

    $(".save-business").click(function() {

        var dni = document.getElementById("dni");
        var dni_r = document.getElementById("dni_r");
        var business_file = document.getElementById("business_file");
        var power_file = document.getElementById("power_file");
        var taxes_file = document.getElementById("taxes_file");


        dni.removeAttribute("required");
        dni_r.removeAttribute("required");
        business_file.removeAttribute("required");
        power_file.removeAttribute("required");
        taxes_file.removeAttribute("required");

        dni.setCustomValidity("");
        dni_r.setCustomValidity("");
        business_file.setCustomValidity("");
        power_file.setCustomValidity("");
        taxes_file.setCustomValidity("");

        dni.setAttribute(((document.getElementById("hide_dni").value == "") ? "required" : "tofill" ), "");
        dni_r.setAttribute(((document.getElementById("hide_dni_r").value == "") ? "required" : "tofill" ), "");
        business_file.setAttribute(((document.getElementById("hide_business_file").value == "") ? "required" : "tofill" ), "");
        power_file.setAttribute(((document.getElementById("hide_power_file").value == "") ? "required" : "tofill" ), "");
        taxes_file.setAttribute(((document.getElementById("hide_taxes_file").value == "") ? "required" : "tofill" ), "");

        if(!can_upload_file){
            input.disabled = false;
            input.setCustomValidity("este campo aún no ha sido completado");

        }
    });

    $(document).ready(function (){
        $bells_menu = ["notification"];
        console.log("BELLS");
        console.log("{{ route('bells.bells') }}");
        $.ajax({                                      
            url: "{{ route('bells.bells') }}",
            type: "get",
            dataType: 'json',                
            beforeSend: function() {
                //$('#current_page').append("loading..");
            },
            success: function(data) {
                console.log(data);
                if(data.notification){
                    $.each( $bells_menu, function( key, value ) {
                        if(data.notification[value] == true){
                            $element = "."+value;
                            $( $element ).show();
                        }
                    });
                }
            },
        });
    });

</script>

{!! Form::close() !!}