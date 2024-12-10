@php
  $user_session = Auth::user();
@endphp

@if($user_session->rol == 1)
    {!! Form::model($payment, ['route' => ['payments.update.status', $payment->id], 'method' => 'post', 'files' => true]) !!}
    
    <div class="form-group col-sm-6">
        {!! Form::label('status', 'Estado del Pago:') !!}
        {!! Form::select('status', 
            ['Pagado' => 'Pagado', 'Rechazado' => 'Rechazado', 'Revision' => 'Revisión'], 
            null, 
            ['class' => 'form-control', 'placeholder' => 'Seleccionar un estado']
        ) !!}
    </div>

    <div class="form-group col-sm-6">
        <a href="{{ Storage::url($payment->comprobante) }}" target="_blank" class="btn btn-info">Comprobante</a>
    </div>
    
    <div class="form-group col-sm-6">
        {!! Form::label('comments_on_payment', 'Observaciones:') !!}
        {!! Form::textarea('comments_on_payment', null, ['class' => 'form-control bg-light', 'rows' => 3]) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('voucher_picture', 'Actualizar Foto del Voucher') !!}
        {!! Form::file('voucher_picture', ['class' => 'form-control-file']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('comprobante', 'Adjuntar Archivo PDF (Opcional)') !!}
        {!! Form::file('comprobante', ['class' => 'form-control-file']) !!}
    </div>

    <div class="form-group col-sm-12 pt-3">
        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>

    {!! Form::close() !!}

    <!-- Mensajes de error o éxito -->
    @if(session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
@endif


@if($user_session->rol == 3)
    @if($payment->status == "Revision")
        {!! Form::open(['route' => ['payments.editPayment', $payment->id], 'method' => 'post', 'files' => true]) !!}
        
    <div class="form-group col-sm-6">
        {!! Form::label('voucher_picture', 'Actualizar Foto del Voucher') !!}
        {!! Form::file('voucher_picture', ['class' => 'form-control-file']) !!}
    </div>
    
    <div class="form-group col-sm-6">
        {!! Form::submit('Actualizar Voucher', ['class' => 'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
    @endif



    <div class="form-group col-sm-6">
        <label for="status"><strong>Status:</strong></label>
        <p>{{ $payment->status }}</p>
    </div>

    <div class="form-group col-sm-6">
        <label for="comments"><strong>Observaciones:</strong></label>
        <p>{{ $payment->comments_on_payment }}</p>
    </div>

    <div class="form-group col-sm-6">
        <a href="{{ Storage::url($payment->comprobante) }}" target="_blank" class="btn btn-info">Comprobante</a>
    </div>
@endif
