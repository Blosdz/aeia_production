@extends('layouts_new.app')

@section('content')

@php
    $user_session = Auth::user();
    $sex_list = ['Hombre'=>'Hombre', 'Mujer'=>'Mujer'];
    //dd($user_session);
    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp

  <div class="row w-100 p-3 d-flex justify-content-between align-items-center " >
      @include('flash::message')
        @include('coreui-templates::common.errors')
        @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
          <strong>Verifica tu información</strong>
          <div class="col bg-1 p-4" id="rounded-container">
                      {!! Form::model($profile, ['route' => ['profiles.update2', $profile->id], 'method' => 'post', 'files' => true]) !!}
                      @php
                        if ($user_session->rol==2) {
                      @endphp
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Socio 1</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Socio 2</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @include('profiles_new.fields2')
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('profiles_new.fields3')
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        @include('profiles_new.fields4')
                        </div>
                      </div>
                      @php
                        } else if ($user_session->rol==3) {
                      @endphp
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
                        </li>
                      </ul>
                      <div class="row tab-content d-flex justify-content-between align-items-center" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @include('profiles_new.fields2_rol3')
                        </div>
                      </div>
                      @php
                        } else if ($user_session->rol==4) {
                      @endphp
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @include('profiles_new.fields2_rol4')
                        </div>
                      </div>
                      @php
                        }
                      @endphp
                      {!! Form::close() !!}
      </div>
  </div>
@endsection
