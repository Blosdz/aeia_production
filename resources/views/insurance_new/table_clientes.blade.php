@php
  $user_session = Auth::user();
  $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cobertura</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Historial de Beneficiarios y Pagos</h6>
        {!! Form::label('filtrar', '&nbsp;') !!}
        @if ($user_session->validated == 1)
            <a href="{{ route('insurance.plans') }}" style="background-color:green" class="form-control btn btn-success">Contratar Cobertura</a>
        @else
            <button type="button" class="form-control btn btn-success" onclick="showAlert()">Nuevo depósito</button>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Deporte</th>
                        <th>Club</th>
                        <th>Dirección</th>
                        <th>Monto Pagado</th>
                        <th>Fecha de Pago</th>
                        <th>Recibo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($combinedData as $data)
                        <tr>
                            <td>{{ $data['persona']['first_name'] }}</td>
                            <td>{{ $data['persona']['lastname'] }}</td>
                            <td>{{ $data['persona']['type_document'] }}: {{ $data['persona']['dni_number'] }}</td>
                            <td>{{ $data['persona']['deporte'] ?? ""}} </td>
                            <td>{{ $data['persona']['club']  ?? ""}}</td>
                            <td>{{ $data['persona']['address'] }}</td>
                            @if (!empty($data['persona']['pagos']))
                                @foreach ($data['persona']['pagos'] as $pago)
                                        <td>S/{{ $pago['monto'] }}</td>
                                        <td>{{ Carbon\Carbon::parse($pago['fecha'])->format('d/m/Y') }}</td>
                                        <td>
                                            @if (!empty($pago['img_url']))
                                                <a href="{{ asset('storage/' . $pago['img_url']) }}" target="_blank">Ver recibo</a>
                                                <td>
                                                    No disponible
                                                </td>
                                            @endif
                                        </td>
                                @endforeach
                            @else                                               
                            <td>No disponible</td>
                            <td>No disponible</td>
                            <td>No disponible</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>

</script>
