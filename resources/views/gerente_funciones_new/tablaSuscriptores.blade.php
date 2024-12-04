@extends('layouts_new.app')

@section('content')
    <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Estado de Licencia</th>
                    <th>Clientes</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users_refered as $user)
                    <tr>
                        <th>{{ $user['unique_code'] }}</th>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['validated'] }}</td>
                        <td>{{$user['totalReferidos']}}</td>
                        <td>
                            <a href="{{ route('detailSuscriptor', ['id' => $user['id']]) }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
@endsection
