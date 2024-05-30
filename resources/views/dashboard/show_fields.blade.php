<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Título:') !!}
    <p>{{ $event->title }}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Fecha:') !!}
    <p>{{ $event->date }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descripción:') !!}
    <p>{{ $event->description }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p> <img height="200" src="{{ asset('storage/'.$event->image) }}" alt="" title=""></p>

</div>

<!-- Link Meet Field -->
<div class="form-group">
    {!! Form::label('link_meet', 'Link Meet:') !!}
    <p>{{ $event->link_meet }}</p>
</div>

<!-- Link Recording Field -->
<div class="form-group">
    {!! Form::label('link_recording', 'Link Grabación:') !!}
    <p>{{ $event->link_recording }}</p>
</div>

<!-- Total Field -->
<div class="form-group">
    {!! Form::label('total', 'Total:') !!}
    <p>{{ $event->total }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Estado:') !!}
    @if($event->status == '1')
        <p>{{ "publicado" }}</p>
    @else
        <p>{{ "no publicado" }}</p>
    @endif
</div>

 
