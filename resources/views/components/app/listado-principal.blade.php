<!-- The whole future lies in uncertainty: live immediately. - Seneca -->
@php
    $listado = $attributes->get('listado') ?? [];
    $config = $attributes->get('config') ?? (object) [
        'singular' => 'elemento',
        'plural' => 'elementos',
        'nuevo' => 'un elemento nuevo',
        'rutaNuevo' => '',
    ];
    // dd($listado);
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
            <x-adminlte-card theme="dark" class="mb-3">
                <h3>{{ $elemento->titulo }}</h3>
                @if (isset($elemento->tags))
                    <div class="mb-2">
                        @foreach ($elemento->tags as $tag)
                        <span class="badge badge-{{ $tag->theme }}">{{ $tag->text }}</span>
                        @endforeach
                    </div>
                @endif
                <p>{{ $elemento->descripcion }}</p>
                <div class="d-flex justify-content-end">
                    @if (isset($elemento->links->ver))
                    <a href="{{ $elemento->links->ver }}" class="btn btn-primary mr-2">
                        <i class="fas fa-eye"></i> Ver
                    </a>
                    @endif
                    @if (isset($elemento->links->editar))
                    <a href="{{ $elemento->links->editar }}" class="btn btn-warning mr-2">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    @endif
                    @if (isset($elemento->links->imprimir))
                    <a href="{{ $elemento->links->imprimir }}" class="printWindow btn btn-secondary">
                        <i class="fas fa-print"></i> Imprimir
                    </a>
                    @endif
                </div>
            </x-adminlte-card>
            @endforeach
        </section>
    </div>
@endif