@extends('layouts_new.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Seguro</h1>
</div>

<div class=" card shadow mb-4 row  " id="rounded-container">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Selecciona tu plan</h6>
    </div>
    <div class="card-body">
        <div class="card" style="width: 18rem;">
            <img src="{{URL::assets('/images/dashboard/aa seguros 1-1.webp')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Seguro para Deportistas</h5>
              <p class="card-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, omnis placeat eum ipsa fugit, voluptatum incidunt quaerat modi ducimus aperiam soluta autem quibusdam amet debitis delectus harum a tenetur ad tempore illo neque possimus quo rerum nesciunt? Laborum, earum quia?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias dolores, fugiat exercitationem qui ullam veniam cum magnam dolorem, ad esse accusantium? Similique nobis, culpa maxime doloribus ipsam alias adipisci saepe dolorem beatae quos nisi dignissimos perspiciatis impedit ab dolore illo nihil corporis eius sit repellat expedita ullam, tempora obcaecati at? Voluptate consectetur doloremque animi facere odio laborum cumque, quam tempore! Quisquam, quidem.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure inventore vero omnis cumque dolore, libero nisi! Fugiat rem sequi animi doloribus possimus aperiam atque facere magni, ad qui delectus molestiae.
              </p>
              <a href="{{url('/insurance/create')}}" class="btn btn-primary">Contratar</a>
            </div>
        </div>
    </div>
</div>