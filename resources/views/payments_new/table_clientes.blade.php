@php
  $user_session = Auth::user();
  $months = ['Todos','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
@endphp


<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Historial de Pagos</h6>
        {!! Form::label('filtrar', '&nbsp;') !!}
        @if ($user_session->validated == 1)
            <a href="{{ route('payment.plan') }}" style="background-color:green" class="form-control btn btn-success">Nuevo depósito</a>
        @else
            <button type="button" class="form-control btn btn-success" onclick="showAlert()">Nuevo depósito</button>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>
                        <th>Fondo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Status</th>
                        <th>Documentos</th>
                        <th>Recibo</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($payments->isEmpty())

                    @else
                        @foreach ($payments as $payment)
                            <tr>
                                <!-- Mostrar el primer fondo_name relacionado o 'null' -->
                                <td>
                                    {{ $payment->clientPayments->first()->fondo_name ?? 'null' }}
                                </td>
                                <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                <td>{{ $payment->total }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>
                                    <a href="{{ route('payments.show', [$payment->id]) }}" class="btn btn-success">Ver detalle</a>
                                    @if ($payment->contract && $payment->contract->signature_image)
                                        <a href="{{ route('contracts.pdf', [$payment->contract->id]) }}" target="_blank" class="btn btn-info">Ver contrato</a>
                                        @if ($payment->declaracion)
                                            <a href="{{ route('declaracion.pdf', [$payment->declaracion->id]) }}" target="_blank" class="btn btn-info">Ver Declaración</a>
                                        @else
                                            <span class="text-danger">No hay declaración disponible</span>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateSignatureModal-{{ $payment->id }}">
                                            Actualizar firma
                                        </button>
                                        <a href="" class="btn btn-disabled disabled">Ver contrato</a>
                                    @endif
                                </td>
                                <td>
                                    {{-- @if ($payment->voucher_picture) --}}
                                        {{-- <a href="{{ asset('storage/' . $payment->voucher_picture) }}" target="_blank" class="btn btn-info">Ver recibo</a> --}}
                                    {{-- @else --}}
                                        <span class="text-danger">No hay recibo</span>
                                    {{-- @endif --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
   {{-- 
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="1">
                <thead>
                    <tr>

                        <th>Fondo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Status</th>
                        <th>Documentos</th>
                        <th>Recibo</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($payments->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center height-display">
                                <i class="fa-regular fa-rectangle-xmark" style="font-size: 50px;"></i>
                                <p>Aún no ha hecho un pago</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->formatted_date }}</td>
                                <td>{{ $payment->total }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>
                                    <a href="{{ route('payments.show', [$payment->id]) }}" class='btn btn-success'>Ver detalle</a>
                                    @if ($payment->contract && $payment->contract->signature_image)
                                        <a href="{{ route('contracts.pdf', [$payment->contract->id]) }}" target="_blank" class="btn btn-info">Ver contrato</a>
                                        @if ($payment->declaracion)
                                            <a href="{{ route('declaracion.pdf', [$payment->declaracion->id]) }}" target="_blank" class="btn btn-info">Ver Declaración</a>
                                        @else
                                            <span class="text-danger">No hay declaración disponible</span>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateSignatureModal-{{ $payment->id }}">
                                            Actualizar firma
                                        </button>
                                        <a href="" class="btn btn-disabled disabled">Ver contrato</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        
            @foreach ($payments as $payment)
                <div class="modal fade" id="updateSignatureModal-{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="updateSignatureModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateSignatureModalLabel">Actualizar Firma</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        
                            {!! Form::open(['route' => ['client.update_signature', $payment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3', 'id' => 'pay-form-' . $payment->id]) !!}
                            <div class="modal-body">
                                <canvas id="can-{{ $payment->id }}" width="400" height="400" style="border:2px solid;"></canvas>
                                <input type="button" value="Limpiar" onclick="clearCanvas({{ $payment->id }})">
                                <img id="canvasimg-{{ $payment->id }}" style="display:none;" src="" alt="">
                            
                                <!-- Campo oculto para la firma -->
                                <input type="hidden" name="canvas_image" id="canvas_image-{{ $payment->id }}">
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="sendFormWithCanvas({{ $payment->id }})">Actualizar</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    --}}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($payments as $payment)
            initCanvas({{ $payment->id }});
        @endforeach
    });

    function initCanvas(paymentId) {
        var canvas = document.getElementById('can-' + paymentId);
        var ctx = canvas.getContext('2d');
        var flag = false;
        var prevX = 0, currX = 0, prevY = 0, currY = 0;
        var dot_flag = false;
        var x = "black";
        var y = 2;

        canvas.addEventListener("mousemove", function(e) {
            findxy('move', e);
        }, false);
        canvas.addEventListener("mousedown", function(e) {
            findxy('down', e);
        }, false);
        canvas.addEventListener("mouseup", function(e) {
            findxy('up', e);
        }, false);
        canvas.addEventListener("mouseout", function(e) {
            findxy('out', e);
        }, false);

        function draw() {
            ctx.beginPath();
            ctx.moveTo(prevX, prevY);
            ctx.lineTo(currX, currY);
            ctx.strokeStyle = x;
            ctx.lineWidth = y;
            ctx.stroke();
            ctx.closePath();
        }

        function findxy(res, e) {
            let canvasRect = canvas.getBoundingClientRect();
            if (res == 'down') {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvasRect.left;
                currY = e.clientY - canvasRect.top;
                flag = true;
                dot_flag = true;
                if (dot_flag) {
                    ctx.beginPath();
                    ctx.fillStyle = x;
                    ctx.fillRect(currX, currY, 2, 2);
                    ctx.closePath();
                    dot_flag = false;
                }
            }
            if (res == 'up' || res == "out") {
                flag = false;
            }
            if (res == 'move') {
                if (flag) {
                    prevX = currX;
                    prevY = currY;
                    currX = e.clientX - canvasRect.left;
                    currY = e.clientY - canvasRect.top;
                    draw();
                }
            }
        }
    }

    function clearCanvas(paymentId) {
        let canvas = document.getElementById('can-' + paymentId);
        let ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById('canvasimg-' + paymentId).style.display = "none";
    }

    function saveCanvas(paymentId) {
        let canvas = document.getElementById('can-' + paymentId);
        document.getElementById('canvasimg-' + paymentId).style.border = "2px solid";
        let dataURL = canvas.toDataURL('image/png');
        document.getElementById('canvasimg-' + paymentId).src = dataURL;
        document.getElementById('canvasimg-' + paymentId).style.display = "inline";
    }

    function sendFormWithCanvas(paymentId) {
        let form = document.getElementById('pay-form-' + paymentId);
        
        saveCanvas(paymentId);
        
        let dataURL = document.getElementById('canvasimg-' + paymentId).src;
        document.getElementById('canvas_image-' + paymentId).value = dataURL;
        
        let formData = new FormData(form);
        
        // Enviar formulario usando AJAX
        $.ajax({
            type: "POST",
            url: "{{ url('/client/update_signature') }}/" + paymentId,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response); // Verificar el contenido de la respuesta
                if (response.success) {
                    alert(response.success); // Mostrar mensaje de éxito
                    window.location.href = "{{ route('clients.index') }}"; // Redirigir a la página de clientes
                }
            },
            error: function(xhr) {
                console.log(xhr); // Ver el contenido de la respuesta de error en la consola
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    alert('Hubo un error al actualizar la firma: ' + xhr.responseJSON.error);
                } else {
                    alert('Ocurrió un error desconocido.');
                }
            }
        });
    }


</script>

<script>
$('#dataTable').DataTable({
    columns: [
        { title: "Fondo" , defaultContent: 'No disponible' },
        { title: "Fecha" , defaultContent: 'No disponible' },
        { title: "Monto" , defaultContent: 'No disponible' },
        { title: "Status" , defaultContent: 'No disponible' },
        { title: "Documentos" , defaultContent: 'No disponible' },
        { title: "Recibo", defaultContent: 'No disponible'  }
    ]
});


</script>