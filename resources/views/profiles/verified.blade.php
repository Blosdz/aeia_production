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
                 <div class="col-lg-12 pt-2">
                     Verificación
                     <div class="card" style="min-height: 75vh">
                         
                        <div class="card-body text-center h-100">

                            <table class="w-50 m-auto" style="min-height: 70vh">
                                <tbody>
                                    <tr>
                                        <td> <p style="font-size: 5vh;"> Tu perfil está verificado correctamente </p> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="font-size: 2vh;">Tu perfil se encuentra verificado correctamente, no es necesario que 
                                                modifiques nada. Si decides modificar tu información de verificación, 
                                                recuerda que deberás pasar nuevamente por el proceso de
                                                verificación. Nota: Si te encuentras con una inversión en curso no 
                                                podrás modificar tu información de verificación hasta cuando termine.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('profiles.user') }}">
                                                <h3> Modificar información de verificación</h3>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                     </div>
                  </div>
             
             
            </div>
        </div>
    </div>
</div>
@endsection
