@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
          <!-- <a href="{!! route('events.index') !!}">Eventos</a> -->
      </li>
      <li class="breadcrumb-item active">Nuevo</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Nuevo</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'events.store', 'files' => true]) !!}

                                   @include('events.fields_create')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
