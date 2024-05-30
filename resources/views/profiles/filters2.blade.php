<div class="row col-12">
{!! Form::open(['route'=>'profiles.subscribers', 'class'=>'col-10 row', 'method'=>'GET']) !!}
    <div class="form-group col-sm-4">
        {!! Form::label('name', 'Nombres o Apellido') !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>"Ingrese el Nombre o Apellido"] )!!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('filtrar', '&nbsp;') !!}
        {!! Form::submit('Filtrar', ['class' => 'form-control btn btn-primary']) !!}
    </div>
</div>
