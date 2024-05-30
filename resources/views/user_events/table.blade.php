<div class="table-responsive-sm">
    <table class="table table-striped" id="userEvents-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Event Id</th>
        <th>Inscription Date</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userEvents as $userEvent)
            <tr>
                <td>{{ $userEvent->user_id }}</td>
            <td>{{ $userEvent->event_id }}</td>
            <td>{{ $userEvent->inscription_date }}</td>
                <td>
                    {!! Form::open(['route' => ['userEvents.destroy', $userEvent->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userEvents.show', [$userEvent->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('userEvents.edit', [$userEvent->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>