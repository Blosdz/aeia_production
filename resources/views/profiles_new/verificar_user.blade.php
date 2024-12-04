@extends('layouts_new.app')

@section('content')

@php
    $sex_list = ['Hombre'=>'Hombre', 'Mujer'=>'Mujer'];
    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Perfiles a verificar</h1>
  </div>


  <div class="row p-3 justify-content-center align-items-center " >
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
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  @include('profiles_new.suscriptor_data_filled')
                  // fields
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

              <div class="row card shadow tab-content d-flex justify-content-between align-items-center" id="myTabContent">
                <div class="tab-pane fade show active bg-1 rounded" id="home" role="tabpanel" aria-labelledby="home-tab">
                  @include('profiles_new.usuario_filled')
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
                @include('profiles_new.usuario_business_filled')
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
