
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link text-center" href="#">
       @if ($profile && $profile->profile_picture)
            <img src="/storage/{{$profile->profile_picture}}" class="img-fluid" style="width: 60%"/>
        @else
            <img src="/images/user-icon.png" class="img-fluid" style="width: 60%">
        @endif
        <br>
        {{ $user->name }}
        <br>
        {!! $badge !!}
        <br>
    </a>
</li>

@php
  if( $user->rol == 1 ) { //admin
@endphp

<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
       <i class="mdi mdi-24px mdi-account-group-outline"></i>
        <span>Suscriptores y clientes</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
       <i class="mdi mdi-24px mdi-account-check-outline"></i>
        <span>Perfiles a verificar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
       <i class="mdi mdi-24px mdi-hand-coin-outline"></i>
        <span>Depositos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin_funciones.fondos') }}">
       <i class="mdi mdi-24px mdi-archive-arrow-up-outline"></i>
        <span>Subir Documentos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('fondos.index') }}">
       <i class="mdi mdi-24px mdi-archive-refresh-outline"></i>
        <span>Actualizar Fondos</span>
    </a>
</li>



@php
  }
  if( $user->rol == 2 ) { //Suscriptor
@endphp

<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="mdi mdi-24px mdi-view-dashboard"></i>
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    @if ($session_validate == 2)
        <a class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}" href="{{ route('profiles.verified') }}">
    @else
        <a class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}" href="{{ route('profiles.user') }}">
    @endif
        <i class="mdi mdi-24px mdi-account-search"></i>
        <span>Verificación</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('payments*') ? 'active' : '' }}" href="{{ route('payments.index2') }}">
        <i class="mdi mdi-24px mdi-bitcoin"></i>
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('invite*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invite.user') }}">
        <i class="mdi mdi-24px mdi-send"></i>
        <span>Invitar</span>
    </a>
</li>

@php
  }
  if( $user->rol == 3 ) { // Cliente
@endphp
<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="mdi mdi-24px mdi-view-dashboard"></i>
        <span>Inicio</span>
    </a>
</li>



<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="mdi mdi-24px mdi-account-search"></i>
        <span>Verificacion</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clients.index') }}">
        <i class="mdi mdi-24px mdi-bitcoin"></i>
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('invite*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invite.user') }}">
        <i class="mdi mdi-24px mdi-send"></i>
        <span>Invitar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('vouchers.show') }}">
       <i class="mdi mdi-24px mdi-hand-coin-outline"></i>
        <span>Recibos</span>
    </a>
</li>

@php
  }
  if( $user->rol == 4 ) { // Business
@endphp

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <i class="mdi mdi-24px mdi-account"></i>
        <span>Verificación</span>
    </a>
</li>


@php
  } if( $user->rol == 5 ) { //Gestor comercial
@endphp

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.subscribers') }}">
       <i class="mdi mdi-24px mdi-account"></i>
        <span>Suscriptores</span>
    </a>
</li>

@php
  } if( $user->rol == 6 or $user->rol==8) { //Verificador
@endphp

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Perfiles a verificar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
       <i class="mdi mdi-24px mdi-hand-coin-outline"></i>
        <span>Depositos</span>
    </a>
</li>


@php
  }
@endphp
<li class="nav-item {{ Request::is('contracts*') ? 'active' : '' }}">
   <a class="nav-link" href="{{ route('contracts.index') }}">
       <i class="mdi mdi-24px mdi-file-document-outline"></i>
       <span>Contratos</span>
   </a>
</li>

<li class="nav-item {{ Request::is('notifications*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
        <i class="mdi mdi-24px mdi-inbox"></i>
        Notificaciones
        <span class="badge badge-success notification" style="display: none;"><i class="fa fa-bell"></i></span>
    </a>
</li>

{{-- <li class="nav-item {{ Request::is('plans*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('plans.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Plans</span>
    </a>
</li> --}}
{{-- <li class="nav-item {{ Request::is('clientPayments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clientPayments.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Client Payments</span>
    </a>
</li> --}}

@php 
	if($user->rol==8 or $user->rol==6){
@endphp
   <li class="nav-item {{ Request::is('showUsers*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('showUsers') }}">
	    <i class="mdi mdi-24px mdi-account-cash"></i>
		<span>Clientes</span>
        </a>
    </li>
	<li class="nav-item {{ Request::is('showUsers*') ? 'active' : '' }}">
	    <a class="nav-link" href="{{ route('showproduct') }}">
	        <i class="mdi mdi-24px mdi-view-dashboard"></i>
	        <span>Pdf Files</span>
	    </a>
	</li>

	@php
    }
@endphp
@php 
	if($user->rol==1){
@endphp
   <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="mdi mdi-24px mdi-view-dashboard"></i>
            <span>Fondo General</span>
        </a>
    </li>
@php
    }
@endphp
