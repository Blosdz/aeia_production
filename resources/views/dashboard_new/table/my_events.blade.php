<div class="card-body">  
    <h4>Mis Eventos</h4>
    <div class="owl-carousel owl-theme mt-4">

        @foreach($myEvents as $data)
            <div class="item">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="blog">
                        <figure><img src="{{ asset('storage/'.$data->event->image) }}" alt=""/></figure>
                        <div class="content">
                            <span><i class="fa  fa-calendar-o"></i> {{ $data->event->date->toFormattedDateString() }}</span>
                            <h5>{{ $data->event->title }}</h5>
                            <p>{{ $data->event->description }}</p>
                            <a href="{{$data->event->link_meet}}" class="blog-btn">LINK: {{ $data->event->link_meet }} </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>