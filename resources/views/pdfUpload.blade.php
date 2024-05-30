@extends('layouts.app')
@section('content')
    <h1>Subir Documento</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <form action="{{ route('pdf-upload-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf_file"> <!-- Cambiado el nombre del campo a pdf_file -->
        @error('pdf_file')
            <div>{{ $message }}</div>
        @enderror

        <label for="document_type">Seleccionar tipo de documento:</label>
        <select name="document_type" id="document_type">
            <option value="KYC">KYC</option>
            <option value="NotaBanco">Nota de Banco</option>
        </select>

        <button type="submit">Subir</button>
    </form>
@endsection

