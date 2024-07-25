@extends('layouts_new.app')
@section('content')
<strong>Fondos</strong>
<div class="container bg-1 w-100 h-100 p-5" id="rounded-container">

    <strong>Pagos Anual</strong>
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            
        </tbody>
    </table>

    <strong>Pagos con Rescate</strong>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Status</th>
        </tr>
    </table>
</div>
@endsection     