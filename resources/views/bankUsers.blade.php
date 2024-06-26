@extends('layouts.app')

@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Total Pagos</th>
		<th>Documents</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ isset($totalPaymentsByUser[$user->name]) ? $totalPaymentsByUser[$user->name] : 0 }}</td>
		<td> 
                   <td>
<!--mostrar los documentso -->
                    <ul>
                        @foreach ($totalDocuments[$user->name] as $document)
                            <li><a href="{{ route('viewproduct', ['id' => $document->id]) }}">{{ $document->document_type }}</a></li>
                        @endforeach
                    </ul>
                    </td>
		</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

