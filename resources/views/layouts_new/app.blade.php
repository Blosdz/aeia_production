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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-qK0oI0kfdPAe+Tx9B5JcO1OTk5ci62A4XJymNeCEc5d/3UybA6WfrM8eIhvXXF5g" crossorigin="anonymous"></script> --}}

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

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src ={{URL::asset('/newDashboard/js/app_new.js')}}></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<script src={{asset('dashboard/js/sb-admin-2.js')}}></script>
{{-- bundle js bootstrap --}}

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


