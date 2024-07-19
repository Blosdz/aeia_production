<div class="table-responsive w-100">
    <table class="table table-striped" id="payments-table" >
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Depósito</th>
                <th>Fecha</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            <tr>
                <td>{{ $contract->code }}</td>
                <td>{{ $contract->full_name }}</td>
                <td>{{ $contract->payment->total }}</td>
                <td>{{ $contract->created_at }} </td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('contracts.pdf', [$contract->id]) }}" class='btn btn-success' target="_blank">Descargar</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>