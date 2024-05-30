@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<script src="{{ asset('welcome_new/js/carousel.js') }}"></script> 

    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @include('dashboard.table.my_events')
                        @include('dashboard.table.future_events')
                        @include('dashboard.table.past_events')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
