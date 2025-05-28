<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@extends('layouts.app')

@section('subtitle', 'Información del plan "{{ $planEstudio->nombre }}"')

@section('content_header_title', 'Planes de Estudio')
@section('content_header_subtitle', $planEstudio->nombre)

@section('content_body')
    <div class="row">
        <div class="col-md-10 col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Información Detallada del planEstudio">
                <div class="row">
                    <div class="col-md-4 text-center">
                        
                        <h5>{{ $planEstudio->nombre }}</h5>
                        <p class="text-muted">{{ $planEstudio->codigo }}</p>
                        <hr>
                        <div>
                            <small class="text-muted">Registrado: {{ $planEstudio->fechaCreado ? $planEstudio->fechaCreado->format('d/m/Y H:i A') : 'N/A' }}</small><br>
                            <small class="text-muted">Últ. Modificación: {{ $planEstudio->fechaModificado ? $planEstudio->fechaModificado->format('d/m/Y H:i A') : 'N/A' }}</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <dl class="row">
                            <dt class="col-sm-4 col-md-3"><small class="text-muted">Descripción</small></dt>
                            <dd class="col-sm-8 col-md-9">{{ $planEstudio->descripcion }}</dd>
                        </dl>

                        <hr>
                        {{-- <h5>Estudiantes Representados</h5>
                        @if($planEstudio->estudiantes && $planEstudio->estudiantes->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($planEstudio->estudiantes as $estudiante)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('estudiante.show', $estudiante->id) }}">{{ $estudiante->nombreCompleto }}</a>
                                        @if($estudiante->pivot->planEstudioPrincipal)
                                            <span class="badge badge-primary">Principal</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Este planEstudio no tiene estudiantes asociados.</p>
                        @endif --}}

                        <div class="mt-4 text-center">
                            <a href="{{ route('planEstudio.edit', $planEstudio) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar planEstudio</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i> Eliminar planEstudio
                            </button>
                        </div>
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <a href="{{ route('planEstudio.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection
