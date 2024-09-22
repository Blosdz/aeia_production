@extends('layouts_new.app')

@section('content')
<strong>Pagos y Documentos</strong>

<div class="row bg-1 h-100 w-100 rounded p-4" >
        <div class="app-content-actions">
            <input class="search-bar" placeholder="Search..." type="text" value="{{ request('search') }}">
            <div class="app-content-actions-wrapper">
                <div class="filter-button-wrapper">
                <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg></button>
                <div class="filter-menu">
                    <label>Category</label>
                    <select id="userTypeFilter">
                        <option value="">All Categories</option>

                    </select>

                    <label>Status</label>
                    <select id="statusFilter">
                        <option value="">All Status</option>

                    </select>

                    <div class="filter-menu-buttons">
                        <button class="filter-button reset" id="resetFilter">
                            Reset
                        </button>
                        <button class="filter-button apply" id="applyFilter">
                            Apply
                        </button>
                    </div>
                </div>


                </button>
                </div>
            </div>
        </div>

        <div class="product-area-wrapper tableView">
            <div class="products-header">
                <div class="product-cell">Fecha</div>
                <div class="product-cell">Monto</div>
                <div class="product-cell">Codigo</div>
                <div class="product-cell">Detalle</div>
                <div class="product-cell">Documentos</div>
            </div>

            @foreach($payments as $payment)
            <div class="products-row">

                    <div class="product-cell">{{$payment->date_transaction}}</div>
                    <div class="product-cell">{{$payment->total}}</div>
                    <div class="product-cell">{{$payment->contract->code}}</div>
                    <div class="product-cell">
                        <a href="{{ route('payments.show', [$payment->id]) }}" class='btn btn-success'>Ver detalle</a>
                    </div>
                    <div class="product-cell">
                        @if ($payment->contract && $payment->contract->signature_image)
                            <a href="{{ route('contracts.pdf', [$payment->contract->id]) }}" target="_blank" class="btn btn-info p-2">Ver contrato</a>
                            @if ($payment->declaracion)
                                <a href="{{ route('declaracion.pdf', [$payment->declaracion->id]) }}" target="_blank" class="btn btn-info p-2">Ver Declaración</a>
                            @else
                                <span class="text-danger">No hay declaración disponible</span>
                            @endif
                        @else
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateSignatureModal-{{ $payment->id }}">
                                Actualizar firma
                            </button>
                            <a href="" class="btn btn-disabled disabled">Ver contrato</a>
                        @endif
                    </div>

            </div>
            @endforeach
        </div>
 </div>  
 @endsection