<div>
    <!-- Well begun is half done. - Aristotle -->
    @foreach($profesores as $profesor)
        <div>
            <h2>Profesor: {{ $profesor->nombre }}</h2>
            <p>Identificación: {{$profesor->cedulaLetra}}-{{ $profesor->cedulaNumero }}</p>
            <p><a href="{{$profesor->url}}">Ver profesor</a></p>
        </div>
    @endforeach
</div>
