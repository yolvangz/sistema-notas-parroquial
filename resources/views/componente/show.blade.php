<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@extends('layouts.app')

@section('subtitle', 'Información del componente '.$planEstudio->nombre)

@section('content_header_title', 'Componentes')
@section('content_header_subtitle', $planEstudio->nombre.' > '.$componente->nombre)

@section('content_body')
    <x-layout.two-column-cards>
        <x-slot:mainCardTitle>Materias de {{ $componente->nombre }}</x-slot>
        <section>
            <a href="{{route('materia.create', ['planEstudio' => $planEstudio, 'componente' => $componente])}}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Añadir materia
            </a>
            @if($componente->materias && $componente->materias->count() > 0)
                <ul class="list-group list-group">
                    @foreach($componente->materias as $materia)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $materia->nombre }}
                                @if ($materia->cualitativa)
                                    <span class="badge bg-warning">Cualitativa</span>
                                @else
                                    <span class="badge bg-success">Cuantitativa</span>                                    
                                @endif
                                @if (!$materia->calcular)
                                    <span class="badge bg-dark">No incluida en el promedio</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('materia.edit', ['planEstudio' => $planEstudio, 'componente' => $componente, 'materia' => $materia]) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteMateriaModal{{$materia->id}}"><i class="fas fa-trash"></i> Eliminar</button>
                            </div>
                            @push('modals')
                                <!-- Confirmation Modal for Delete Materia -->
                                <div class="modal fade" id="deleteMateriaModal{{$materia->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteMateriaModalLabel{{$materia->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteMateriaModalLabel{{$materia->id}}">Eliminar Materia</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de eliminar la materia {{ $materia->nombre }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('materia.destroy', ['planEstudio' => $planEstudio, 'componente' => $componente, 'materia' => $materia]) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endpush
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mb-0 py-3 text-center text-muted">No hay materias creadas.</p>
            @endif
        </section>

        <x-slot:asideCardTitle>Sobre el Componente</x-slot>
        <x-slot:aside>
            <p class="text-center">{{$componente->descripcion}}</p>
            <p class="text-center">
                <small class="text-muted">Registrado: {{ $componente->fechaCreado ? $componente->fechaCreado->format('d/m/Y h:i A') : 'N/A' }}</small><br>
                <small class="text-muted">Últ. Modificación: {{ $componente->fechaModificado ? $componente->fechaModificado->format('d/m/Y h:i A') : 'N/A' }}</small>
            </p>
            {{-- <p class="text-muted text-center text-bold">Requisito: 
                @if ($componente->prela)
                    <a href="{{ route('componente.show', ['planEstudio' => $planEstudio, 'componente' => $componente->prela]) }}" class="text-decoration-none">
                        {{$componente->prela->nombre}}
                    </a>
                @else
                    Ninguno
                @endif
            </p> --}}
            <div class="mt-4 text-center">
                <a href="{{ route('componente.edit', ['planEstudio' => $planEstudio, 'componente' => $componente]) }}" class="btn btn-primary mb-2"><i class="fas fa-edit"></i> Modificar información</a>
                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash"></i> Eliminar Componente
                </button>
            </div>
        </x-slot>
        <x-slot:asideCardFooter><x-app.boton-regresar route="planEstudio.show" :params="['planEstudio' => $planEstudio]" /></x-slot:asideCardFooter>

    </x-layout.two-column-cards>
@endsection

@pushOnce('modals')
    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Componente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar el componente {{ $componente->nombre }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('componente.destroy', ['planEstudio' => $planEstudio, 'componente' => $componente]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endPushOnce