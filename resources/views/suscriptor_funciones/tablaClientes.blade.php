@extends('layouts_new.app')

@section('content')
    <div class="row h-100 w-100 p-4 bg-1" id="rounded-container">
        <div class="product-area-wrapper tableView">
            <div class="products-header">
                <div class="product-cell">Correo</div>
                <div class="product-cell">Nombres</div>
                <div class="product-cell">Estado</div>
                <div class="product-cell">Monto Invertido</div>
                <div class="product-cell">Detalles</div>
            </div>

            @foreach ($users_refered as $user)
                <div class="products-row">
                        <div class="product-cell">{{$user['email']}}</div>
                        <div class="product-cell">{{$user['name']}}</div>
                        <div class="product-cell">
                            @if($user['validated'] == 2)
                                    <div class="product-cell status-cell">
                                        <div class="status active">Verificado</div>
                                    </div>
                                @elseif( $user['validated']== 0)
                                    <div class="product-cell status-cell">
                                        <div class="status disabled">Sin datos</div>
                                    </div>
                                @elseif($user['validated'] ==1)
                                    <div class="product-cell status-cell">
                                        <div class="status sent">Por validar</div>
                                    </div>
                                @elseif( $user['validated']==3)
                                    <div class="product-cell status-cell">
                                        <div class="status refused">Rechazado</div>
                                    </div>
                            @endif
                        </div>
                        <div class="product-cell">{{$user['totalPayments']}}</div>
                        <div class="product-cell">
                            <a href="{{route('detailCliente',['id'=>$user['id']])}}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </div>               

                </div>

            @endforeach
        </div>

    </div>
@endsection

