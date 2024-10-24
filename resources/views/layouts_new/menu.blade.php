<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{URL::asset('/newDashboard/menu.css')}}"/>


@php
  if( $user->rol == 1 ) { //admin
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
    <a class="nav-link" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    @if ($session_validate == 2)
        <a class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}" href="{{ route('profiles.verified') }}">
    @else
        <a class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}" href="{{ route('profiles.user') }}">
    @endif
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
  if( $user->rol == 3) { // Cliente
@endphp
<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>
<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Verificación</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clients.index') }}">
        <i class="fa-solid fa-piggy-bank"></i>
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('vouchers.show') }}">
        <img src="{{URL::asset('/images/dashboard/estados_nav.png')}}" alt="">
        <span>Recibos</span>
    </a>
</li>

@php
  }
  if( $user->rol == 4 ) { // Business
@endphp
<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home.index') }}">
        <i class="fa-solid fa-house"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Verificación</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clients.index') }}">
        <i class="fa-solid fa-user-check"></i>
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('vouchers.show') }}">
        <img src="{{URL::asset('/images/dashboard/estados_nav.png')}}" alt="">
        <span>Recibos</span>
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
        <img src="{{URL::asset('/images/dashboard/alertas.png')}}" alt="">
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
        <img src="{{URL::asset('/images/dashboard/depositar.png')}}" alt="">
        <span>Depositos</span>
    </a>
</li>


@php
  }
@endphp
{{-- <li class="nav-item {{ Request::is('plans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('plans.index') }}">
        <img src="{{URL::asset('/images/dashboard/estados_nav.png')}}" alt="">
        <span>Plans</span>
    </a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('clientPayments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clientPayments.index') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Client Payments</span>
    </a>
</li> --}}

@php 
	if($user->rol==6){ //verificador 
@endphp
   <li class="nav-item {{ Request::is('showUsers*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('showUsers') }}">
        <img src="{{URL::asset('/images/dashboard/clientes_subscriptores.png')}}" alt="">
		<span>Clientes</span>
        </a>
    </li>
	<li class="nav-item {{ Request::is('showUsers*') ? 'active' : '' }}">
	    <a class="nav-link" href="{{ route('showproduct') }}">
            <img src="{{URL::asset('/images/dashboard/pdfs_nav.png')}}" alt="">
	        <span>Pdf Files</span>
	    </a>
	</li>
    <li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin_funciones.fondos') }}">
            <img src="{{URL::asset('/images/dashboard/documentos_nav.png')}}" alt="">
            <span>Subir Documentos</span>
        </a>
    </li>

	@php
    }
@endphp
