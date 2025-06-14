<!-- resources/views/profesor/show.blade.php -->

@extends('layouts.app')

@section('subtitle', 'Datos del profesor')

@section('content_header_title', 'Profesores')
@section('content_header_subtitle', 'Ver')

@section('content_body')
    <x-layout.two-column-cards>
        <x-slot:mainCardTitle>Información del Profesor</x-slot>
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex justify-content-center align-items-center mb-3" style="max-width:500px;">
                    @if($profesor->fotoPerfilPath)
                        <img src="{{ Storage::url($profesor->fotoPerfilPath) }}" alt="Foto Perfil" class="img-fluid ratio ratio-3x4">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="width: 100%; padding-bottom: 0; position: relative;">
                            <div style="width: 100%; padding-bottom: 100%;"></div>
                            <span class="text-muted" style="position: absolute;">Sin imagen</span>
                        </div>
                    @endif
                </div>
                <div>
                    <small class="text-muted">Fecha de Creación: {{ $profesor->fechaCreado->format('d/m/Y h:i A') }}</small>
                    <br>
                    <small class="text-muted">Última Modificación: {{ $profesor->fechaModificado->format('d/m/Y h:i A') }}</small>
                </div>
            </div>
            <div class="col-md-8">
                <dl class="row">
                    <dt class="col-md-3"><small class="text-muted">Nombre Completo</small></dt>
                    <dd class="col-md-9">{{ $profesor->nombreCompleto }}</dd>
                    <dt class="col-md-3"><small class="text-muted">Identificación</small></dt>
                    <dd class="col-md-9">{{ $profesor->letraCedula->letra }}-{{ $profesor->cedulaNumero }}</dd>
                    <dt class="col-md-3"><small class="text-muted">Género</small></dt>
                    <dd class="col-md-9">
                        @switch($profesor->genero->letra)
                            @case('M')
                                Masculino
                                @break
                            @case('F')
                                Femenino
                                @break
                        @endswitch
                    </dd>
                    <dt class="col-md-3"><small class="text-muted">Teléfono</small></dt>
                    <dd class="col-md-9">{{ $profesor->telefonoPrincipal }}</dd>
                    <dt class="col-md-3"><small class="text-muted">Correo</small></dt>
                    <dd class="col-md-9">{{ $profesor->email }}</dd>
                    <dt class="col-md-3"><small class="text-muted">Dirección</small></dt>
                    <dd class="col-md-9">{{ $profesor->direccion }}</dd>
                    <dt class="col-md-3"><small class="text-muted">Fecha de Nacimiento</small></dt>
                    <dd class="col-md-9">{{ $profesor->fechaNacimiento->format('d/m/Y') }}</dd>
                    <dt class="col-md-3"><small class="text-muted">Fecha de Ingreso</small></dt>
                    <dd class="col-md-9">{{ $profesor->fechaIngreso->format('d/m/Y') }}</dd>
                </dl>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar Profesor</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Eliminar Profesor
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <x-slot:mainCardFooter>
            <x-app.boton-regresar route="profesor.index" />
        </x-slot>
    </x-layout.two-column-cards>
@endsection

@pushOnce('modals')
    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar al profesor {{ $profesor->nombreCompleto }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('profesor.destroy', $profesor) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endPushOnce