<div class="table-responsive-sm">
    <table class="table table-striped" id="bells-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Notification</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bells as $bells)
            <tr>
                <td>{{ $bells->user_id }}</td>
            <td>{{ $bells->notification }}</td>
                <td>
                    {!! Form::open(['route' => ['bells.destroy', $bells->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('bells.show', [$bells->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('bells.edit', [$bells->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>