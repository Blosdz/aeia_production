<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register | CoreUI | {{ config('app.name') }}</title>
    <meta name="description" content="CoreUI Template - InfyOm Laravel Generator">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <!-- Theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <style>
        body {
            background-color: #09114A;
            color: white;
        }

        .outerring {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .innerring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: calc(100% - 2px);
            height: calc(100% - 3px);
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

        #login-form {
            height: 100vh;
        }

        #login-left {
            background: #0b0c14;
        }
        #form-item{
            width:35vw;
        }

        .form-container {
            align-items: center;
            justify-content: center;
            margin-top: 15vw;
        }
        input > .form-control{
            border-radius: 2vw !important;
            background: #00000000 !important;
            color: white !important;
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.6) !important; /* Color del placeholder */
        }
        button{
            border-radius: 2vw !important;
        }
        #logo{
            width: 14vw;
        } 
    </style>
</head>
<body>
    <div class="container-fluid" id="login-form">
        <div class="row h-100" id="login-left">
            <div class="col d-flex align-items-center justify-content-center outerring">
                <div class="innerring"></div>

                <img src="welcome/images/logo2.png" alt="" data-position="center center" id="logo" />
            </div>
            <div class="col" id="login-right">
                <div class="container form-container p-4" id="form-item">
                    <form method="post" action="{{ url('/register') }}">
                        @csrf
                        <h1>Registro</h1>
                        <p class="text-muted">Registro para AEIA</p>
                        @php
                            if(isset($dataUser)) {
                        @endphp
                            <div class="alert alert-info" role="alert">
                                Te estás registrando con el código de {{$dataUser->profile->first_name}} {{$dataUser->profile->lastname}}
                            </div>
                        @php
                            }
                        @endphp

                        <label for="email">Email</label><br>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Correo">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label for="password">Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Contraseña">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <label for="password">Confirmar Contraseña</label>
                        <div class="input-group mb-4">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                            @endif
                        </div>

                        <input type="hidden" name="refered_code" value="{{ request()->query('refered_code', 'aeia') }}">

                        <b><p style="color:#fab113">Es muy importante que escoja bien su tipo de Cuenta</p></b>
                        <label for="rol">Tipo de Cuenta </label>
                        <div class="input-group mb-4 d-flex flex-column">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="switchSuscriptor" value="2" name="rol">
                                <label class="form-check-label" for="switchSuscriptor">Suscriptor</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="switchCliente" value="3" name="rol">
                                <label class="form-check-label" for="switchCliente">Cliente</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="switchBusiness" value="4" name="rol">
                                <label class="form-check-label" for="switchBusiness">Business</label>
                            </div>
                        </div>

                        <input type="hidden" value="0" name="event_id" id="event_id">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarme</button>

                        <br>
                        <a href="{{ url('/login') }}" class="text-center">Iniciar Sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script>
        $(document).ready(function() {
            let url = new URL(document.location.href);
            let searchParams = new URLSearchParams(url.search);
            let event_id = searchParams.get('event_id');
            let type_user = searchParams.get('type_user');

            if (event_id) {
                if (type_user == 2) {
                    $('#switchSuscriptor').prop('checked', true);
                } else if (type_user == 3) {
                    $('#switchCliente').prop('checked', true);
                } else if (type_user == 4) {
                    $('#switchBusiness').prop('checked', true);
                }
                $("#event_id").val(event_id);
            }

            $('.form-check-input').on('change', function() {
                $('.form-check-input').not(this).prop('checked', false);
            });
        });
    </script>
</body>
</html>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <form method="post" action="{{ url('/register') }}">
                        @csrf
                        <h1>Registro</h1>
                        <p class="text-muted">Registro para AEIA</p>
                        
    @php
        if(isset($dataUser)) {
    @endphp
        <div class="alert alert-info" role="alert">
            Te estas registrando con el codigo de {{$dataUser->profile->first_name}} {{$dataUser->profile->lastname}}
        </div>
    @php
        }
    @endphp

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
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-lock"></i>
                              </span>
                            </div>
                            <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}" name="password"
                                   placeholder="Contraseña">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-lock"></i>
                              </span>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirmar Contraseña">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                            @endif
                        </div>

                        	<input type="text" name="refered_code" value="{{ request()->query('refered_code', 'aeia') }}">
			<div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                            </div>
                            <select name="rol" id="rol" class="form-control" readonly="readonly">
                                <option value="2">Suscriptor</option>
                                <option value="3">Cliente</option>
                                <option value="4">Business</option>
                            </select>
                        </div>
                        <input type="hidden" value="0" name="event_id" id="event_id">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarme</button>

                        <br>
                        <a href="{{ url('/login') }}" class="text-center">Iniciar Sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CoreUI and necessary plugins-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>--}}
