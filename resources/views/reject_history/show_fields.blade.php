<!-- Name Field -->
<div class="form-group">
    {!! Form::label('title', 'Nombre:') !!}
    <p>{{ $rejectionHistory->user->name }}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Fecha:') !!}
    <p>{{ $rejectionHistory->date }}</p>
</div>

<!-- Commet Field -->
<div class="form-group">
    {!! Form::label('Commet', 'Comentario:') !!}
    <p>{{ $rejectionHistory->comment }}</p>
</div>


 

 
