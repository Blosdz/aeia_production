@php
    $verified_list = [0=>'En validacion', 1=>'Informacion enviada', 2=>'Validado', 3=>'Rechazado'];
@endphp
<div class="row col-12">
{!! Form::open(['route'=>'profiles.index', 'class'=>'col-10 row', 'method'=>'GET']) !!}
    <div class="form-group col-sm-4">
        {!! Form::label('name', 'Nombre o Apellido') !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>"Ingrese el Nombre o Apellido"] )!!}
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('status', 'Estado: ') !!}
        {!! Form::select('status', ['Todos']+$verified_list, null, ['class'=>'form-control', 'value'=>'-']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('filtrar', '&nbsp;') !!}
        {!! Form::submit('Filtrar', ['class' => 'form-control btn btn-primary']) !!}
    </div>
</div>
