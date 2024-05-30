@extends('layouts.app')
@php
    $user = Auth::user();
    $profile = Auth::user()->with('profile')->first(); 
    $profile = $profile->profile->where('user_id', $user->id)->first();
    
    $session_validate = 5;
    if( $user->rol == 2 or $user->rol == 3 or $user->rol == 4 ) {
        $session_validate = $profile->verified;
    }
@endphp
@section('content')
  <div class="container-fluid">
        <div class="animated fadeIn">
             <div class="row">
             
                 <div class="col-lg-12">
                     <div class="card">
                         
                        <div class="card-body text-center">
                            
                                @switch($session_validate)
                                    @case(0)
                                        <div class="alert alert-info" role="alert">
                                            Tu perfil no está verificado. Ingresa a la opción Verificación del menú lateral y completa la información requerida.
                                        </div>
                                        @break
                                    @case(1)
                                        <div class="alert alert-warning" role="alert">
                                            Tu información está siendo validada.
                                        </div>
                                        @break
                                    @case(2)
                                        <div class="alert alert-success" role="alert">
                                            Tu información ha sido validada correctamente.
                                        </div>
                                        @break
                                    @case(3)
                                        <div class="alert alert-danger" role="alert">
                                            Tu información ha sido rechazada. Ingresa a la opción Verificación del menú lateral y completa la información requerida.
                                        </div>
                                        @break
                                    @default
                                @endswitch
                            <div class="p-2 w-50 text-center mx-auto">  
                                <p style="font-size: 3vh"> Aquí podrás visualizar todas las estadísticas de tus balances, clientes 
                                    registrados con tu código, seguimiento de las inversiones realizadas, y 
                                    mucho más.
                                </p>
                            </div>
                            <img src="/images/bot-icon.png" alt="User profile" class="img-fluid" style="height: 50vh">
                        </div>   
                     </div>
                  </div>
             
             
            </div>
        </div>
    </div>
</div>
@endsection
