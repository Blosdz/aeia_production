<div class="table-responsive-sm">
    <table class="table table-striped" id="events-table">
        <thead>
            <tr>
                <th>Título</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Image</th>
        <th>Link Meet</th>
        
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->description }}</td>
           
            <td> <img height="50" src="{{ asset('storage/'.$event->image) }}" alt="" title=""></td>

            <td>{{ $event->link_meet }}</td>
           
                <td>
                    {!! Form::open(['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('events.show', [$event->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('events.edit', [$event->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>