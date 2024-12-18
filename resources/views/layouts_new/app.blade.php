@php
    $user = Auth::user();

    $profile = Auth::user()->with('profile')->first(); 

    use App\Models\Notification;

    $notificaciones = Notification::where('user_id', $user->id)->get();
    
    $badge = '<span class="badge badge-success w-100">Validado</span>';

    $session_validate = 5;
    if ($user->rol == 2 || $user->rol == 3 || $user->rol == 4) {
        if ($user->validated == 0) {
            $badge = '<span class="badge badge-warning w-100">En Validacion</span>';
        }
        $session_validate = $profile->verified;
    }

    switch ($session_validate) {
        case 0:
            $badge = '<span class="badge badge-info w-100">No validado</span>';
            break;
        case 1:
            $badge = '<span class="badge badge-warning w-100">En Validacion</span>';
            break;
        case 2:
            $badge = '<span class="badge badge-success w-100">Validado</span>';
            break;
        case 3:
            $badge = '<span class="badge badge-danger w-100">Rechazado</span>';
            break;
        default:
            break;
    }
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('welcome_new/events.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{URL::asset('/newDashboard/app.css')}}"/>
    {{--<link rel="stylesheet" href="{{URL::asset('/css/table.css')}}"/>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-qK0oI0kfdPAe+Tx9B5JcO1OTk5ci62A4XJymNeCEc5d/3UybA6WfrM8eIhvXXF5g" crossorigin="anonymous"></script>

    {{--<link rel="stylesheet" href="{{URL::asset('/newDashboard/app_mobile.css')}}"/>--}}
</head>
<body id="page-top">
    <div id="particles-js" style="position: absolute; width: 100%; height: 100%; z-index: -1;"></div>

        {{-- website view --}}
        <div class="" id="wrapper">
                {{--sidebrand--}}
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon"> 
                            <img src="{{URL::asset('/images/dashboard/Logo.png')}}" alt="" class="menu_hidden" style="width:1.5vw;!important">
                        </div>
                    </a>
                    {{-- divider --}}
                    <hr class="sidebar-divider my-0">
                    {{-- image client --}}


                    <div class="text-center d-none d-md-block">

                        @if ($profile && $profile->profile_picture)
                            <img src="/storage/{{$profile->profile_picture}}" class="img-fluid profile-picture" />
                        @else 
                            <img src="/images/user-icon.png" class="img-fluid profile-picture" style="width: 45px; border-radius:100%;" />
                        @endif
                        <p class="ms-3 text-white font-weight-bold" style="font-weight:bolder;">
                             {{ $userProfile->first_name ?? 'User' }}
                        </p>

                    </div>

                    <hr class="sidebar-divider my-0">

                    @include('layouts_new.menu')

                    <li class="nav-item">
                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                            <span>
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>Log-Out

                            </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>  
                    </li>

                </ul>

            <div class="d-flex flex-column" id="content-wrapper">

                <div id="content">
                    {{-- top-bar --}}

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand  topbar mb-4 static-top ">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" >
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle has-notify p-4" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: #0e359ef6; border-radius: 40px;">
                                    <i class="fa fa-bell fa-fw" style="color: white;"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">{{ $notificaciones->count() }}</span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="max-height: 30vh; overflow: auto;">
                                    <h6 class="dropdown-header">
                                        Centro de Alertas
                                    </h6>
                                    @if($notificaciones->isNotEmpty())
                                        @foreach($notificaciones as $notificacion)
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;">
                                                <div class="mr-3">
                                                    <div class="icon-circle bg-warning">
                                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="small text-gray-500">{{ $notificacion->created_at->format('d M, Y') }}</div>
                                                    <span class="font-weight-bold">{{ $notificacion->title }}</span>
                                                    <div>{{ $notificacion->body }}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="dropdown-item text-center text-gray-500">No tienes notificaciones.</p>
                                    @endif
                                    {{-- <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas las alertas</a> --}}
                                </div>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>

                        </ul>

                    </nav>
                    {{--  End of Topbar  --}}

                    <div class="container-fluid">
                        @if($user->validated==0)
                        <div class="alert alert-info" role="alert">
                                Tu perfil no está verificado. Ingresa a la opción Verificación del menú lateral y completa la información requerida.
                        </div>
                        @endif
                        @yield('content')
                    </div>

                </div>
            </div>

        </div>

</body>
<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
    }
</script>
    
<script src ={{URL::asset('/newDashboard/js/app_new.js')}}></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<script src={{asset('dashboard/js/sb-admin-2.js')}}></script>
{{-- bundle js bootstrap --}}

<script src="{{ asset('vendor/bootstrap/bootstrap/js/bootstrap.bundle.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    {{-- quedooo  --}}
<script>
    function hexToRgb(hex) {
        let bigint = parseInt(hex.substring(1), 16);
        let r = (bigint >> 16) & 255;
        let g = (bigint >> 8) & 255;
        let b = bigint & 255;
        return { r: r, g: g, b: b };
    }
    let darkModeColor = '#ff7518';
    let lightModeColor = '#1C305C';
    let currentColor = localStorage.getItem('particleColor') || lightModeColor;
    function toggleParticleColor() {
        $('#particles-js').addClass('toggle-color');
        currentColor = (currentColor === lightModeColor) ? darkModeColor : lightModeColor;
        localStorage.setItem('particleColor', currentColor); 
        $.each(pJSDom[0].pJS.particles.array, function (i, p) {
            pJSDom[0].pJS.particles.array[i].color.value = currentColor;
            pJSDom[0].pJS.particles.array[i].color.rgb = hexToRgb(currentColor);
            pJSDom[0].pJS.particles.line_linked.color_rgb_line = hexToRgb(currentColor);
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": currentColor
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": currentColor,
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": false,
                        "mode": "repulse"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 80,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });

        $('#theme-toggle').on('click', toggleParticleColor);

        var toggleLink = document.getElementById("theme-toggle");
        var icon = toggleLink.querySelector("i");

        if (localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark-theme");
            icon.className = "fa fa-solid fa-sun d-flex text-align-center align-items-center justify-content-center";
            // window.updateChartTheme('dark');
        } else {
            icon.className = "fa fa-solid fa-moon d-flex text-align-center align-items-center justify-content-center";
            // window.updateChartTheme('light');
        }

        toggleLink.onclick = function () {
            document.body.classList.toggle("dark-theme");
            if (document.body.classList.contains("dark-theme")) {
                icon.className = "fa fa-solid fa-sun d-flex text-align-center align-items-center justify-content-center";
                localStorage.setItem("theme", "dark");
                window.dispatchEvent(new Event('themeChanged'));
            } else {
                icon.className = "fa fa-solid fa-moon d-flex text-align-center align-items-center justify-content-center";
                localStorage.setItem("theme", "light");
                window.dispatchEvent(new Event('themeChanged'));
            }
        }

    });
</script> 

<script>
    $(document).ready(function() {
        const currencies = @json($currencies); // Convierte la variable de PHP a un objeto JavaScript

        // Ahora puedes usar "currencies" en tu lógica AJAX
        let content = '';

        currencies.forEach((currency) => {
            const rates = currency.rates; // Asegúrate de que rates sea un string JSON
            const usdRate = rates.USD;
            const eurRate = rates.EUR;

            // Verificamos que usdRate y eurRate estén definidos y no sean undefined
            if (usdRate !== undefined && eurRate !== undefined) {
                content += `<li>${currency.base}: USD ${usdRate}, EUR ${eurRate}</li>`;
            }
        });

        $('.note_list').html(content); // Muestra el contenido en el HTML
        console.log(content); // Para verificar el contenido final
        $('.note_list li').first().addClass('active').show(); // Muestra el primer elemento y agrega la clase active
        autoChange(); // Llama a tu función de auto cambio

        function autoChange() {
            $('.note_list li.active').each(function () {
                if (!$(this).is(':last-of-type')) {
                    $(this).delay(5000).fadeOut(1000, function () {
                        $(this).removeClass('active').next().addClass('active').fadeIn(1000);
                        autoChange();
                    });
                } else {
                    $(this).delay(6000).fadeOut(1000, function () {
                        $(this).removeClass('active').parent().find('li:eq(0)').addClass('active').fadeIn(1000);
                        autoChange();
                    });
                }
            });
        }
    });
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

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script>
$('#dataTable').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-MX.json" // Cambia "es-MX" al idioma deseado
    }
});
</script>


<script src="{{ asset('js/particles.js') }}"></script>
<script src="{{ asset('js/particles-aeia.js') }}"></script>


</html>


