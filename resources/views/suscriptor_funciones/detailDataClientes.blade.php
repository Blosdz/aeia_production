@extends('layouts_new.app')

@section('content')
    <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
        <div class="col-sm-4"> 
            <h3>{{ $users_with_payments['name'] }}</h3>
        </div>
        <div class="col-sm-4">
            <b>User email</b><br>
            {{ $users_with_payments['email'] }}<br>
            <b>User rol</b><br>
            {{ $users_with_payments['rol'] }}<br>
            <b>Creado en</b><br>
            {{ $users_with_payments['created_at'] }}<br>
            <b>User plan-comprado</b><br>
            @if (!empty($users_with_payments['plan_id']))
                {{ implode(', ', $users_with_payments['plan_id']) }}<br>
                <b>Total pagado:</b>{{ implode(', ', $users_with_payments['total']) }}<br>
            @else
                No Planes
            @endif
        </div>
    </div>
@endsection