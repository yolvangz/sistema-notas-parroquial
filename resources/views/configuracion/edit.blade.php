<!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)

@section('subtitle', 'Modificar la configuración')

@section('content_header_title', 'Institución')

@section('content_header_subtitle', 'Modificar la configuración')

@php
    $referencias = [
        'calificacionCualitativaAprobatoria' => $configuracion->calificacionCualitativaAprobatoria
    ];
@endphp

@section('content_body')
    <form method="POST" action="{{ route('institucion.configuracion.update') }}">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 mx-auto">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Métodos de calificación">
                    <h6>Método cuantitativo</h6>
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted">Calificación Mínima</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte-input 
                                name="calificacionNumericaMinima" 
                                type="number" 
                                min="0" 
                                max="100" 
                                step="0.01" 
                                class="border rounded px-2" 
                                required
                                value="{{ $configuracion->calificacionNumericaMinima }}"
                            />
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Máxima</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte-input 
                                name="calificacionNumericaMaxima" 
                                type="number" 
                                min="0" 
                                max="100" 
                                step="0.01" 
                                class="border rounded px-2" 
                                required
                                value="{{ $configuracion->calificacionNumericaMaxima }}"
                            />
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Aprobatoria</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte-input 
                                name="calificacionNumericaAprobatoria" 
                                type="number" 
                                min="0" 
                                max="100" 
                                step="0.01" 
                                class="border rounded px-2" 
                                required
                                value="{{ $configuracion->calificacionNumericaAprobatoria }}"
                            />
                        </dd>
                    </dl>
                    <h6>Método cualitativo</h6>
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted">Literales</small></dt>
                        <dd class="col-md-9">
                            <x-form.literales-input :$referencias :literales="$configuracion->calificacionCualitativaLiterales" />
                        </dd>


                        <dt class="col-md-3"><small class="text-muted">Calificación Aprobatoria</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte-select2 
                                id="calificacionCualitativaAprobatoria" 
                                name="calificacionCualitativaAprobatoria" 
                                class="border rounded px-2" 
                                placeholder="Seleccione un literal"
                                required
                            >
                            </x-adminlte-select2>
                        </dd>
                    </dl>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar datos</button>
                    </div>
                    <x-slot name="footerSlot">
                        <a href="{{ route('institucion.show') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </x-slot>
                </x-adminlte-card>
            </div>
        </div>
    </form>
@endsection