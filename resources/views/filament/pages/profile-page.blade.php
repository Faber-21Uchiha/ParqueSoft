<h1 class=" text-green-800 mb-2 p-2 rounded-2xl text-center font-bold text-3xl dark:text-lime-500 mt-2 w-full uppercase">
    Certificados </h1>
<x-filament::card>
    <x-filament::form>
        @csrf
        <div>
            <div class="form-group">
                <h1 class="text-center font-bold nombre-usuario">{{ $name }}</h1>
                <h1 class="text-center font-bold nombre-usuario">{{ $email }}</h1>
            </div>
            <x-filament::form>
                <!-- tu código HTML aquí -->
                <button type="button" id="boton"
                    class="bg-green-600 text-white mb-2 p-2 rounded-2xl font-semibold mt-2 w-full uppercase">vista
                    previa certificado</button>
            </x-filament::form>
            <style>
                #plantilla-container {
                    display: none;
                }
            </style>
            <x-filament::form>
                @if (isset($Plantillas) && count($Plantillas) > 0) {{-- Comprueba si existe la variable $Plantillas y si tiene elementos --}}
                    <div id="plantilla-container">
                        <select name="plantilla" id="plantilla"
                            class="w-full bg-green-500 mb-3 text-white rounded-2xl text-center font-bold uppercase"
                            required>
                            @foreach ($Plantillas as $Plantilla)
                                <option value="{{ $Plantilla->plantilla }}">{{ $Plantilla->plantilla }}</option>
                            @endforeach
                        </select>
                        <div>
                            <embed id="preview" type="application/pdf" width="100%" height="600px">
                        </div>
                    </div>
                @endif {{-- Finaliza el if --}}
            </x-filament::form>
        </div>

    </x-filament::form>
</x-filament::card>
<script>
    const boton = document.getElementById('boton');
    const plantillaContainer = document.getElementById('plantilla-container');
    const select = document.getElementById("plantilla");
    const Aui = document.querySelector(".nombre-usuario").textContent;
    const preview = document.getElementById("preview");
    // Agregar evento de clic al botón
    let ocultar = 0;
    boton.addEventListener('click', () => {
        const moi = document.querySelector('#boton')
        if (ocultar === 0) {
            plantillaContainer.style.display = 'block';
            ocultar = 1;
            moi.classList.remove('bg-green-600');
            moi.classList.add('bg-red-600');
            moi.textContent = 'ocultar vista previa certificado'
            const selectedValue = select.value;
            preview.setAttribute("src", `../generar-pdf.php?name=${Aui}`);
        } else {
            moi.classList.remove('bg-red-600');
            moi.classList.add('bg-green-600');
            moi.textContent = 'vista previa certificado'
            plantillaContainer.style.display = 'none';
            ocultar = 0;
        }
    })


    // Agregar evento de cambio al select
    select.addEventListener("change", function() {
        // Obtener el valor seleccionado
        const selectedValue = select.value;

        // Actualizar el atributo src del embed
        preview.setAttribute("src", `../generar-pdf.php?name=${Aui}`);

    });
</script>
