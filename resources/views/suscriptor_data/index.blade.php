@extends('layouts.app')                                                
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
<div class="container mt-5">
    <h2>Subscriptor Data</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Refered Code</th>
                <th>Plan ID</th>
                <th>Membership Collected</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptorData as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->refered_code }}</td>
                    <td>{{ $data->plan_id }}</td>
                    <td>{{ $data->membership_collected }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
