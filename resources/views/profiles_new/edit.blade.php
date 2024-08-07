@extends('layouts_new.app')

@section('content')

@php
    $sex_list = ['Hombre'=>'Hombre', 'Mujer'=>'Mujer'];
    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp
      <strong>Perfiles a verificar</strong>
      <div class="container">
        <div class="row bg-1 h-100 w-100 rounded p-4">
          <div class="row col-12">
            {!! Form::model($profile, ['route' => ['profiles.update', $profile->id], 'method' => 'patch','enctype'=>'multipart/form-data']) !!}
              @php
                if ($profile->user->rol==2) {
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
                @include('profiles_new.fields')
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @include('profiles_new.fields_2')
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                @include('profiles_new.fields_3')
                </div>
              </div>
              @php
                } else if ($profile->user->rol==3) {
              @endphp
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
                </li>
              </ul>
              <div class="tab-content bg-1" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('profiles_new.fields2_rol3_2')
                </div>
              </div>
              @php
              }else if ($profile->user->rol==4) {
              @endphp
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('profiles_new.fields2_rol4_4')
                </div>
              </div>
              @php
                }
              @endphp
              <br>
              @php
                  $verified_list = [0=>'En validacion', 1=>'Informacion enviada', 2=>'Validado', 3=>'Rechazado'];
              @endphp
              <!-- Type Field -->
              <div class="form-group col-sm-6">
                  {!! Form::label('verified', 'Estado de la Verificacion:') !!}
                  {!! Form::select('verified', $verified_list, null, ['class' => 'form-control','empty'=>'Seleccionar una Opcion']) !!}
              </div>
              <div class="form-group col-sm-3">
                <label for="pdf_file">Subir Documento</label>
                <input type="file" name="pdf_file" id="pdf_file">
                @error('pdf_file')
                <div>{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-sm-3">
                  {!! Form::label('obs', 'Observación:') !!}
                  {!! Form::textarea('obs', null, ['class' => 'form-control','rows'=>3, 'style'=>'width: 550px;']) !!}
                  @if (session('success'))
                  <div>{{ session('success') }}</div>
                  @endif
                      <!-- Submit Field -->
                <div class="form-group col-sm-12">
                  {!! Form::submit('Guardar verificacion', ['class' => 'btn btn-primary']) !!}
                </div>	
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div> 
@endsection
