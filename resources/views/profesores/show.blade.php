<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <h2>Profesor: {{ $profesor->nombres }}</h2>
    <p>Identificación: {{$profesor->cedulaLetra}}-{{ $profesor->cedulaNumero }}</p>
    <p>Teléfono: {{ $profesor->telefonoPrincipal }}</p>
    <p>Correo: {{ $profesor->email }}</p>

    <a href="{{route("profesores.index")}}">Regresar</a>
</div>
