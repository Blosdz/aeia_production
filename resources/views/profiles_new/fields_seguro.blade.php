<div class="justify-content-center text-align-center p-5">
    <form id="insuranceForm" action="{{ route('profiles.upload_insurance') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="input">¿CUÁNTAS PERSONAS DESEA INCLUIR EN LA COBERTURA?</label>
        <input type="number" id="input" name="total_insured" class="form-control" placeholder="Ingrese un número" required>
        
        <div class="accordion mt-4" id="accordionExample"></div>
        <button type="submit" class="btn btn-primary mt-3">Guardar Información</button>
    </form>
</div>

<script>
$(document).ready(function () {
    const input = $('#input');
    const accordionContainer = $('#accordionExample');

    input.on('input', function () {
        const numPersons = parseInt($(this).val()) || 0;
        accordionContainer.html(''); // Limpia el contenedor

        for (let i = 1; i <= numPersons; i++) {
            const accordionItem = `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading${i}">
                        <button class="accordion-button ${i === 1 ? '' : 'collapsed'}" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#collapse${i}" 
                                aria-expanded="${i === 1}" aria-controls="collapse${i}">
                            Persona #${i}
                        </button>
                    </h2>
                    <div id="collapse${i}" class="accordion-collapse collapse ${i === 1 ? 'show' : ''}" 
                         aria-labelledby="heading${i}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Formulario para Persona #${i}:</strong>
                            <div class="form-group mt-2">
                                <label for="dni${i}">Cargar foto de DNI frontal:</label>
                                <input type="file" accept="image/*" class="form-control file-input" id="dni${i}" name="persons[${i}][dni_file]" required>
                                <div class="progress mt-2" id="progress-dni${i}" style="display: none;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                                </div>
                                <img id="preview-dni${i}" class="img-fluid mt-2" style="max-width: 200px; display: none;" />

                                <div class="form-group mt-2">
                                    <label for="dni_r${i}">Cargar foto de DNI posterior:</label>
                                    <input type="file" accept="image/*" class="form-control file-input" id="dni_r${i}" name="persons[${i}][dni_r_file]" required>
                                    <div class="progress mt-2" id="progress-dni_r${i}" style="display: none;">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                                    </div>
                                </div>
                                <img id="preview-dni_r${i}" class="img-fluid mt-2" style="max-width: 200px; display: none;" />

                                <div class="form-group col">
                                    <label for="first_name${i}">Nombres:</label>
                                    <input type="text" class="form-control" id="first_name${i}" name="persons[${i}][first_name]" maxlength="30" required>
                                </div>



                                <div class="form-group col">
                                    <label for="lastname${i}">Apellidos:</label>
                                    <input type="text" class="form-control" id="lastname${i}" name="persons[${i}][lastname]" maxlength="30" required>
                                </div>

                                <div class="form-group col">
                                    <label for="type_document${i}">Tipo de documento de identidad:</label>
                                    <select class="form-control" id="type_document${i}" name="persons[${i}][type_document]" required>
                                        @foreach($document_types as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col">
                                    <label for="dni_number${i}">Número de DNI o Documento:</label>
                                    <input type="text" class="form-control" id="dni_number${i}" name="persons[${i}][dni_number]" maxlength="30" required>
                                </div>

                                <div class="form-group col">
                                    <label for="Deporte${i}">Deporte:</label>
                                    <input type="text" class="form-control" id="deporte${i}" name="persons[${i}][deporte]" maxlength="30" required>
                                </div>


                                <div class="form-group col">
                                    <label for="Club${i}">Club:</label>
                                      <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Opcional"></i>Opcional
                                        <input type="text" class="form-control" id="club${i}" name="persons[${i}][club]" maxlength="30" placeholder="Opcional">
                                </div>

                                <div class="form-group col">
                                    <label for="country_document${i}">País emisor del documento de identidad:</label>
                                    <select class="form-control" id="country_document${i}" name="persons[${i}][country_document]" required>
                                        <option value="Perú">Perú</option>
                                    </select>
                                </div>

                                <div class="form-group col">
                                    <label for="address${i}">Dirección de residencia:</label>
                                    <input type="text" class="form-control" id="address${i}" name="persons[${i}][address]" maxlength="50" required>
                                </div>

 


                            </div>
                        </div>
                    </div>
                </div>
            `;
            accordionContainer.append(accordionItem);
        }
    });

    // Delegación para botones del acordeón
    accordionContainer.on('click', '.accordion-button', function () {
        const currentlyExpanded = $(this).attr('aria-expanded') === 'true';

        // Cierra todos los demás acordeones
        accordionContainer.find('.accordion-button').each(function () {
            const targetCollapse = $(this).data('bs-target');
            $(this).addClass('collapsed').attr('aria-expanded', 'false');
            $(targetCollapse).removeClass('show');
        });

        // Alternar el estado del actual
        const targetCollapse = $(this).data('bs-target');
        if (!currentlyExpanded) {
            $(this).removeClass('collapsed').attr('aria-expanded', 'true');
            $(targetCollapse).addClass('show');
        }
    });

    // Manejo de carga de archivos y previsualización
    $(document).on('change', '.file-input', function (e) {
        const inputId = $(this).attr('id');
        const file = e.target.files[0];
        const reader = new FileReader();
        const progressId = `progress-${inputId}`;
        const previewId = `preview-${inputId}`;
        
        $(`#${progressId}`).show();
        $(`#${progressId} .progress-bar`).css('width', '0%').text('0%');

        reader.onloadstart = function () {
            $(`#${previewId}`).hide();
        };

        reader.onprogress = function (event) {
            if (event.lengthComputable) {
                const percentComplete = Math.round((event.loaded / event.total) * 100);
                $(`#${progressId} .progress-bar`).css('width', `${percentComplete}%`).text(`${percentComplete}%`);
            }
        };

        reader.onload = function (event) {
            $(`#${previewId}`).attr('src', event.target.result).show();
        };

        reader.onloadend = function () {
            $(`#${progressId}`).hide();
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
});

</script>