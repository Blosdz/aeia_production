@extends('layouts_new.app')

@section('content')

<strong>Clientes</strong>

<div class="row p-4 bg-1" id="rounded-container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="suscriptores-tab" data-toggle="tab" href="#suscriptores" role="tab" aria-controls="suscriptores" aria-selected="true">Suscriptores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-selected="false">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="false">Business</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="administradores-tab" data-toggle="tab" href="#administradores" role="tab" aria-controls="administradores" aria-selected="false">Administradores</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- Suscriptores -->
        <div class="tab-pane fade show active" id="suscriptores" role="tabpanel" aria-labelledby="suscriptores-tab">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suscriptores_data as $data)
                        <tr>
                            <td>{{ $data['profile']->first_name }} {{ $data['profile']->last_name }}</td>
                            <td>{{ $data['user']->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Clientes -->
        <div class="tab-pane fade" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($client_data as $data)
                        <tr>
                            <td>{{ $data['profile']->first_name }} {{ $data['profile']->last_name }}</td>
                            <td>{{ $data['user']->email }}</td>
                            <!-- Enlace que lleva a la descarga de documentos para este cliente -->
                            <td>
                                <a href="{{ route('download.documents', ['id' => $data['cliente_id']]) }}" class="btn btn-primary">Documentos</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Business -->
        <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($business_data as $data)
                        <tr>
                            <td>{{ $data['profile']->first_name }} {{ $data['profile']->last_name }}</td>
                            <td>{{ $data['user']->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Administradores -->
        <div class="tab-pane fade" id="administradores" role="tabpanel" aria-labelledby="administradores-tab">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($administrador_data as $data)
                        <tr>
                            <td>{{ $data['profile']->first_name }} {{ $data['profile']->last_name }}</td>
                            <td>{{ $data['user']->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
