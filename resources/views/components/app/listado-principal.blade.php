<!-- The whole future lies in uncertainty: live immediately. - Seneca -->
@php
    $listado = $attributes->get('listado') ?? [];
    $config = $attributes->get('config') ?? (object) [
        'singular' => 'elemento',
        'plural' => 'elementos',
        'nuevo' => 'un elemento nuevo',
        'rutaNuevo' => '',
    ];
@endphp

@if (count($listado) === 0)
    <div class="col-12 mx-auto">
        <div class="py-4 display-4 text-muted text-center">
            No se han encontrado {{ $config->plural }}. <br> <a href="{{ $config->rutaNuevo }}">Empieza con {{$config->nuevo}}</a>
        </div>
    </div>
@else
    <div class="col-md-10 col-lg-8 mx-auto">
        <section class="d-flex flex-column h-100">
            @foreach ($listado as $elemento)
            <x-adminlte-card theme="dark" theme-mode="outline" class="mb-0">
                <h3 class="card-title">{{ $elemento->titulo }}</h3>
            </x-adminlte-card>
            @endforeach
        </section>
    </div>
@endif