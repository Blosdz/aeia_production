@php
  $user_session = Auth::user();
  $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cobertura</h1>
</div>


{{-- 

    como se va ver los pagos del seguro 
    dropdown


    ClientInsurance es 
    id |  status  | user_id  |  profile_id   | created_at | updated_at | insurance_id

--}}

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Historial de Pagos</h6>
        {!! Form::label('filtrar', '&nbsp;') !!}
        @if ($user_session->validated == 1)
            <a href="{{ route('insurance.plans') }}" style="background-color:green" class="form-control btn btn-success">Contratar Cobertura</a>
        @else
            <button type="button" class="form-control btn btn-success" onclick="showAlert()">Nuevo depósito</button>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Fecha</th>
                        <th>Ultima Actualización</th>
                        <th>Recibos</th>
                        <th>Más</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ClientInsuranceData as $ClientInsurance)
                        <tr>
                            <td>{{ $months[Carbon\Carbon::parse($ClientInsurance->created_at)->month] }}</td>
                            <td>{{ $ClientInsurance->created_at->format('d/m/Y') }}</td>
                            <td>{{ $ClientInsurance->updated_at->format('d/m/Y') }}</td>
                            <td>
                                @if ($ClientInsurance->voucher_path)
                                    <a href="{{ asset('storage/' . $ClientInsurance->voucher_path) }}" target="_blank">Ver recibo</a>
                                @else
                                    No disponible
                                @endif
                            </td>
                            <td>
                                {{-- <a href="{{ route('insurance.details', $ClientInsurance->id) }}" class="btn btn-info btn-sm">Ver detalles</a> --}}
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