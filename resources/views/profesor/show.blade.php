@php
    use \Carbon\Carbon;
@endphp

<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <h2>Profesor: {{ $profesor->nombreCompleto }}</h2>
    <p>Identificación: {{$profesor->letraCedula->letra}}-{{ $profesor->cedulaNumero }}</p>
    <p>Teléfono: {{ $profesor->telefonoPrincipal }}</p>
    <p>Correo: {{ $profesor->email }}</p>
    <p>Dirección: {{ $profesor->direccion }}</p>
    <p>Fecha de nacimiento: {{ Carbon::parse($profesor->fechaNacimiento)->format('d/m/Y') }}</p>
    <p>Fecha de ingreso: {{ Carbon::parse($profesor->fechaIngreso)->format('d/m/Y') }}</p>

    <a href="{{route("profesor.index")}}">Regresar</a>
</div>
