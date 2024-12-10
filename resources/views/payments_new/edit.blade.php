@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Depósitos</h1>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Editar Depósito</h6>
    </div>
    <div class="card-body">
        <div class="row">
                <div class="col-3 col-sm-4 col-xl-4 d-flex align-items-center justify-content-center">
                    <img src="{{ Storage::url($payment->voucher_picture) }}" width="300" alt="Imagen No Subida por el Usuario">

                </div>

                <div class="col">
                       @include('payments_new.fields')
                </div>
        </div>

    </div>
</div>
@endsection


