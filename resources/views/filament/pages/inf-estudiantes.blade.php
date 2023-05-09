<x-filament::page>
    <x-filament-breezy::grid-section>
        @csrf
        <x-slot name="title">
        </x-slot>
        <x-slot name="description">
            Informacion personal del Estudiante
            <button type="button" id="boton"
                class="bg-green-600 text-white mb-1 p-2 rounded-2xl font-semibold mt-2 w-full uppercase">Actualizar</button>
        </x-slot>
        <div class="space-y-3">
            <form wire:submit.prevent="createApiToken" class="col-span-1 sm:col-span-1 mt-4 md:mt-0">
                <x-filament::card>
                    Email: <h1 class="text-right font-bold nombre-usuario">{{ $emailAuth }}</h1>
                    <x-filament::hr />
                    Name:
                    @if ($estudiante)
                        <h1 class="text-right font-bold nombre-usuario">{{ $estudiante->nombre }}</h1>
                    @endif
                    <x-filament::hr />
                    Identificacion:
                    @if ($estudiante)
                        <h1 class="text-right font-bold nombre-usuario">{{ $estudiante->identificacion }}</h1>
                    @endif
                    <x-filament::hr />
                    Entidad:
                    @if ($estudiante)
                        <h1 class="text-right font-bold nombre-usuario">{{ $estudiante->entidad }}</h1>
                    @endif
                    <x-filament::hr />
                    Cargo:
                    @if ($estudiante)
                        <h1 class="text-right font-bold nombre-usuario">{{ $estudiante->cargo }}</h1>
                    @endif
                    <x-filament::hr />
                    Telefono:
                    @if ($estudiante)
                        <h1 class="text-right font-bold nombre-usuario">{{ $estudiante->telefono }}</h1>
                    @endif
                </x-filament::card>
            </form>
        </div>
    </x-filament-breezy::grid-section>
    {{-- <!-- Campos del formulario para actualizar los datos del estudiante -->
    <button type="button" id="boton"
        class="bg-green-600 text-white mb-1 p-2 rounded-2xl font-semibold mt-2 w-full uppercase">Actualizar1</button> --}}
    <script>
        document.getElementById('boton').addEventListener('click', function() {
            var estudianteId = {{ $estudiante->id ?? 0 }};
            var url = '';
            if (estudianteId) {
                url = 'http://127.0.0.1:8000/admin/estudiantes/' + estudianteId + '/edit';
            } else {
                url = 'http://127.0.0.1:8000/admin/estudiantes/create';
            }
            window.location.href = url;
        });

        // Cambiar el texto del botón si no existen datos del estudiante
        @if (!$estudiante)
            document.getElementById('boton').innerText = 'Crear datos';
        @endif
    </script>
</x-filament::page>
