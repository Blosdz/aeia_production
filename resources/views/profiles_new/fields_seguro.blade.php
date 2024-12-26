<div class="justify-content-center text-align-center p-5">
    <form id="insuranceForm" action="{{ route('profiles.upload_insurance') }}" method="POST">
        @csrf
        <label for="input">¿CUÁNTAS PERSONAS DESEA INCLUIR EN LA COBERTURA?</label>
        <input type="number" id="input" name="total_insured" class="form-control" placeholder="Ingrese un número" required>
        
        <div class="accordion mt-4" id="accordionExample"></div>
        <button type="submit" class="btn btn-primary mt-3">Guardar Información</button>
    </form>
</div>

<script>
    const input = document.getElementById('input');
    const accordionContainer = document.getElementById('accordionExample');

    input.addEventListener('input', function () {
        const numPersons = parseInt(this.value) || 0;
        accordionContainer.innerHTML = ''; // Limpia el contenedor

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
                                <input type="file" accept="image/*" class="form-control" id="dni${i}" name="persons[${i}][dni]" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="first_name${i}">Nombres:</label>
                                <input type="text" class="form-control" id="first_name${i}" name="persons[${i}][first_name]" maxlength="30" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="lastname${i}">Apellidos:</label>
                                <input type="text" class="form-control" id="lastname${i}" name="persons[${i}][lastname]" maxlength="30" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="type_document${i}">Tipo de documento de identidad:</label>
                                <select class="form-control" id="type_document${i}" name="persons[${i}][type_document]" required>
                                    @foreach($document_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="dni_number${i}">Número de DNI o Documento:</label>
                                <input type="text" class="form-control" id="dni_number${i}" name="persons[${i}][dni_number]" maxlength="30" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="country_document${i}">País emisor del documento de identidad:</label>
                                <select class="form-control" id="country_document${i}" name="persons[${i}][country_document]" required>
                                    @foreach($countries as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="address${i}">Dirección de residencia:</label>
                                <input type="text" class="form-control" id="address${i}" name="persons[${i}][address]" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            accordionContainer.innerHTML += accordionItem;
        }
        // Asegurarse de que solo un acordeón esté abierto
        const allAccordionButtons = accordionContainer.querySelectorAll('.accordion-button');
        allAccordionButtons.forEach(button => {
            button.addEventListener('click', function () {
                const currentlyExpanded = this.getAttribute('aria-expanded') === 'true';

                // Cierra todos los demás acordeones
                allAccordionButtons.forEach(btn => {
                    const targetCollapse = document.querySelector(btn.getAttribute('data-bs-target'));
                    if (btn !== this) {
                        btn.classList.add('collapsed');
                        btn.setAttribute('aria-expanded', 'false');
                        targetCollapse.classList.remove('show');
                    }
                });

                // Alternar el estado del actual
                const targetCollapse = document.querySelector(this.getAttribute('data-bs-target'));
                if (!currentlyExpanded) {
                    this.classList.remove('collapsed');
                    this.setAttribute('aria-expanded', 'true');
                    targetCollapse.classList.add('show');
                }
            });
        });
    });
</script>
