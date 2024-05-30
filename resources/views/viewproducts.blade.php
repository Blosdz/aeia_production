@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Documento</h1>
    <div>
        <h2>{{ $document->document_type }}</h2>
        <embed src="{{ $document->file_path }}" type="application/pdf" width="100%" height="600px" />
    </div>
</div>
@endsection
