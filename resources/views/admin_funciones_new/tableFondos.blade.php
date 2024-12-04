@extends('layouts_new.app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fondos</h1>
</div>


<div class="form-group col-sm-2">
    {!! Form::label('filtrar', '&nbsp;') !!}
    <a href="{{ route('adminSelect') }}" class="form-control btn btn-success">Nuevo Fondo</a>
</div>



{{-- if user->rol == 1  --}}
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Editar Fondos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
           <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Monto Recaudado</th>
                        <th>Editar Fondo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getFondos as $fondo)
                    <tr>
                        <td>{{$fondo->id}}</td>
                        <td>{{$fondo->fondo_name}}</td>
                        <td>{{$fondo->timestamps}}</td>
                        <td>{{$fondo->total}}</td>

                        <td class="justify-content-center align-items-center d-flex"><a href="{{ route('fondo.edit', ['id' => $fondo->id]) }}" ><i class="fa-solid fa-plus"></i></a></td>
                        
                    </tr>
                    @endforeach
                </tbody>


           </table>

        </div>

    </div>

</div>
@endsection
