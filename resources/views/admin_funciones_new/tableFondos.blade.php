@extends('layouts_new.app')
@section('content')
<strong>Fondos</strong>
<div class="container bg-1 w-100 h-100 p-5" id="rounded-container" >
    <div class="row col-12">
        {!!Form::open(['route'=>'clients.filter','class'=>'col-10 row'])!!}
        <div class="form-group col-sm-4">
            {!! Form::label('plan', 'Planes:') !!}
            {{-- {!! Form::select('plan', ["Todos"]+$plans,null, ['class' => 'form-control', 'value'=>'-']) !!} --}}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('funds', 'Fondos:') !!}
            {{-- {!! Form::select('funds', $months,null, ['class' => 'form-control', 'value'=>'-']) !!} --}}
        </div>
        <div class="form-group col-sm-3">
            {!! Form::label('year', 'Año:') !!}
            {{-- {!! Form::number('year',null, ['class' => 'form-control','min'=>'0']) !!} --}}
        </div>
        <div class="form-group col-sm-2">
            {!! Form::label('filtrar', '&nbsp;') !!}
            {{-- {!! Form::submit('Filtrar', ['class' => 'form-control btn btn-primary']) !!} --}}
        </div>
        {!!Form::close()!!}
        <div class="form-group col-sm-2">
            {!! Form::label('filtrar', '&nbsp;') !!}
            <a href="{{route('payment.plan')}}" class="form-control btn btn-success">Nuevo Fondo</a>
        </div>
    </div>
    <div class="table-responsive-sm p-4 bg-1" id="rounded-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Monto Recolectado</th>
                    <th>Editar Fondo</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>


    </div>

</div>
@endsection