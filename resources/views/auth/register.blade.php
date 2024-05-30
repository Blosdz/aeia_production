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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">

    <style>
        body {
        background-color: #09114A;
    }
    </style>
</head>
<body class="app flex-row align-items-center">
<div class="container">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
<script>
    $( document ).ready(function() {
        $path = document.location.pathname.split('/');
        let url = new URL(document.location.href);
        let searchParams = new URLSearchParams(url.search);
        let event_id = searchParams.get('event_id');
        if($path[1] == 'suscriptor'){
            $rol = $('#rol').val();
            $("#rol").html('<option value="3">Cliente</option>');
        }else if(event_id) {
            let type_user = searchParams.get('type_user');
            if (type_user==2) {
                $("#rol").html('<option value="2">Suscriptor</option>');
            } else if (type_user==3){
                $("#rol").html('<option value="3">Cliente</option>');
            } else if (type_user==4){
                $("#rol").html('<option value="4">Business</option>');
            }
            
            $("#event_id").val(event_id);
        }
        
    });
</script>
</body>
</html>
