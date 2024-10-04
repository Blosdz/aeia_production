@extends('layouts_new.app')
@section('content')

@php
use Carbon\Carbon;
@endphp

<strong>Historial Suscriptor</strong> 
<div class="row w-100 bg-1 p-3 d-flex justify-content-between" id="rounded-container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach($historialByYear as $year => $data)
        <li class="nav-item">
            <a class="nav-link @if ($loop->first) active @endif" id="{{ $year }}-tab" data-toggle="tab" href="#{{ $year }}" role="tab" aria-controls="{{ $year }}" aria-selected="true">{{ $year }}</a>
        </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach($historialByYear as $year => $data)
        <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $year }}" role="tabpanel" aria-labelledby="{{ $year }}-tab">
        {{-- further develop needs to be made 
        <div class="product-area-wrapper tableView">
                <div class="products-header">
                    <div class="product-cell">Plan</div>
                    @for($i=1;$i<=12;$i++)
                        <div class="product-cell"> 
                            {{DateTime::createFromFormat('!m',$i)->format('F')}}
                        </div>
                    @endfor
                </div>
                <div class="products-row">

                </div>
            </div>
        --}}
            <div class="table-responsive">
                <table class="table table-striped" id="payments-table-{{ $year }}">
                    <thead>
                        <tr>
                            <th>Plan</th>
                            @for($i = 1; $i <= 12; $i++)
                            <th>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            @for($i = 1; $i <= 12; $i++)
                            @php
                                $monthTotal = $data->where('plan_id', $plan->id)->filter(function ($item) use ($i) {
                                    return Carbon::parse($item->created_at)->month == $i;
                                })->sum('membership_collected');
                            @endphp
                            <td>$ {{ $monthTotal }}</td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <strong>Total General</strong> <br>

                <div class="col" id="graph-{{ $year }}"></div>

            </div>
            <div class="row">
                <strong>Total por planes individual</strong> <br>
                <div class="col" id="graph-individual-{{ $year }}"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
  var anualData=@json( $planData ?? [] );
</script>
<script src="{{mix('js/client.js')}}"></script>
@endsection
