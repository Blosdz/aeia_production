@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<script src="{{ asset('welcome_new/js/carousel.js') }}"></script> 

    <ol class="breadcrumb">
        <li class="breadcrumb-item">Notificaciones</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Slider
                        </div>
                        <div class="card-body">  
                            <h4>Mis Eventos</h4>
                            <div class="owl-carousel owl-theme mt-4">
                                @for ($i = 0; $i < 6; $i++) 
                                    <div class="item">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <div class="blog">
                                                <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                                                <div class="content">
                                                    <span><i class="fa  fa-calendar-o"></i>Febrero 15, 2022</span>
                                                    <h5>¿El proceso de inversión en criptos es seguro?</h5>
                                                    <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                                                    <a href="#" class="blog-btn">LINK: https://meet.google.com/vrr-pioe-xbf </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor 
                            </div>
                        </div>

                        <div class="card-body">  
                            <h4>Próximos Eventos</h4>
                            <div class="owl-carousel owl-theme mt-4">
                                @for ($i = 0; $i < 6; $i++) 
                                    <div class="item">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <div class="blog">
                                                <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                                                <div class="content">
                                                    <span><i class="fa  fa-calendar-o"></i>Febrero 15, 2022</span>
                                                    <h5>¿El proceso de inversión en criptos es seguro?</h5>
                                                    <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                                                    <a href="#" class="blog-btn">ASISTIR </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor 
                            </div>
                        </div>

                        <div class="card-body">  
                            <h4>Eventos Pasados</h4>
                            <div class="owl-carousel owl-theme mt-4">
                                @for ($i = 0; $i < 6; $i++) 
                                    <div class="item">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <div class="blog">
                                                <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                                                <div class="content">
                                                    <span><i class="fa  fa-calendar-o"></i>Febrero 15, 2022</span>
                                                    <h5>¿El proceso de inversión en criptos es seguro?</h5>
                                                    <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                                                    <a href="#" class="blog-btn">LINK: https://meet.google.com/vrr-pioe-xbf </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor 
                            </div>
                        </div>

                    </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

