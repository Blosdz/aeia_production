@extends('layouts_new.app')

@section('content')
    <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
        @foreach($users_with_payments as $users)
            <div class="col-sm-4">
                <h3>{{$users['name']}}</h3>
            </div>
            <div class="col-sm-4">
                <b>User email</b> <br>
                {{ $users['email']}}<br>
                <b>User rol</b><br>
                {{$users['rol']}}<br>
                <b>Creado en</b><br>
                {{$users['created_at']}}<br>
                <b>User plan-comprado</b><br>
                @if (!empty($users['plan_id']))
                    {{ implode(', ', $users['plan_id']) }}<br>
                @else
                    No Planes
                @endif
            </div>

        @endforeach
        
    </div>

@endsection