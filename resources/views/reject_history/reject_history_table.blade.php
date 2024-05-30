@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('profiles.index') }}">Perfiles a verificar</a>
      </li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             historial de rechazo
                         </div>
                         <div class="card-body">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped" id="events-table">
                                        <thead>
                                            <tr>
                                        <th>Nombre</th>
                                        <th>Motivo</th>
                                        <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if( !empty($user))
                                            @foreach($user[0]->rejection_histories as $u)
                                                <tr>
                                                <td>{{ $user[0]->name }}</td>
                                                <td>{{ $u->comment }}</td>
                                                <td>{{ $u->date }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                              <div class="pull-right mr-3">
                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection




