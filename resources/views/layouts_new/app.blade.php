@php
    $user = Auth::user();
    $profile = Auth::user()->with('profile')->first(); 

    $profile = $profile->profile->where('user_id', $user->id)->first();

    //dd($user, $profile);
    //dd($user->rol);

    $badge = '<span class="badge badge-success w-100" style="">Validado</span>';
    
    $session_validate = 5;
    if( $user->rol == 2 or $user->rol == 3 or $user->rol == 4 ) {
        if($user->validated == 0) {
            $badge = '<span class="badge badge-warning w-100" style="">En Validacion</span>';
        }
        $session_validate = $profile->verified;
    }
    switch ($session_validate) {
        case 0:
            $badge = '<span class="badge badge-info w-100" style="">No validado</span>';
            break;
        case 1:
            $badge = '<span class="badge badge-warning w-100" style="">En Validacion</span>';
            break;
        case 2:
            $badge = '<span class="badge badge-success w-100" style="">Validado</span>';
            break;
        case 3:
            $badge = '<span class="badge badge-danger w-100" style="">Rechazado</span>';
            break;
        default:
            # code...
            break;
    }
@endphp


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.6.96/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <script src="{{ url('/countries.js') }}"></script>
    <link rel="stylesheet" href="{{ url('welcome_new/events.css') }}">

    <!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js" integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>

@stack('scripts')
</head>


<body>
    <img src="{{URL::asset('images/dashboard/brand2.png')}}" class="fondo_dashboard" alt="">
    <header></header>
    <div class="app-body-new">
        @include('layouts_new.sidebar_new')
        <main class="main">
            @yield('content')
        </main>
    </div>
</body>