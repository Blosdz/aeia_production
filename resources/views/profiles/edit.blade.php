@extends('layouts.app')

@section('content')

@php
    $sex_list = ['Hombre'=>'Hombre', 'Mujer'=>'Mujer'];
    $document_types = ["DNI"=>"DNI", "Pasaporte"=>"Pasaporte", "Carnet de extranjería"=>"Carnet de extranjería"];
@endphp
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('profiles.index') !!}">Perfiles</a>
          </li>
          <li class="breadcrumb-item active">Perfil</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                   @include('flash::message')
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Perfiles a verificar</strong>
                          </div>
                          <div class="card-body">
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
  @include('profiles.fields')
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  @include('profiles.fields_2')
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  @include('profiles.fields_3')
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
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  @include('profiles.fields2_rol3_2')
  </div>
</div>
@php
  } else if ($profile->user->rol==4) {
@endphp
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Principal</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  @include('profiles.fields2_rol4_4')
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
                            <label for="document_type">Seleccionar tipo de documento:</label>
                            <select name="document_type" id="document_type">
                                <option value="KYC">KYC</option>
                                <option value="NotaBanco">Nota de Banco</option>
                            </select>
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

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
