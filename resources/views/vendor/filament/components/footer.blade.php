{{ \Filament\Facades\Filament::renderHook('footer.before') }}
@php
    $isDarkMode = true // O false, dependiendo del modo actual
@endphp

<div class="filament-footer flex items-center justify-center">
    {{ \Filament\Facades\Filament::renderHook('footer.start') }}

   
    @if ($isDarkMode)
    <img src="{{ asset('/parque.png') }}" alt=""width="200" height="200">
    @else
    <img src="{{ asset('/PS-Corp.png') }}" alt=""width="200" height="200">
    @endif

    {{ \Filament\Facades\Filament::renderHook('footer.end') }}
</div>

{{ \Filament\Facades\Filament::renderHook('footer.after') }}
{{-- <a href="https://www.ejemplo.com">
    <img src="{{ asset('ruta/a/la/imagen.jpg') }}" alt="Descripción de la imagen" width="200" height="200">
  </a> --}}