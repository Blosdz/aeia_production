<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <link rel="stylesheet" href="{{URL::asset('/newDashboard/landing_page.css')}}">
    <title>AEIA Investment</title>
</head>
<body>
<nav class="navbar navbar-expand-lg  sticky-top">
      <div class="container-fluid">

        <a href="index.html" style="text-decoration:none!important; color:white!important;" ><img src="{{URL::asset('/newDashboard/images/logovdf.png')}}" alt="logo" style="width:4vw !important;"/>AEIA INVESTMENTS <br></a>
        
        <!-- Botón toggler, visible en pantallas medianas y pequeñas -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Offcanvas para pantallas pequeñas y medianas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: #0e359ef6;  ">
            
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#inicio">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sobre-nosotros">Sobre Nosotros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#beneficios">Beneficios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#suscriptores">Suscriptores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#indicaciones">Indicaciones</a>
              </li>
            </ul>

            <div class="form-check form-switch my-2 mx-3">

                <input type="checkbox" name="switch" id="theme" class="form-check-input" role="switch">
                <label for="theme"></label>
                
            </div>
 
            <form class="d-flex mt-3" role="search">
                <button type="button" onclick="window.location.href='{{ url('/login') }}'" class="btn btn-outline-success me-2">Login</button>
                <button type="button" onclick="window.location.href='{{ url('/register') }}'" class="btn btn-outline-primary">Crear Cuenta</button>
            </form>
          </div>
        </div>

      </div>
    </nav>
    <div id="particles-js"></div>

    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <!-- Mashead text and app badges-->
                    <div class="mb-5 mb-lg-0 text-center text-lg-start">
                        <h1 class="display-1 lh-1 mb-3">Inversión Inteligente con AEIA.</h1>
                        <p class="lead fw-normal text-muted mb-5">Transparencia, Rentabilidad,Seguridad</p>
                    </div>
                </div>
                <div class="col-lg-6">
                  
                </div>
            </div>
        </div>
    </header>

    <aside class="text-center">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center" id="">
                <div class="col-xl-8 bg-box-aeia position-relative" > 
                    <div class="h4 fs-1 text-white mt-4 mb-4 text-lg-start">Fondo de Noviembre</div>
                    
                        <p class=" text-lg-start" style="color:white; font-weight:bolder;">
                            Recaudado: <span class="transparency-value"></span>                       
                        </p>

                        <p class=" text-lg-start" style="color:white; font-weight:bolder;">
                            Rentabilidad: <span class="rentability-value" style="color:#57b957;"></span> 
                            <i class="bi bi-graph-up-arrow mx-3" style="background-color:green !important; padding:0.5vw; border-radius:50px; color:white;" ></i> </a>
                        </p>
                    <div class="card mt-4 p-4 custom-shadow"> <!-- Añadido custom-shadow para la sombra -->
                        <div class="chart-area">
                            <div class="grid"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <section class="bg-light" id="sobre-nosotros">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12 col-lg-5">
                    <h2 class="display-4 lh-1 mb-4">Acerca de AEIA</h2>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-0">
                    Somos una empresa dedicada a ofrecer un entorno de servicios financieros electrónicos, con el objetivo de generar múltiples fondos de inversión colectiva para el trading automatizado de criptomonedas, respaldado por algoritmos avanzados en inteligencia artificial. Simplificando el proceso de inversión para proteger tu capital y maximizar tus ganancias, brindándote acceso a oportunidades de crecimiento en el mercado de manera segura y eficiente.
                    </p>
                </div>
                <div class="col-sm-8 col-md-6">
                    <div class="px-5 px-sm-0">
                        <img class="circle-behind img-fluid" src="{{URL::asset('/newDashboard/images/5006144.png')}}" alt="">
                        <!-- <img class="img-fluid rounded-circle" src="https://source.unsplash.com/u8Jn2rzYIps/900x900" alt="..." /> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="beneficios">
            <div class="container px-5 mt-5 text-center">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xl-8">
                        <h1>Beneficios de AEIA</h1>
                    </div>
                </div>
                <div class="row gx-5 align-items-center">
                    <div class="col order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid">
                            <div class="row gx-5 mt-5">
                                <div class=" col col-md-6 mb-5">
                                    <div class="feature-container position-relative">
                                        <div class="circle-effect"></div>
                                        <!-- Feature item-->
                                        <div class="text-center bg-benefits p-5">
                                            <i class="bi bi-key-fill"></i>
                                            <br>
                                            <h3 class="font-alt">Seguridad y Protección</h3>
                                            <p class="mb-0">Tus datos personales no son revelados a terceros</p>

                                        </div>
                                    </div>
                                </div>

                                <div class=" col col-md-6 mb-5">
                                    <div class="feature-container position-relative">
                                    <div class="circle-effect"></div>
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi bi-file-earmark-bar-graph"></i>

                                        <br>
                                        <h3 class="font-alt">Política de Transparencia</h3>
                                        <p class="mb-0">Puedes ver en tiempo real toda la información de tus inversiones.</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5 mt-5">

                                <div class="col col-md-6 mb-5 mb-md-0">

                                    <div class="feature-container position-relative">

                                    <div class="circle-effect"></div>
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi bi-graph-up-arrow"></i>

                                        <br>
                                        <h3 class="font-alt">Gestión de riesgo</h3>
                                        <p class="mb-0"> Gestionamos un portafolio de  inversión para diversificar el riesgo y asumimos estrategias de  rebalanceo de operaciones y activos</p>
                                    </div>
                                    </div>
                                </div>
                                <div class="col col-md-6 mb-5 mb-md-0">
                                    <div class="feature-container position-relative">
                                    <div class="circle-effect"></div>
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi bi-currency-dollar"></i>

                                        <br>
                                        <h3 class="font-alt">Depósitos en Dólares</h3>
                                        <p class="mb-0">Los depósitos se realizarán a través de la cuenta corriente de nuestra empresa.</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5 align-items-center justify-content-center mt-5">
                                <div class=" col col-md-6 mb-5 mb-md-0">

                                    <div class="feature-container position-relative">
                                    <div class="circle-effect"></div>
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi bi-cash-coin"></i>

                                        <br>
                                        <h3 class="font-alt"> Disponibilidad del efectivo</h3>
                                        <p class="mb-0"> Todos los planes de inversión duran 1 año como minimo luego de ello se puede solicitar el retiro del capital y las ganancias a la cuenta bancaria o el wallet del titular.</p>
                                    </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="bg-light mb-5 mt-5" id="suscriptores">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12 col-lg-5 ">
                    <h2 class="display-4 lh-1 mb-4 mb-4">Forma parte del equipo de AEIA</h2>
                    <p class="lead fw-normal text-muted mb-5">Genera capital vendiendo suscripciones</p>
                    
                    <h3 class="font-alt mb-4">¿Quién es un suscriptor?</h3>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-5">
                        Es aquella persona que gestiona la venta y distribución de fondos de inversión para personas naturales y empresas.
                    </p>
                    <h3 class="font-alt mb-4"> ¿Cómo puedo ser un suscriptor?</h3>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-5">
                        Debes crear una cuenta como suscriptor y  realizar la verificacón de tus datos, posteriormente deberás hacer el  pago de la licencia de suscripción para ser nuestro socio comercial.
                    </p>
                </div>
                <div class="col-10 col-lg-5 px-sm-2 " style="border: 1px #b7b7b7 solid;border-radius: 25px;background: #0c58ce;box-shadow: -8px 9px 4px rgba(6, 6, 11, 0.65);color: white;">

                    <div class="row justify-content-center text-center mt-5 text-lg-start">
                        <div class="col-md-4 mb-2 col-6  mb-md-0">
                            <p>Plan</p> 
                        </div>
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>Comisión</p>
                        </div>
                    </div>

                    <div class="row gx-5 align-items-center justify-content-center text-align-center mt-5">
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>Bronce</p>
                        </div>
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>$14</p>
                        </div>
                    </div>
                    <div class="row gx-5 align-items-center justify-content-center mt-5">
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>Plata</p>
                        </div>
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>$35</p>
                        </div>
                    </div>
                    <div class="row gx-5 align-items-center justify-content-center mt-5">
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>Oro</p>
                        </div>

                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>$ 70</p>
                        </div>
                    </div>
                    <div class="row gx-5 align-items-center justify-content-center mt-5">
                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>Platino</p>
                        </div>

                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>$ 84</p>
                        </div>
                    </div>
                    <div class="row gx-5 align-items-center justify-content-center mt-5 mb-5">

                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>Diamante</p>
                        </div>

                        <div class="col-md-4 mb-2 col-6 mb-md-0">
                            <p>$ 140</p>
                        </div>
                    </div>


                    <!-- <div class="px-5 px-sm-0"> -->

                        <!-- <img class="circle-behind img-fluid" src="{{URL::asset('/newDashboard/images/5006144.png')}}" alt=""> -->
                        <!-- <img class="img-fluid rounded-circle" src="https://source.unsplash.com/u8Jn2rzYIps/900x900" alt="..." /> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
    <section id="indicaciones">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col xl-8 text-center">
                    <h1>Pocos pasos para Iniciar</h1>
                </div>

            </div>
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between mb-5 mb-lg-5 bg-blue-steps p-5 mt-5">
                {{-- <div class="mb-5 mb-lg-6 bg-blue-steps p-5  align-items-center justify-content-center "> --}}
                        <div class="row gx-5">
                            <div class="col-md-4 mb-3">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi bi-1-circle-fill" id="icon_number"></i>
                                    <p class="mb-0"> Registrarse en la Plataforma Crea tu cuenta de acuerdo al perfil que mas te convenga. </p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="bi bi-2-circle-fill" id="icon_number"></i>
                                    <p class="mb-0"> Verificar sus datos Verifica tus datos y llena los formularios de la plataforma </p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <!-- Feature item-->
                                <div class="text-center">
                                
                                    <i class="bi bi-3-circle-fill" id="icon_number"></i>
                                    <p class=" mb-0"> Escoger el Plan de Inversión Decide cuanto dinero puedes invertir, no arriesgues más de lo que debes. </p>
                                </div>
                            </div>
                        </div>
                        <div class="row gx-5 mt-5">
                        
                            <div class="col-md-4 mb-3">
                                <!-- Feature item-->
                                <div class="text-center">
                                
                                    <i class="bi bi-4-circle-fill" id="icon_number"></i>
                                    <p class="mb-0">
                                         Depositar Puedes realizar el pago con tu tarjeta de debito/credito o transferencia al wallet. Escoge el método de pago que mas te conviene 
                                    </p>
                                </div>
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <!-- Feature item-->
                                <div class="text-center">
                                
                                    <i class="bi bi-5-circle-fill" id="icon_number"></i>
                                    <p class="mb-0">
                                         Esperar Proceso Trading de 1 año Mientras el proceso de inversión ocurre por periodo de un año, puedes verificar tus inversiones, solicitar reportes, inscribirte a nuestros eventos y aprender a hacer trading. 
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <!-- Feature item-->
                                <div class="text-center">
                                
                                    <i class="bi bi-6-circle-fill" id="icon_number"></i>
                                    <p class="mb-0">
                                         Retirar sus Ganancias o Incluir Nuevo Plan Despues del año de contrato puedes solicitar el retiro de tus fondos a la cuenta bancaria del titular o puedes reinvertir tu capital y ganancias. 
                                    </p>
                                </div>
                            </div>
                        </div>
                    
                {{-- </div> --}}
            </div>



        </div>


    </section>



        <!-- Footer-->
        <footer class="bg-black text-center py-5">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; AEIA INVESTMENTS 2024. All Rights Reserved.</div>
                    <a href="#!">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">FAQ</a>
                </div>
            </div>
        </footer>
        <!-- Feedback Modal-->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary-to-secondary p-4">
                        <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Send feedback</h5>
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0 p-4">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{URL::asset('/js/landing.js')}}"></script>
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 30,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#00265e"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
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
                    "value": 5,
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
                    "color": "#00265e",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
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
                        "enable": true,
                        "mode": "push"
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
                        "distance": 200,
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
    </script>

    <script>
        const startDate = new Date('2021-02-28'); // Ejemplo: 1 de enero de 2021

        function updateDaysFunctioning() {
            const currentDate = new Date();
            const timeDifference = currentDate - startDate;
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24)); // Conversión a días
            document.getElementById('days-functioning').textContent = days.toLocaleString(); // Actualiza el DOM
        }

        // Actualizar al cargar la página
        updateDaysFunctioning();
    </script>
    <script>
        document.querySelectorAll('.feature-container').forEach((container) => {
            const circle = container.querySelector('.circle-effect');

            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                const x = e.clientX - rect.left; // Coordenada relativa al contenedor
                const y = e.clientY - rect.top;
            
                circle.style.left = `${x}px`;
                circle.style.top = `${y}px`;
            });
        
            container.addEventListener('mouseleave', () => {
                circle.style.opacity = '0'; // Oculta el círculo al salir
            });
        
            container.addEventListener('mouseenter', () => {
                circle.style.opacity = '1'; // Muestra el círculo al entrar
            });
        });


    </script>
</body>
</html>

