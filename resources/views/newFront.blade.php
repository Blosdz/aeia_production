<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{URL::asset('/newDashboard/landing_page.css')}}">
    <title>AEIA Investment</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container-fluid">

        <a href="index.html" style="text-decoration:none !important; color:black !important;" ><img src="{{URL::asset('/newDashboard/images/logovdf.png')}}" alt="logo" style="width:4vw !important;"/>AEIA INVESTMENTS <br></a>
        
        <!-- Botón toggler, visible en pantallas medianas y pequeñas -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Offcanvas para pantallas pequeñas y medianas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
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

            <form class="d-flex mt-3" role="search">
                <button type="button" onclick="window.location.href='{{ url('/login') }}'" class="btn btn-outline-success me-2">Login</button>
                <button type="button" onclick="window.location.href='{{ url('/register') }}'" class="btn btn-outline-primary">Crear Cuenta</button>
            </form>
          </div>
        </div>

      </div>
    </nav>
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
                    <!-- Masthead device mockup feature-->
                    <div class="masthead-device-mockup text-center">
                        <h3 class="display-6 lh-3 mb-3">Días Operando</h3>
                        <p class="lead fw-normal text-muted mb-5">{{$daysFunctioning ?? '1,355'}}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <aside class="text-center">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center" id="">
                <div class="col-xl-8 bg-box-aeia position-relative" style="height:62vh;!important"> 
                    <div class="h4 fs-1 text-white mt-4 mb-4 text-lg-start">Fondo de Noviembre</div>
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
                        <div class="container-fluid px-5">
                            <div class="row gx-5 mt-5">
                                <div class="col-md-6 mb-5 ">
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Seguridad y Protección</h3>
                                        <p class="mb-0">Tus datos personales no son revelados a terceros</p>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Política de Transparencia</h3>
                                        <p class="mb-0">Puedes ver en tiempo real toda la información de tus inversiones.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5 mt-5">

                                <div class="col-md-6 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Gestión de riesgo</h3>
                                        <p class="mb-0"> Gestionamos un portafolio de  inversión para diversificar el riesgo y asumimos estrategias de  rebalanceo de operaciones y activos</p>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Depósitos en Dólares</h3>
                                        <p class="mb-0">Los depósitos se realizarán a través de la cuenta corriente de nuestra empresa.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5 align-items-center justify-content-center mt-5">
                                <div class="col-md-6 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center bg-benefits p-5">
                                        <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt"> Disponibilidad del efectivo</h3>
                                        <p class="mb-0"> Todos los planes de inversión duran 1 año como minimo luego de ello se puede solicitar el retiro del capital y las ganancias a la cuenta bancaria o el wallet del titular.</p>
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
                <div class="col-12 col-lg-5">
                    <h2 class="display-4 lh-1 mb-4 mb-4">Forma parte del equipo de AEIA</h2>
                    <p class="lead fw-normal text-muted mb-5">Genera capital vendiendo suscripciones</p>
                    
                    <h3 class="text-center font-alt mb-4">¿Quién es un suscriptor?</h3>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-5">
                        Es aquella persona que gestiona la venta y distribución de fondos de inversión para personas naturales y empresas.
                    </p>
                    <h3 class="text-center font-alt mb-4"> ¿Cómo puedo ser un suscriptor?</h3>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-5">
                        Debes crear una cuenta como suscriptor y  realizar la verificacón de tus datos, posteriormente deberás hacer el  pago de la licencia de suscripción para ser nuestro socio comercial.
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
    <section id="indicaciones">
            <div class="container px-5 mt-5 text-center">
                <div class="row gx-5 justify-content-center">
                    <div class="col xl-8">
                        <h1>Pocos pasos para Iniciar</h1>

                    </div>
                </div>
                <div class="row gx-5 align-items-center">
                    <div class="col order-lg-1 mb-5 mb-lg-0 bg-blue-steps">
                        <div class="container-fluid px-5">
                            <div class="row gx-5 mt-5">
                                <div class="col-md-4 mb-3">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                        <p class="mb-0"> Registrarse en la Plataforma Crea tu cuenta de acuerdo al perfil que mas te convenga. </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                        <p class="mb-0"> Verificar sus datos Verifica tus datos y llena los formularios de la plataforma </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                        <p class=" mb-0"> Escoger el Plan de Inversión Decide cuanto dinero puedes invertir, no arriesgues más de lo que debes. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5 mt-5">

                                <div class="col-md-4 mb-3">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                        <p class="mb-0">
                                             Depositar Puedes realizar el pago con tu tarjeta de debito/credito o transferencia al wallet. Escoge el método de pago que mas te conviene 
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                        <p class="mb-0">
                                             Esperar Proceso Trading de 1 año Mientras el proceso de inversión ocurre por periodo de un año, puedes verificar tus inversiones, solicitar reportes, inscribirte a nuestros eventos y aprender a hacer trading. 
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                        <p class="mb-0">
                                             Retirar sus Ganancias o Incluir Nuevo Plan Despues del año de contrato puedes solicitar el retiro de tus fondos a la cuenta bancaria del titular o puedes reinvertir tu capital y ganancias. 
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
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
</body>
</html>
