@php
    $user = Auth::user();
    $profile = Auth::user()->with('profile')->first(); 

    $profile = $profile->profile->where('user_id', $user->id)->first();

    //dd($user, $profile);
    //dd($user->rol);

    $badge = '<span class="badge badge-success w-100" style="">Validado</span>';
    
    $session_validate = 5;
    if( $user->rol == 2 or $user->rol == 3 or $user->rol == 4 ) {
        if($user->validated == 0) {
            $badge = '<span class="badge badge-warning w-100" style="">En Validacion</span>';
        }
        $session_validate = $profile->verified;
    }
    switch ($session_validate) {
        case 0:
            $badge = '<span class="badge badge-info w-100" style="">No validado</span>';
            break;
        case 1:
            $badge = '<span class="badge badge-warning w-100" style="">En Validacion</span>';
            break;
        case 2:
            $badge = '<span class="badge badge-success w-100" style="">Validado</span>';
            break;
        case 3:
            $badge = '<span class="badge badge-danger w-100" style="">Rechazado</span>';
            break;
        default:
            # code...
            break;
    }
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.6.96/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <script src="{{ url('/countries.js') }}"></script>
    <link rel="stylesheet" href="{{ url('welcome_new/events.css') }}">

    <!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>

@stack('scripts')

<style>
    .class-test{
        background-color: black;
    }
    .sidebar{
        background: #09114A !important;
    }
    .sidebar .nav-link.active {
        background: #0079BE;
    }
    .sidebar-minimized .sidebar .sidebar-minimizer {
        background-color: #09114A;
    }
    .main{
        background: #F4F6F9;
    }
    .app-header{
	background-color:#09114A !important;
     }
    .sidebar-minimized .sidebar .sidebar-nav{
        width:28px !important;
        overflow:hidden !important;
        margin-left:10px;
    }
</style>

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="{{ asset('welcome/images/logo.png') }}" width="80" height="80"
             alt="InfyOm Logo">
        <img class="navbar-brand-minimized" src="{{ asset('welcome/images/logo.png') }}" width="30"
             height="30" alt="InfyOm Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Cuenta</strong>
                </div>
                <a class="dropdown-item" href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-lock"></i>Cerrar Session
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>

<div class="app-body">
    @include('layouts.sidebar')
    <main class="main">
    @php
        if( !$user->email_verified_at) {
    @endphp
        <div class="alert alert-info" role="alert">
            Confirme su correo electronico en el correo de registro enviado
        </div>
    @php
        }
    @endphp

    @php
        if( $session_validate == 0) {
    @endphp
        <div class="alert alert-danger" role="alert">
            Complete su informacion de perfil para continuar operando! &nbsp;
            <a class="btn btn-danger" href="{{ route('profiles.user') }}">
                <span>Verificacion</span>
            </a>
        </div>
    @php
        } elseif( $session_validate == 1) {
    @endphp
        <div class="alert alert-warning" role="alert">
            Su informacion ha sido recibida y esta siendo validada.
        </div>
    @php
        } elseif( $session_validate == 3) {
    @endphp
        <div class="alert alert-danger" role="alert">
            Su informacion ha sido rechazada, actualizar su perfil.
            <a class="btn btn-danger" href="{{ route('profiles.user') }}">
                <span>Verificacion</span>
            </a>
        </div>
    @php
        }
    @endphp
        @yield('content')
    </main>
</div>
<footer class="app-footer">
    <div>
        <a href="https://infyom.com">InfyOm </a>
        <span>&copy; 2019 InfyOmLabs.</span>
    </div>
    <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
    </div>
</footer>
</body>


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

    // principal 
    /*$(document).on("click", "#alert_wrapper_dni", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_dni");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_dni_r", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_dni_r");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_profile_picture", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_profile_picture");
        alert_wrapper.innerHTML = ``;
    });

    // socio 1
    $(document).on("click", "#alert_wrapper_dni2", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_dni2");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_dni2_r", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_dni2_r");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_profile_picture2", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_profile_picture2");
        alert_wrapper.innerHTML = ``;
    });

    // socio 2
    $(document).on("click", "#alert_wrapper_dni3", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_dni3");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_dni3_r", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_dni3_r");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_profile_picture3", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_profile_picture3");
        alert_wrapper.innerHTML = ``;
    });

    //user bi
    $(document).on("click", "#alert_wrapper_business_file", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_business_file");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_power_file", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_power_file");
        alert_wrapper.innerHTML = ``;
    });
    $(document).on("click", "#alert_wrapper_taxes_file", function(event){

        var alert_wrapper = document.getElementById("alert_wrapper_taxes_file");
        alert_wrapper.innerHTML = ``;
    });

    */


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
</html>
