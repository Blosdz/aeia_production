@extends('layouts.app')

@section('content')
    <div class="container">
	    <form action="{{ route('fondos.store') }}" method="POST">
	        @csrf
	        <div class="form-group">
	            <label for="month">Mes</label>
        	    <input type="number" class="form-control" id="month" name="month" required>
	        </div>
	        <div class="form-group">
	            <label for="total">Fondo de Inversión (Total de: {{ $totalPayments }})</label>
	            <input type="number" class="form-control" id="total" name="total" value="{{ $totalPayments }}" required>
	        </div>
	        <button type="submit" class="btn btn-primary">Crear Fondo</button>
	    </form>
        @if ($fondos->isEmpty())
            <p>No hay fondos disponibles.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mes</th>
                        <th>Fondo de Inversión</th>
                        <th>Ganancia Neta</th>
                        <th>Total Comisiones</th>
                        <th>Creado en</th>
                        <th>Actualizado en</th>
			<th>Actualizar Ganancia</th>
                        <th>Acciones</th>
			
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fondos as $fondo)
                        <tr>
                            <td>{{ $fondo->id }}</td>
                            <td>{{ $fondo->month }}</td>
                            <td>{{ $fondo->total }}</td>
                            <td>{{ $fondo->ganancia_de_capital }}</td>
                            <td>{{ $fondo->total_comisiones }}</td>
                            <td>{{ $fondo->created_at }}</td>
                            <td>{{ $fondo->updated_at }}</td>
			    <td>
                                <form action="{{ route('fondos.update-ganancia', $fondo->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="ganancia_de_capital" class="form-control" placeholder="Nueva ganancia" required>
                                    <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('fondos.update', $fondo->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-secondary">Actualizar Fondo</button>
                                </form>
                                <form action="{{ route('fondos.destroy', $fondo->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
				<td>
				<form action="{{ route('fondos.update-comisiones', $fondo->id) }}" method="POST">
				    @csrf
				    <button type="submit" class="btn btn-primary mt-2">Calcular Comisiones</button>                                                                                                         
				</form>

				</td>                                                                                                                                                                                  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection


