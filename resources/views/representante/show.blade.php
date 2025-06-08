<!-- Order your soul. Reduce your wants. - Augustine -->

@extends('layouts.app')

@section('subtitle', 'Datos del Representante')

@section('content_header_title', 'Representantes')
@section('content_header_subtitle', 'Ver')
w
@section('content_body')
    <div class="row">
        <div class="col-md-10 col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Información Detallada del Representante">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="d-flex justify-content-center">
                            @if($representante->fotoPerfilPath && Storage::disk('public')->exists($representante->fotoPerfilPath))
                                <img src="{{ Storage::url($representante->fotoPerfilPath) }}" alt="Foto Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 150px; height: 150px;">
                                    <span class="text-muted">Sin foto</span>
                                </div>
                            @endif
                        </div>
                        <h5>{{ $representante->nombreCompleto }}</h5>
                        <p class="text-muted">{{ $representante->email }}</p>
                        <hr>
                        <div>
                            <small class="text-muted">Registrado: {{ $representante->fechaCreado ? $representante->fechaCreado->format('d/m/Y H:i A') : 'N/A' }}</small><br>
                            <small class="text-muted">Últ. Modificación: {{ $representante->fechaModificado ? $representante->fechaModificado->format('d/m/Y H:i A') : 'N/A' }}</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Cédula de Identidad</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $representante->letraCedula->letra ?? 'N/A' }}-{{ $representante->cedulaNumero }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Género</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $representante->genero->descripcion ?? 'N/A' }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Fecha de Nacimiento</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $representante->fechaNacimiento ? $representante->fechaNacimiento->format('d/m/Y') : 'N/A' }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Dirección</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $representante->direccion }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Teléfono Principal</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $representante->telefonoPrincipal }}</dd>

                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Teléfono Secundario</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $representante->telefonoSecundario ?: 'No registrado' }}</dd>

                            @if($representante->cedulaPath && Storage::disk('public')->exists($representante->cedulaPath))
                                <dt class="col-sm-4 col-md-3"><small class="text-muted">Cédula Escaneada</small></dt>
                                <dd class="col-sm-8 col-md-9">
                                    <a href="{{ Storage::url($representante->cedulaPath) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-file-alt"></i> Ver Documento
                                    </a>
                                </dd>
                            @endif
                        </dl>

                        <hr>
                        <h5>Estudiantes Representados</h5>
                        @if($representante->estudiantes && $representante->estudiantes->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($representante->estudiantes as $estudiante)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('estudiante.show', $estudiante->id) }}">{{ $estudiante->nombreCompleto }}</a>
                                        @if($estudiante->pivot->representantePrincipal)
                                            <span class="badge badge-primary">Representante Principal</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Este representante no tiene estudiantes asociados.</p>
                        @endif

                        <div class="mt-4 text-center">
                            <a href="{{ route('representante.edit', $representante) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar</a>
                            <a href="{{ route('representante.reporte.show', $representante) }}" class="printWindow btn btn-secondary"><i class="fas fa-print"></i> Imprimir</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <a href="{{ route('representante.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
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
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Representante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar al representante <strong>{{ $representante->nombreCompleto }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('representante.destroy', $representante) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endPushOnce
