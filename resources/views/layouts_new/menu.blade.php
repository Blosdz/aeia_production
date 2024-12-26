<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{URL::asset('/newDashboard/menu.css')}}"/>


@php
  if( $user->rol == 1 ) { //admin
@endphp

<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Perfiles a verificar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('payments.index_admin')}}">
        <i class="fa-solid fa-building-columns"></i>
        <span>Depositos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin_funciones.fondos') }}">
        <i class="fa-solid fa-upload"></i>
        <span>Subir Documentos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tableFondos') }}">
        <i class="fa-solid fa-arrows-rotate"></i>
        <span>Actualizar Fondos</span>
    </a>
</li>





@php
  }
  if( $user->rol == 2 ) { //Suscriptor
@endphp

<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('suscriptor.home') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>


<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.profile_edit') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Verificación</span>
    </a>
</li>



<li class="nav-item {{ Request::is('suscriptores*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('suscriptores*') ? 'active' : '' }}" href="{{ route('tableClientes') }}">
        <i class="fa-solid fa-users"></i>
        <span>Clientes</span>
    </a>
</li>

<li class="nav-item {{ Request::is('historial*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('historial*') ? 'active' : '' }}" href="{{ route('Historial') }}">
        <i class="fa-solid fa-clock"></i>
        <span>Historial</span>
    </a>
</li>


@php
  }
  if($user->rol == 3 || $user->rol == 4){
@endphp
<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.home') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>
<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.profile_edit') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Verificación</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index_user') }}">
        <i class="fa-solid fa-piggy-bank"></i>
        <span>Depositar</span>
    </a>
</li>


<li class="nav-item {{ Request::is('insurance*') ? 'active' : '' }}">
    <a href="{{route('insurance.index')}}" class="nav-link">
    <i class="fa-solid fa-suitcase-medical"></i>
    <span>Cobertura</span>
    </a>
</li>


@php
  } if( $user->rol == 5 ) { //Gestor comercial
@endphp



{{-- inicio ver los suscriptores etc - crear notificaciones para sus suscriptores --}}
<li class="nav-item {{ Request::is('subscriptor-data*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('suscriptores*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('suscriptores*') ? 'active' : '' }}" href="{{ route('tableSuscriptor') }}">
        <i class="fa-solid fa-users"></i>
        <span>Suscriptores</span>
    </a>
</li>

<li class="nav-item {{ Request::is('invite*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invite.user') }}">
        <span>Invitar</span>
    </a>
</li>


@php
  } if( $user->rol == 6) { //Verificador
@endphp

<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Perfiles a verificar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
        <i class="fa-solid fa-money-bill-transfer"></i>
        <span>Depositos</span>
    </a>
</li>

<li class="nav-item {{ Request::is('notifications*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
        Notificaciones
        <span class="badge badge-success notification" style="display: none;"><i class="fa fa-bell"></i></span>
    </a>
</li>



@php
  } if($user->rol==8){    
@endphp
<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>
<li class="nav-item {{ Request::is('bank*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('showUsers') }}">
        <i class="fa-solid fa-users"></i>
        <span>Clientes</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
        <span>Depositos</span>
    </a>
</li>


@php
  }
@endphp
{{-- <li class="nav-item {{ Request::is('plans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('plans.index') }}">
        <span>Plans</span>
    </a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('clientPayments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clientPayments.index') }}">
        <span>Client Payments</span>
    </a>
</li> --}}

@php 
	if($user->rol==6){ //verificador 
@endphp
   <li class="nav-item {{ Request::is('showUsers*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('showUsers') }}">
		<span>Clientes</span>
        </a>
    </li>
	<li class="nav-item {{ Request::is('showUsers*') ? 'active' : '' }}">
	    <a class="nav-link" href="{{ route('showproduct') }}">
	        <span>Pdf Files</span>
	    </a>
	</li>
    <li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin_funciones.fondos') }}">
            <span>Subir Documentos</span>
        </a>
    </li>

	@php
    }
@endphp
