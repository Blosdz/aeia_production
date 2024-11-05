<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AEIA Investments</title>

    <script src="https://cdn.jsdelivr.net/npm/jarallax@1.12.0/dist/jarallax.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('/newDashboard/newFront.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-heart-eyes" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M11.315 10.014a.5.5 0 0 1 .548.736A4.498 4.498 0 0 1 7.965 13a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .548-.736h.005l.017.005.067.015.252.055c.215.046.515.108.857.169.693.124 1.522.242 2.152.242.63 0 1.46-.118 2.152-.242a26.58 26.58 0 0 0 1.109-.224l.067-.015.017-.004.005-.002zM4.756 4.566c.763-1.424 4.02-.12.952 3.434-4.496-1.596-2.35-4.298-.952-3.434zm6.488 0c1.398-.864 3.544 1.838-.952 3.434-3.067-3.554.19-4.858.952-3.434z"/></svg> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="header navbar navbar-expand-lg navbar-dark bg-dark sticky-top px-4 border-bottom">
        <div class="container-fluid">
            <a href="" class="navbar-brand" href="#">
                <img src="{{URL::asset('welcome_new/images/logo/logoNav.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
                AEIA
            </a>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0 header-nav p-2">
                    <li class="nav-item">
                        <a class="nav-link " href="#home1"> Inicio</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#home2"> Suscriptores </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#home3"> Beneficios</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#home4"> Instrucciones</a>
                    </li> 
                </ul>
            </div> 
            <div class="d-flex-end">
                <button type="button" onclick="window.location.href='{{ url('/login') }}'" class="btn btn-outline-success me-2">Login</button>
                <button type="button" onclick="window.location.href='{{ url('/register') }}'" class="btn btn-outline-primary">Crear Cuenta</button>

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
 
    <a href="https://wa.pe/AEIAInvest" target="_blank">
        <div class="circle_whatsapp d-flex justify-content-center text-align-center">
                <i class="bi bi-whatsapp link_whatsapp"></i>
        </div>
    </a>

        <div class="galaxy">
            <div class="stars-container">
                <div class="stars1"></div>
            </div>
            
        </div>

        <div class="stars2"></div>
    <section class="position-relative pt-lg-4 pt-xl-5 d-flex text-align-center justify-content-center" id="home1" style="">
        <div class="container position-relative zindex-2 pt-2 pt-sm4 pt-md-5">
            <div class="row benefits-container justify-content-center pt-5 mt-1">
                <h1 class="display-4 text-white pt-3 mt-3 mb-4">Inversiones seguras e inteligentes con AEIA</h1>
                <div class="benefits-content">
                    <div class="benefits-content__container">
                        <ul class="benefits-content__list">
                            <li class="benefits-content__list__item">Transparencia</li>
                            <li class="benefits-content__list__item">Rentabilidad</li>
                            <li class="benefits-content__list__item">Seguridad</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-dark" id="home3" style="background:black">
        <div class="container pt-2 py-sm-3 py-md-4 py-lg-5 my-xxl-3">

            <div class="row" id="beneficios">
                <div class="subtitle text-center" id="highlight_container">
                    <p><b>BENEFICIOS DE AEIA</b></p>
                </div>
            </div>
            <div class="row" id="beneficios">
                <div class="col appear2">
                    <div class="container-glow">
                        <div class="card p-3 overflow-auto">
                            <div class="col-sm-6">
                                <div class="subtitle">
                                    Seguridad/Protección de datos
                                </div>
                                <div class="content_text">
                                    Tus datos personales no son revelados a terceros.
                                </div>
                            </div> 
                            <div class="col-sm-6 text-center"> 
                                <i class="bi bi-shield-lock-fill" id="icons-beneficios"></i>
                            </div>
                        </div>

                   </div>

                </div>
                <div class="col  appear2">
                    <div class="container-glow">
                        <div class="card p-3 overflow-auto">
                            <div class="col-sm-6">
                                <div class="subtitle">
                                    Política de transparencia
                                </div>
                                <div class="content_text">
                                    Puedes ver en tiempo real toda la información sobre tus inversiones. 
                                </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <i class="bi bi-eye-fill" id="icons-beneficios"></i>
                            </div>
                        </div>
                   </div>
                </div>
            </div>    
            <div class="row" id="beneficios">
                <div class="col  appear2">
                    <div class="container-glow">
                        <div class="card p-3 overflow-auto">
                            <div class="col-sm-6">
                                <div class="subtitle">
                                    Gestión de riesgo y estrategias de inversión
                                </div>
                                <div class="content_text">
                                    Gestionamos un portafolio de inversión para diversificar el riesgo y asumimos estrategias de rebalanceo de operaciones y activos
                                </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <i class="bi bi-exclamation-circle-fill" id="icons-beneficios"></i>
                            </div>
                        </div>
                   </div>
                </div>

                <div class="col  appear2">
                    <div class="container-glow">
                        <div class="card p-3 overflow-auto">
                            <div class="col-sm-6">
                                <div class="subtitle">
                                    Depósitos en dólares
                                </div>
                                <div class="content_text">
                                    Los depósitos se realizarán a través de la cuenta corriente de nuestra empresa.
                                </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <i class="bi bi-coin" id="icons-beneficios"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row justify-content-md-center">
                <div class="col-sm-6  appear2">
                    <div class="container-glow">
                        <div class="card p-3 overflow-auto">
                            <div class="col-sm-6">
                                <div class="subtitle">
                                    Disponibilidad del efectivo
                                </div>
                                <div class="content_text">
                                    Todos los planes de inversión duran 1 año como minimo luego de ello se puede solicitar el retiro del capital y las ganancias a la cuenta bancaria o el wallet del titular.
                                </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <i class="bi bi-wallet-fill" id="icons-beneficios"></i>
                            </div>
                        </div>
                   </div>
                </div>
            </div>

        </div>
    </section>

    <section class="position-relative overflow-hidden py-5" id="home2">
        <div class="container position-relative zindex-2 pt-2 pt-sm-3 pt-md-4 pt-lg-5 mt-xl-3">
            <div class="row p-4 padding appear3">
                <div class="col d-flex justify-content-center text-align-center ">
                    <img src="{{URL::asset('/newDashboard/images/suscriptor.jpg')}}" alt="" id="suscriptor-img">
                </div>
                <div class="col">
                    <div class="card-subs p-4">
                        <div class="subtitle "> ¿Quién es un suscriptor?</div> <br>
                        Es aquella persona que gestiona la venta y distribución de fondos de inversión para personas naturales y empresas. 

                        <div class="subtitle"> ¿Cómo puedo ser un suscriptor?</div><br>
                        Debes crear una cuenta como suscriptor y realizar la verificacón de tus datos, posteriormente deberás hacer el pago de la licencia de suscripción para ser nuestro socio comercial.
                    </div>                                                


                </div>
            </div>

        </div>

    </section>


    <section class="position-relative pt-2 pt-sm-0 pb-lg-4" id="home4" section-scroll='home4' >
    <div class="circle circle1"></div>
        <div class="container pt-2 py-sm-3 py-md-4 py-lg-5 my-xxl-3">
            <div class="row p-4" >
                <div class="subtitle text-center">
                    POCOS PASOS PARA INICIAR
                </div>
            </div>
            <div class="table_steps appear3">
                <div class="row">
                    <div class="col-12 col-md cel text-center" id="cel1">
                        <i class="bi bi-1-circle-fill" id="icon_number"></i><br>
                        Registrarse en la Plataforma
                        Crea tu cuenta de acuerdo al perfil que mas te convenga.
                    </div>
                    <div class="col-12 col-md cel text-center" id="cel2">
                        <i class="bi bi-2-circle-fill"id="icon_number"></i><br>
                        Verificar sus datos
                        Verifica tus datos y llena los formularios de la plataforma
                    </div>
                    <div class="col-12 col-md cel text-center" id="cel3">
                        <i class="bi bi-3-circle-fill"id="icon_number"></i><br>
                        Escoger el Plan de Inversión
                        Decide cuanto dinero puedes invertir, no arriesgues más de lo que debes.
                    </div>
                </div>
                <div class="cels_plus">
                    <div class="cel-divider"> 
                    </div>
                    <div class="cel-divider-row">
                    </div>
                
                    <div class="cel-divider2"> 
                    </div>
                    <div class="cel-divider-row2"> 
                    </div>
                </div>
               <div class="row">
                    <div class="col-12 col-md cel text-center" id="cel4">
                        <i class="bi bi-4-circle-fill"id="icon_number"></i><br>
                        Depositar
                        Puedes realizar el pago con tu tarjeta de debito/credito o transferencia al wallet. Escoge el método de pago que mas te conviene
                    </div>
                    <div class="col-12 col-md cel text-center" id="cel5">
                        <i class="bi bi-5-circle-fill"id="icon_number"></i><br>
                        Esperar Proceso Trading de 1 año
                        Mientras el proceso de inversión ocurre por periodo de un año, puedes verificar tus inversiones, solicitar reportes, inscribirte a nuestros eventos y aprender a hacer trading.
    
                    </div>
                    <div class="col-12 col-md cel text-center" id="cel6">
                        <i class="bi bi-6-circle-fill"id="icon_number"></i><br>
                        Retirar sus Ganancias o Incluir Nuevo Plan
                        Despues del año de contrato puedes solicitar el retiro de tus fondos a la cuenta bancaria del titular o puedes reinvertir tu capital y ganancias.
                    </div>
                </div>
    
            </div>

        </div>
    </section>

    <section class="" id="home5">
        <div class="row">
            <div class="subtitle text-center">
                Nuestras redes sociales
            </div>
        </div>
        <div class="row p-4" id="">
            <div class="icons-socials d-flex justify-content-center">
                <a href="https://wa.pe/AEIAInvest" target="_blank"><i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com/aeiainvestments" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/aeiainvestments" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/company/aeia-investment/" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://www.tiktok.com/@aeia.investments" target="_blank"><i class="bi bi-tiktok"></i></a>
                <a href="contact_support@aeia.capital" target="_blank"><i class="bi bi-envelope-at-fill"></i></a>
 
            </div>
       </div>

    </section>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.appear2');

        // Añadir retraso de transición dinámicamente
        items.forEach((element, index) => {
            element.style.transitionDelay = `${index * 0.1}s`;
        });

        const active = function(entries){
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    entry.target.classList.add('inview2'); 
                }else{
                    entry.target.classList.remove('inview2'); 
                }
            });
        }

        const io2 = new IntersectionObserver(active);

        items.forEach(item => io2.observe(item));
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.appear3');

        // Añadir retraso de transición dinámicamente
        items.forEach((element, index) => {
            element.style.transitionDelay = `${index * 0.1}s`;
        });

        const active = function(entries){
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    entry.target.classList.add('inview3'); 
                }else{
                    entry.target.classList.remove('inview3'); 
                }
            });
        }

        const io2 = new IntersectionObserver(active);

        items.forEach(item => io2.observe(item));
    });
</script>
</body>


</html>
