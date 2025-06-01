<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@extends('layouts.app')

@section('subtitle', 'Información del plan '.$planEstudio->nombre)

@section('content_header_title', 'Planes de Estudio')
@section('content_header_subtitle', $planEstudio->nombre)

@section('content_body')
    <div class="row">
        <div class="col-md-10 col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Componentes de {{$planEstudio->nombre}}">
                <section>
                    <a href="{{route('componente.create', ['planEstudio' => $planEstudio])}}" class="btn btn-success mb-3">
                        <i class="fas fa-plus"></i> Añadir componente
                    </a>
                    <div class="border rounded">
                        @if($planEstudio->componentes && $planEstudio->componentes->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($planEstudio->componentes as $componente)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('componente.show', ['planEstudio' => $planEstudio, 'componente' => $componente]) }}">{{ $componente->nombre }}</a>
                                        <span class="badge bg-primary">{{ $componente->materias->count() }} {{ Str::plural('materia', $componente->materias->count()) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="mb-0 py-3 text-center text-muted">No hay componentes creados.</p>
                        @endif
                    </div>
                </section>
            </x-adminlte-card>
        </div>
        <div class="col-md-10 col-xl-4 mx-auto">
            <div class="card card-dark card-outline">
                <div class="card-header">
                    <h3 class="card-title">Sobre el plan de estudio</h3>
                </div>
                <div class="card-body">
                    <p class="text-center">{{$planEstudio->descripcion}}</p>
                    <p class="text-center"><small class="text-muted">Estado: </small>
                        @if($planEstudio->activo)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </p>
                    <p class="text-center">
                        <small class="text-muted">Registrado: {{ $planEstudio->fechaCreado ? $planEstudio->fechaCreado->format('d/m/Y h:i A') : 'N/A' }}</small><br>
                        <small class="text-muted">Últ. Modificación: {{ $planEstudio->fechaModificado ? $planEstudio->fechaModificado->format('d/m/Y h:i A') : 'N/A' }}</small>
                    </p>
                    <div class="mt-4 text-center">
                        <a href="{{ route('planEstudio.edit', $planEstudio) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar información</a>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('planEstudio.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
