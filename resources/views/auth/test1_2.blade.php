<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login | CoreUI | {{ config('app.name') }}</title>
    <meta name="description" content="CoreUI Template - InfyOm Laravel Generator">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
</head>
<body>
    <section class="registration">
        <div class="container pd-b30">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="section-heading2">
                        <h4>Mis Eventos</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-slider">
                    @for ($i = 0; $i < 6; $i++)   
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="blog">
                           <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                           <div class="content">
                           <span><i class="fa  fa-calendar-o"></i>January 29, 2021</span>
                              <h4><a href="#">¿El proceso de inversión en criptos es seguro?</a></h4>
                              <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                              <a class="blog-btn">LINK: https://meet.google.com/vrr-pioe-xbf </a>
                           </div>
                        </div>
                     </div>
                     @endfor
               </div>
            </div>
        </section>
        <section class="registration">
        <div class="container pd-b30">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="section-heading2">
                        <h4>Eventos Próximos</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-slider">
                    @for ($i = 0; $i < 6; $i++)   
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="blog">
                           <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                           <div class="content">
                           <span><i class="fa  fa-calendar-o"></i>January 29, 2021</span>
                              <h4><a href="#">¿El proceso de inversión en criptos es seguro?</a></h4>
                              <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                              <a class="blog-btn">LINK: https://meet.google.com/vrr-pioe-xbf </a>
                           </div>
                        </div>
                     </div>
                     @endfor
               </div>
            </div>
        </section>
        <section class="registration">
        <div class="container pd-b30">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="section-heading2">
                        <h4>Eventos Pasados</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-slider">
                    @for ($i = 0; $i < 6; $i++)   
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <div class="blog">
                           <figure><img src="welcome_new/images/blog/1.jpg" alt=""/></figure>
                           <div class="content">
                           <span><i class="fa  fa-calendar-o"></i>January 29, 2021</span>
                              <h4><a href="#">¿El proceso de inversión en criptos es seguro?</a></h4>
                              <p>Nam nec tellus a odio tincidunt auctor are odio sed non mauris. This is Photoshop's ern  of Lorem Ipsum Proin gravida.</p>
                              <a class="blog-btn">LINK: https://meet.google.com/vrr-pioe-xbf </a>
                           </div>
                        </div>
                     </div>
                     @endfor
               </div>
            </div>
        </section>
<!-- CoreUI and necessary plugins-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
</body>
</html>
