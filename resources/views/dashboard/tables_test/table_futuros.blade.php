<div class="table-responsive-sm">
    <table class="table table-striped" id="events-table">
        <thead>
            <tr>
                <th>Título</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Image</th>
        <th>Link Meet</th>
        
            </tr>
        </thead>
        <tbody>
        @foreach($futureEvents as $event)
            <tr>
                <td>{{ $event->title }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->description }}</td>
           
            <td> <img height="50" src="{{ asset('storage/'.$event->image) }}" alt="" title=""></td>

            <td>{{ $event->link_meet }}</td>
           
                <td>
                    <div class='btn-group'>
                        
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

