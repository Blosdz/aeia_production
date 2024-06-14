<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

<!-- <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
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
</li> -->

@php
  if( $user->rol == 1 ) { //admin
@endphp

<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <img src="{{URL::asset('/images/dashboard/clientes_subscriptores.png')}}" alt="">
        <span>Suscriptores y clientes</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
        <img src="{{URL::asset('/images/dashboard/verificar_clientes.png')}}" alt="">
        <span>Perfiles a verificar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('payments.index') }}">
        <img src="{{URL::asset('/images/dashboard/estados_nav.png')}}" alt="">
        <span>Depositos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin_funciones.fondos') }}">
        <img src="{{URL::asset('/images/dashboard/documentos_nav.png')}}" alt="">
        <span>Subir Documentos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('fondos.index') }}">
        <img src="{{URL::asset('/images/dashboard/actualizar_fondos.png')}}" alt="">
        <span>Actualizar Fondos</span>
    </a>
</li>



@php
  }
  if( $user->rol == 2 ) { //Suscriptor
@endphp

<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Inicio</span>
    </a>
</li>

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    @if ($session_validate == 2)
        <a class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}" href="{{ route('profiles.verified') }}">
    @else
        <a class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}" href="{{ route('profiles.user') }}">
    @endif
        <img src="{{URL::asset('/images/dashboard/perfil_nav.png')}}" alt="">
        <span>Verificación</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('payments*') ? 'active' : '' }}" href="{{ route('payments.index2') }}">
        <img src="{{URL::asset('/images/dashboard/depositar.png')}}" alt="">
        <span>Depositar</span>
    </a>
</li>

<li class="nav-item {{ Request::is('invite*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invite.user') }}">
        <img src="{{URL::asset('/images/dashboard/invitar.png')}}" alt="">
        <span>Invitar</span>
    </a>
</li>

@php
  }
  if( $user->rol == 3) { // Cliente
@endphp
<li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Inicio</span>
    </a>
</li>



<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <img src="{{URL::asset('/images/dashboard/perfil_nav.png')}}" alt="">
        <span>Verificacion</span>
    </a>
</li>

<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clients.index') }}">
        <img src="{{URL::asset('/images/dashboard/depositar.png')}}" alt="">
        <span>Depositar</span>
    </a>
</li>

<!-- <li class="nav-item {{ Request::is('invite*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('invite.user') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Invitar</span>
    </a>
</li> -->

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
    <a class="nav-link" href="{{ route('home') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Inicio</span>
    </a>
</li>



<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.user') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Verificación</span>
    </a>
</li>
<li class="nav-item {{ Request::is('payments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('clients.index') }}">
        <img src="{{URL::asset('/images/dashboard/depositar.png')}}" alt="">
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

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.subscribers') }}">
        <img src="{{URL::asset('/images/dashboard/clientes_subscriptores.png')}}" alt="">
        <span>Suscriptores</span>
    </a>
</li>
<li class="nav-item {{ Request::is('subscriptor-data*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('subscriptor.data.index') }}">
        <img src="{{URL::asset('/images/dashboard/home_nav.png')}}" alt="">
        <span>Inicio</span>
    </a>
</li>



@php
  } if( $user->rol == 6 or $user->rol==8) { //Verificador
@endphp

<li class="nav-item {{ Request::is('profiles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profiles.index') }}">
        <img src="{{URL::asset('/images/dashboard/verificar_clientes.png')}}" alt="">
        <span>Perfiles a verificar</span>
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
<li class="nav-item {{ Request::is('contracts*') ? 'active' : '' }}">
   <a class="nav-link" href="{{ route('contracts.index') }}">
        <img src="{{URL::asset('/images/dashboard/contratos.png')}}" alt="">
        <span>Contratos</span>
   </a>
</li>

<li class="nav-item {{ Request::is('notifications*') ? 'active' : '' }}">
    <a class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
        <img src="{{URL::asset('/images/dashboard/alertas.png')}}" alt="">
        Notificaciones
        <span class="badge badge-success notification" style="display: none;"><i class="fa fa-bell"></i></span>
    </a>
</li>

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
	if($user->rol==8 or $user->rol==6){
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

	@php
    }
@endphp
@php 
	if($user->rol==1){
@endphp
   <li class="nav-item">
        <a class="nav-link" href="#">
            <img src="{{URL::asset('/images/dashboard/actualizar_fondos.png')}}" alt="">
            <i class="mdi mdi-24px mdi-view-dashboard"></i>
            <span>Fondo General</span>
        </a>
    </li>
@php
    }
@endphp
