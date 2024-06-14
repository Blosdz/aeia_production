<div class="table-responsive-sm">
    <table class="table table-striped" id="notifications-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Titulo</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th colspan="3">Acccion</th>
            </tr>
		@if($user->rol==6)
			<button onclick="window.location='{{url("/notifications/create")}}'">Create Notificacion</button>
		@endif
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->user->email }}</td>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->body }}</td>
                <td>{{ $notification->created_at->setTimezone('America/Lima') }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('notifications.show', [$notification->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
