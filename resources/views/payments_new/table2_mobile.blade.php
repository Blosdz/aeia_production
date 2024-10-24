    <div class="product-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell">Fecha</div>
            <div class="product-cell">Monto</div>
            <div class="product-cell">Status</div>
            <div class="product-cell">Descripción</div>
        </div>

        @foreach($payments as $payment)
        <div class="products-row item">
            <div class="products-cell">{{$payment->formatted_date}}</div>
            <div class="products-cell">{{$payment->total}}</div>
            <div class="products-cell">{{$payment->status}}</div>
            <div class="products-cell"> 
                <button class="accordion-button">
                    +
                </button>
            </div>

        </div>
        <div class="products-row MoreInformation" style="display:none;">
            <div class="row p-4">
                <div class="d-grid gap-3">
                    <a href="{{ route('payments.show', [$payment->id]) }}" class='btn btn-success'>Ver detalle</a>
                    @if ($payment->contract && $payment->contract->signature_image)
                        <a href="{{ route('contracts.pdf', [$payment->contract->id]) }}" target="_blank" class="btn btn-success p-2">Ver contrato</a>
                        @if ($payment->declaracion)
                            <a href="{{ route('declaracion.pdf', [$payment->declaracion->id]) }}" target="_blank" class="btn btn-success p-2 ">Ver Declaración</a>
                        @else
                            <span class="text-danger">No hay declaración disponible</span>
                        @endif
                    @else
                        <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#updateSignatureModal-{{ $payment->id }}">
                            Actualizar firma
                        </button>
                        <a href="" class="btn btn-disabled disabled ">Ver contrato</a>
                    @endif

                </div>

            </div>
        </div>
        @endforeach
    </div>

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
    document.addeventlistener("domcontentloaded", () => {
        const buttons = document.queryselectorall(".accordion-button");

        buttons.foreach(button => {
            button.addeventlistener("click", () => {
                const parentrow = button.closest(".products-row.item");
                const inforow = parentrow.nextelementsibling;

                // alternar la visibilidad de la fila de información adicional
                parentrow.classlist.toggle("active");
                inforow.style.display = inforow.style.display === "none" || inforow.style.display === "" ? "block" : "none";
            });
        });
    });
</script>



