<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@extends('layouts.app')

@section('subtitle', 'Información del componente '.$planEstudio->nombre)

@section('content_header_title', 'Componentes')
@section('content_header_subtitle', $planEstudio->nombre.' > '.$componente->nombre)

@section('content_body')
    <div class="row">
        <div class="col-md-10 col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Materias de {{$componente->nombre}}">
                <section>
                    <a href="{{route('materia.create', ['planEstudio' => $planEstudio, 'componente' => $componente])}}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Añadir materia
                    </a>
                    <div class="border rounded">
                        @if($componente->materias && $componente->materias->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($componente->materias as $materia)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('materia.show', ['planEstudio' => $planEstudio, 'componente' => $componente, 'materia' => $materia]) }}">{{ $materia->nombre }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mb-0 py-3 text-center text-muted">No hay materias creadas.</p>
                        @endif
                    </div>
                </section>
            </x-adminlte-card>
        </div>
        <div class="col-md-10 col-xl-4 mx-auto">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title">Sobre el componente</h3>
                </div>
                <div class="card-body">
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
                </div>
                <div class="card-footer">
                    <a href="{{ route('planEstudio.show', $planEstudio) }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                </div>
            </div>
        </div>
    </div>
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