<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

@extends('layouts.app')

@section('subtitle', 'Información del plan '.$planEstudio->nombre)

@section('content_header_title', 'Planes de Estudio')
@section('content_header_subtitle', $planEstudio->nombre)

@php
    // dd($planEstudio->componentes);
@endphp

@section('content_body')
    <x-layout.two-column-cards>
        <x-slot:mainCardTitle>Componentes de {{$planEstudio->nombre}}</x-slot>
        <section>
            <a href="{{ route('componente.create', ['planEstudio' => $planEstudio]) }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Añadir componente
            </a>
            <ul class="list-group">
            @forelse($planEstudio->componentes as $componente)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('componente.show', ['planEstudio' => $planEstudio, 'componente' => $componente]) }}">{{ $componente->nombre }}</a>
                    <span class="badge bg-primary">{{ $componente->materias->count() }} {{ Str::plural('materia', $componente->materias->count()) }}</span>
                </li>
            @empty
                <li class="list-group-item">
                    <p class="mb-0 py-3 text-center text-muted">No hay componentes creados.</p>
                </li>
            @endif
            </ul>
        </section>
        <x-slot:asideCardTitle>Sobre el plan de estudio</x-slot>
        <x-slot:aside>
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
                        <a href="{{ route('planEstudio.reporte.show', $planEstudio) }}" class="printWindow btn btn-secondary"><i class="fas fa-print"></i> Imprimir</a>
                    </div>
        </x-slot>
        <x-slot:asideCardFooter>
            <x-app.boton-regresar route="planEstudio.index" />
        </x-slot>
    </x-layout.two-column-cards>
@endsection
