<div class="card-body">  
    <h4>Próximos Eventos</h4>
    <div class="owl-carousel owl-theme mt-4">

        @foreach($futureEvents as $event)
            <div class="item">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="blog">
                        <figure><img src="{{ asset('storage/'.$event->image) }}" alt=""/></figure>
                        <div class="content">
                            <span><i class="fa  fa-calendar-o"></i> {{ $event->date->toFormattedDateString() }}</span>
                            <h5>{{ $event->title }}</h5>
                            <p>{{ $event->description }}</p>
                            <br>
                            <a  id="asistir" href="{{ route('enroll', $event->id ) }}">Asistir</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
<style>

#asistir
{
    color: #EAB226;
    font-size: 14px;
    font-weight: 900;
    text-transform: uppercase;
}
</style>