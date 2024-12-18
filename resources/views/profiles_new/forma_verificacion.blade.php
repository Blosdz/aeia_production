@extends('layouts_new.app')

@section('content')

@php
    $user_session = Auth::user();
    $sex_list = ['Hombre'=>'Hombre', 'Mujer'=>'Mujer'];
    //dd($user_session);
    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Verifica tu información</h1>
  </div>
  <div class="row p-3 justify-content-center align-items-center " >
  @include('flash::message')
    @include('coreui-templates::common.errors')
      @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif
      <div class="col p-4" id="rounded-container">
        {!! Form::model($profile, ['route' => ['profiles.update2', $profile->id], 'method' => 'post', 'files' => true]) !!}
          @php
            if ($user_session->rol==2) {
          @endphp
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
            </li>
          </ul>
          <div class="tab-content card shadow" id="myTabContent">
            <div class="tab-pane fade show active bg-1 rounded" id="home" role="tabpanel" aria-labelledby="home-tab">
              @include('profiles_new.fields_suscriptor')
            </div>
          </div>
          @php
            } else if ($user_session->rol==3) {
          @endphp
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="seguro-tab" data-toggle="tab" href="#seguro" role="tab" aria-controls="seguro" aria-selected="false">Seguro</a>
            </li>
          </ul>
          
          <div class="row card shadow tab-content d-flex justify-content-between align-items-center" id="myTabContent">
            <div class="tab-pane fade show active bg-1 rounded" id="home" role="tabpanel" aria-labelledby="home-tab">
              @include('profiles_new.fields_usuario')
            </div>
            <div class="tab-pane fade bg-1 rounded" id="seguro" role="tabpanel" aria-labelledby="seguro-tab">
              @include('profiles_new.fields_seguro')
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
            <div class="tab-pane fade show active bg-1 rounded" id="home" role="tabpanel" aria-labelledby="home-tab">
              @include('profiles_new.fields_usuario_business')
            </div>
          </div>
          @php
            }
          @endphp
        {!! Form::close() !!}
      </div>
  </div>
@endsection
