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
                        <th>Carencia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($combinedData as $data)
                        <tr>
                            <td>{{ $data['persona']['first_name'] }}</td>
                            <td>{{ $data['persona']['lastname'] }}</td>
                            <td>{{ $data['persona']['dni_number'] }}</td>
                            <td>{{ $data['persona']['deporte'] }}</td>
                            <td>{{ $data['persona']['club'] }}</td>
                            <td>{{ $data['persona']['address'] }}</td>
                            <td>
                                @php
                                    $totalAmount = 0;
                                    if (!empty($data['pagos']['monto_pays'])) {
                                        foreach ($data['pagos']['monto_pays'] as $type) {
                                            $totalAmount += $type === 'monthly' ? 15 : ($type === 'annual' ? 180 : 0);
                                        }
                                    }
                                @endphp
                                ${{ $totalAmount }}
                            </td>
                            <td>
                                @if (!empty($data['pagos']['fechas']))
                                    <ul>
                                        @foreach ($data['pagos']['fechas'] as $fecha)
                                            <li>{{ $fecha }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Sin pagos
                                @endif
                            </td>
                            <td>
                                @php
                                    $carencia = 'Sin Validar';
                                    if (!empty($data['pagos']['status']) && $data['pagos']['status'] === 'validar') {
                                        $validationDate = \Carbon\Carbon::parse($data['pagos']['validation_date']);
                                        $monthsToAdd = ($data['pagos']['monto_pays'][0] ?? '') === 'monthly' ? 3 : 2;
                                        $carenciaDate = $validationDate->addMonths($monthsToAdd);
                                        $diferenciaDias = now()->diffInDays($carenciaDate, false);
                                        $carencia = $diferenciaDias > 0
                                            ? "Faltan $diferenciaDias días para cobertura"
                                            : "Cobertura activa";
                                    }
                                @endphp
                                {{ $carencia }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody> 
            </table>
        </div>
    </div>
</div>



<script>

</script>
