@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Documentos</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Archivo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                <tr>
                    <td>{{ $document->id }}</td>
                    <td>{{ $document->document_type }}</td>  
                    <td>
                        <a href="{{ $document->file_path }}" class="btn btn-primary" target="_blank">Ver PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

