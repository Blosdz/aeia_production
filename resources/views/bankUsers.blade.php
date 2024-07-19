@extends('layouts_new.app')

@section('content')

    <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado de Verificado</th>
                    <th>Pagos Realizados</th>
                    <th>Mas Información</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($totalPaymentsByUser as $index => $user)
                    <tr>
                        <td>{{ $user['user']['name'] }}</td>
                        <td>{{ $user['user']['email'] }}</td>
                        <td>{{ $user['user']['validated'] }}</td>
                        <td>{{ $user['total_payment'] }}</td>
                        <td>
                            <button class="btn btn-info" onclick="toggleInfo({{ $index }})">
                                {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                                +
                            </button>
                        </td>
                    </tr>
                    <tr class="toggle-info" id="toggle-info-{{ $index }}" style="display: none;">
                        <td colspan="5">
                            <!-- Información adicional aquí -->
                            <b>Unique Code:</b> {{ $user['user']['unique_code'] }}<br>
                            <b>Refered Code:</b> {{ $user['user']['refered_code'] }}<br>
                            <b>Created At:</b> {{ $user['user']['created_at'] }}<br>
                            <b>Documents:</b> {{ implode(', ', $user['documentsFilePath'] ?? []) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
    <script>
        function toggleInfo(index) {
            var element = document.getElementById('toggle-info-' + index);
            if (element.style.display === 'none') {
                element.style.display = 'table-row';
            } else {
                element.style.display = 'none';
            }
        }
    </script>


@endsection
