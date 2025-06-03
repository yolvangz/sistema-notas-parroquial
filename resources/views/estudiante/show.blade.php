    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->

@extends('layouts.app')

@section('subtitle', 'Datos del Estudiante')

@section('content_header_title', 'Estudiantes')
@section('content_header_subtitle', 'Ver')

@section('content_body')
    <div class="row">
        <div class="col-md-10 col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Información Detallada del Estudiante">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <div class="d-flex justify-content-center">
                            @if($estudiante->fotoPerfilPath && Storage::disk('public')->exists($estudiante->fotoPerfilPath))
                                <img src="{{ Storage::url($estudiante->fotoPerfilPath) }}" alt="Foto Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 150px; height: 150px;">
                                    <span class="text-muted">Sin foto</span>
                                </div>
                            @endif
                        </div>
                        <h5>{{ $estudiante->nombreCompleto }}</h5>
                        <hr>
                        <div>
                            <small class="text-muted">Registrado: {{ $estudiante->fechaCreado ? $estudiante->fechaCreado->format('d/m/Y H:i A') : 'N/A' }}</small><br>
                            <small class="text-muted">Últ. Modificación: {{ $estudiante->fechaModificado ? $estudiante->fechaModificado->format('d/m/Y H:i A') : 'N/A' }}</small>
                        </div>
                    </div>
                    <div class="col-md-7 d-flex flex-column justify-content-between">
                        <dl class="row">
                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Cédula de Identidad</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $estudiante->letraCedula->letra ?? 'N/A' }}-{{ $estudiante->cedulaNumero }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Género</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $estudiante->genero->descripcion ?? 'N/A' }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Fecha de Nacimiento</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $estudiante->fechaNacimiento ? $estudiante->fechaNacimiento->format('d/m/Y') : 'N/A' }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Dirección</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $estudiante->direccion }}</dd>

                            @if($estudiante->cedulaPath && Storage::disk('public')->exists($estudiante->cedulaPath))
                                <dt class="col-sm-4 col-md-3"><small class="text-muted">Cédula Escaneada</small></dt>
                                <dd class="col-sm-8 col-md-9">
                                    <a href="{{ Storage::url($estudiante->cedulaPath) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-file-alt"></i> Ver Documento
                                    </a>
                                </dd>
                            @endif
                        </dl>

                        {{-- <h5>Estudiantes Representados</h5>
                        @if($estudiante->estudiantes && $estudiante->estudiantes->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($estudiante->estudiantes as $estudiante)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('estudiante.show', $estudiante->id) }}">{{ $estudiante->nombreCompleto }}</a>
                                        @if($estudiante->pivot->estudiantePrincipal)
                                            <span class="badge badge-primary">Principal</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Este estudiante no tiene estudiantes asociados.</p>
                        @endif --}}

                        <div>
                            <hr>
                            <div class="mt-4 text-center">
                                <a href="{{ route('estudiante.edit', $estudiante) }}" class="btn btn-primary mb-1"><i class="fas fa-edit"></i> Modificar</a>
                                <button type="button" class="btn btn-danger mb-1" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                                <a href="{{ route('estudiante.reporte.show', $estudiante) }}" class="printWindow btn btn-secondary mb-1">
                                    <i class="fas fa-print"></i> Imprimir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <a href="{{ route('estudiante.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection

@pushOnce('modals')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar al estudiante <strong>{{ $estudiante->nombreCompleto }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('estudiante.destroy', $estudiante) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endPushOnce
