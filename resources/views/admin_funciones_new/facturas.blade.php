@extends('layouts_new.app')

@section('content')
<strong>Facturas </strong>

<div class="container bg-1 w-100 h-100 p-5" id="rounded-container">
    <div class="row" id="contracts-row-1">
        <div class="contracts-outher-table">
            <table class="table table-striped" id="payments-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Mes</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Fecha de transacción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->user ? $payment->user->name : 'N/A' }}</td>
                            <td>{{ $payment->month }}</td>
                            <td>{{ $payment->total }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>{{ $payment->date_transaction }}</td>
                            <td>
                                <form action="{{ route('facturas.store_voucher', $payment->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col">
                                        {!! Form::label('pdf_file', 'Carga un documento PDF:') !!}
                                        <div class="row" id="file3">
                                            <div class="custom-file col-6 ml-2" id="rrr3">
                                                {!! Form::label('pdf_file', "Select file", array('class' => 'custom-file-label', 'for' => 'pdf_file', 'id' => 'file_input_label_pdf')) !!}
                                                <input type="file" accept="application/pdf" class="custom-file-input" name="pdf_file" id="pdf_file" oninput="input_filename(event);" tofill="" onclick="check_progress_bar(event)">
                                                <input type="text" class="d-none" id="hide_pdf_file" value="{{ old('pdf_file') }}">
                                            </div>
                                            <div class="col-5 d-none" id="show_progress_bar_pdf">
                                                <button class="btn btn-primary" id="loading_btn_pdf" type="button" disabled>
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    Cargando...
                                                    <span id="load_percentage_pdf"></span>
                                                </button>
                                                <button type="button" id="cancel_btn_pdf" class="btn btn-secondary">Cancelar Carga</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Subir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No hay pagos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


<script>
    function input_filename(event) {
        let input = event.target;
        let label = input.nextElementSibling;
        let fileName = input.files[0].name;
        label.innerText = fileName;
    
        let progressBarId = (input.id === 'profile_picture') ? 'show_progress_bar_profile_picture' : 'show_progress_bar_pdf';
        document.getElementById(progressBarId).classList.remove('d-none');
    }
    
    function check_progress_bar(event) {
        // Placeholder for progress bar check
    }
    </script>
