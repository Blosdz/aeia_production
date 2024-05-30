<div class="table-responsive-sm">
    <table class="table table-striped" id="clientPayments-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Payment Id</th>
        <th>Referred Code</th>
        <th>Referred User Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clientPayments as $clientPayment)
            <tr>
                <td>{{ $clientPayment->user_id }}</td>
            <td>{{ $clientPayment->payment_id }}</td>
            <td>{{ $clientPayment->referred_code }}</td>
            <td>{{ $clientPayment->referred_user_id }}</td>
                <td>
                    {!! Form::open(['route' => ['clientPayments.destroy', $clientPayment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('clientPayments.show', [$clientPayment->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('clientPayments.edit', [$clientPayment->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>