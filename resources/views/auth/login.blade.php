<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login | CoreUI | {{ config('app.name') }}</title>
    <meta name="description" content="CoreUI Template - InfyOm Laravel Generator">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">

   <style>


        .outerring {
            position: relative;
            width: 100%;
            height: 100%;
            /* border-radius: 100%; */
            /* border: 5px solid #47dbdb; */
        }

        .innerring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: calc(100% - 2px);
            height: calc(100% - 3px);
            /* border-radius: 100%; */
            /* border: 5px solid #2255cb; */
            animation: breathe 4s linear infinite;
        }

        @keyframes breathe {
            0% {
                box-shadow: 0;
            }
            25% {
                box-shadow: inset 0 0 1000px 5px #152346;
            }
            50% {
                box-shadow: inset 0 0 1200px 5px #094be6;
            }
            75% {
                box-shadow: inset 0 0 2000px 5px #1c74e7;
            }
            100% {
                box-shadow: 0;
            }
        }
        body {
            color:white;

            background-color: #09114A;
        }

        #login-form{
            height: 100vh;
        }
        #login-right{
            /* background: #1b253e; */
        }
        #login-left{
            /* 5bbcf7c7 */
            background: #0b0c14;
        }
        .form-container {
            /* height: 100%; */
            /* display: flex; */
            align-items: center;
            justify-content: center;
            margin-top: 15vw;
        }
        #form-item{
            width:35vw;
        }
        input{
            border-radius: 2vw !important;
            background: #00000000 !important;
            color: white !important;
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.6) !important; /* Color del placeholder */
        }
        #logo{
            width: 14vw;
        }
    </style>
</head>
<body>
    <div class="container-fluid d-none d-md-block" id="login-form">
        <div class="row h-100" id="login-left">
            <div class="col d-flex align-items-center justify-content-center outerring">
                <div class="innerring"></div>
                    <img src="welcome/images/logo2.png" alt="" data-position="center center" id="logo" />
                {{-- </div> --}}
            </div>
            <div class="col " id="login-right">
                <div class="container form-container"  id="form-item">
                    <form method="post" action="{{ url('/login') }}">
                        @csrf
                        <h1>Iniciar Sesión</h1>
                        {{-- <p class="text-muted">Inicio de se</p> --}}
                        <br>    

                        <label for="email">Email</label><br>
                        <div class="input-group mb-3">
                            {{-- <div class="input-group-prepend"> --}}
                                {{-- <span class="input-group-text">@</span> --}}
                            {{-- </div> --}}
                            <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email') }}"
                                   placeholder="Ingresa tu Correo">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label for="password">Contraseña</label>
                        <div class="input-group mb-4">
                            {{-- <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="icon-lock"></i>
                                </span>
                            </div> --}}
                            <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" name="password"
                                    placeholder="Ingresa tu Contraseña">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                   <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <a href="/register"><p> Crear Cuenta </p></a>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit">Iniciar Sesión</button>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}" class="btn btn-link px-0">Olvidé mi contraseña</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-md-none">
            <div class="row d-flex align-items-center justify-content-center outerring " style="width:auto !important;">
                <div class="innerring" style="height:calc(150%) !important ; width:calc(170%)!important; "></div>
                    <img src="welcome/images/logo2.png" alt="" data-position="center center" id="logo" style="width:45vw; !important"/>
                {{-- </div> --}}
            </div>
            <div class="row ">
                <div class="container form-container">
                    <form method="post" action="{{ url('/login') }}">
                        @csrf
                        <h1>Iniciar Sesión</h1>
                        {{-- <p class="text-muted">Inicio de se</p> --}}
                        <br>    

                       <label for="email">Email</label><br>
                        <div class="input-group ">
                            {{-- <div class="input-group-prepend p-3"> --}}
                                {{-- <span class="input-group-text">@</span> --}}
                            {{-- </div> --}}
                            <input type="email" class="form-control p-3 {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email') }}"
                                   placeholder="Ingresa tu Correo">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label for="password">Contraseña</label>
                        <div class="input-group ">
                            {{-- <div class="input-group-prepend p-3">
                                <span class="input-group-text">
                                  <i class="icon-lock"></i>
                                </span>
                            </div> --}}
                            <input type="password" class="form-control p-3 {{ $errors->has('password')?'is-invalid':'' }}" name="password"
                                    placeholder="Ingresa tu Contraseña">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                   <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <a href="/register" class="p-3 "><p> Crear Cuenta </p></a>

                        <div class="row p-3">
                            <button class="btn btn-primary px-4" type="submit">Iniciar Sesión</button>
                        </div>
                        <div class="row p-3 p-3">
                            <a href="{{ route('password.request') }}" class="btn btn-link px-0">Olvidé mi contraseña</a>
                        </div>
                    </form>
                </div>
            </div>
    </div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">

                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%; background-color: #1b253e !important;">
                    <div class="card-body text-center">
                        <div>
                        <img src="welcome/images/logo.png" alt="" data-position="center center" />
                        </div>
                    </div>
                </div>

                <div class="card p-4">
                    <div class="card-body">
                        <form method="post" action="{{ url('/login') }}">
                            @csrf
                            <h1>Iniciar Sesión</h1>
                            <p class="text-muted">Inicio de sesión al dashboard</p>
                            <br>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email') }}"
                                       placeholder="Correo">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" name="password"
                                        placeholder="Contraseña">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                       <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">Iniciar Sesión</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div> --}}
{{-- </div> --}}
<!-- CoreUI and necessary plugins-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
</body>
</html>
