@extends('layouts_new.app')

@section('content')
<strong>Editar Depósito</strong>
<div class="row bg-1 w-100 h-100" id="rounded-container">
    <div class="col-lg-12 p-5">
            <!-- <div class="card"> -->
                {!! Form::model($payment, ['route' => ['payments.edit.payment', $payment->id], 'method' => 'put', 'files' => true]) !!}
                    @include('payments.fields')
                    <div class="form-group col p-5">
                        <p><strong>Sube tu voucher:</strong></p>
                        <div class="input-group">
                            {!! Form::label('voucher_picture', "Seleccionar archivo", ['class' => '', 'for' => 'voucher_picture', 'id' => 'file_input_voucher']) !!}
                            {!! Form::file('voucher_picture', ['class' => '', 'id' => 'voucher_picture', 'oninput' => 'input_filename(event);', 'tofill' => '', 'onclick' => 'check_progress_bar(event);']) !!}
                        </div>
                        <input type="text" class="d-none" id="hide_voucher">
                    </div>
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            <!-- </div> -->
        </div>
    </div>
</div>
@endsection
