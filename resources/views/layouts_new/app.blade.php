@php
    $user = Auth::user();
    $profile = Auth::user()->with('profile')->first(); 

    $profile = $profile->profile->where('user_id', $user->id)->first();

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
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.6.96/css/materialdesignicons.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css"> --}}
    <link rel="stylesheet" href="{{ url('welcome_new/events.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{URL::asset('/newDashboard/app.css')}}"/>
</head>
<body>
    <style>
        .note_list li { display: none; }
        .note_list li.active { display: block; }
    </style>
    <div id="particles-js"></div>
    <div class="container-fluid">
        <div class="row h-100">
            <div class="side-bar col-auto me-auto overflow-scroll" id="sidebar-col">
                @include('layouts_new.sidebar_new')
            </div>
            <div class="col overflow-scroll h-100 p-0 w-100 content-wrapper">
                <div class="nbar w-100 d-flex justify-content-end ">
                    <div class="nbar-r h-75 w-25 d-flex align-items-center text-align-center justify-content-end bg-2">
                        <div class="container">
                            <ul class="note_list">
                            </ul>
                        </div>
                        <a href="#" class="text-align-center align-items-center p-3" id="theme-toggle">
                            <i class="fa fa-solid fa-sun d-flex text-align-center align-items-center justify-content-center" style="font-size: 20px; color: white;"></i>
                        </a>
                        <div class="dropdown align-items-center text-align-center p-3">
                            <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="text-align-center align-items-center">
                                <i class="fa fa-solid fa-bell d-flex text-align-center align-items-center justify-content-center" style="font-size: 20px; color: white;" ></i>
                            </a>
                            <span class="badge badge-danger">{{ $notificaciones->count() }}</span>
                            <div class="dropdown-menu dropdown-menu-left bg-1" aria-labelledby="dropdownMenuButton" id="content-alert">
                                <ul class="timeline timeline-icons timeline-sm" style="margin:10px;width:210px;">
                                    @foreach($notificaciones as $notificacion)
                                        <li>
                                            <p>{{ $notificacion->title }}: {{ $notificacion->body }}</p>
                                            <span class="timeline-icon"><i class="fa fa-bell d-flex text-align-center align-items-center justify-content-center" style="color:white"></i></span>
                                            <span class="timeline-date">{{ $notificacion->created_at->format('M d, H:i') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown-list toggle">
                            <input id="t1" type="checkbox">
                            <label for="t1">
                                @if ($profile && $profile->profile_picture)
                                    <img src="/storage/{{$profile->profile_picture}}" class="img-fluid profile-picture" />
                                @else 
                                    <img src="/images/user-icon.png" class="img-fluid profile-picture" style="width: 32%;"/>
                                @endif
                            </label>

                            <ul>
                                <li>
                                    <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Log-Out
                                    </button>
                                </li>
                            </ul>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                   </div>
                </div>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

{{-- <link rel="stylesheet" href="https://unpkg.com/jolty-ui/dist/jolty-ui.min.css"> --}}

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
        $.ajax({
            url: '/api/data',
            method: 'GET',
            success: function(data) {
                console.log(data); // Agrega esta línea para ver los datos completos
                let content = '';
                data.forEach((item, index) => {
                    const exchangeRate = item['Realtime Currency Exchange Rate']['5. Exchange Rate'];
                    const fromCurrency = item['Realtime Currency Exchange Rate']['1. From_Currency Code'];
                    const toCurrency = item['Realtime Currency Exchange Rate']['3. To_Currency Code'];
                    const activeClass = index === 0 ? 'active' : '';
                    content += `<li class="${activeClass}">${fromCurrency} to ${toCurrency}: ${exchangeRate}</li>`;
                });
                $('.note_list').html(content);
                autoChange();
            },
            error: function(error) {
                console.error('Error fetching data:', error);
                $('.note_list').html('<li class="active">Error fetching data</li>');
            }
        });
    });

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
</script>

<script>
    $(document).click(function(event) {
        if(
            $('.toggle > input').is(':checked') &&
            !$(event.target).parents('.toggle').is('.toggle')
        ) {
            $('.toggle > input').prop('checked', false);
        }
    });
    
</script>
<script src="{{ mix('js/charts.js') }}"></script>    
</body>
</html>
