<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)

@section('subtitle', 'Instituciones')

@section('content_header_title', 'Institución')

@section('content_header_subtitle', 'Crear nueva institución')

@php
    $referencias = [
        'calificacionCualitativaAprobatoria' => ''
    ];    
@endphp

@section('content_body')
    <form method="POST" action="{{ route('institucion') }}" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Datos de la institución">
                    <div class="d-flex flex-column justify-content-between pb-2">
                        <dl class="row">
                            <dt class="col-md-3"><small class="text-muted">Nombre</small></dt>
                            <dd class="col-md-9">
                                <x-adminlte.form.input name="nombre" class="border rounded px-2" required/>
                            </dd>
                            <dt class="col-md-3"><small class="text-muted">RIF</small></dt>
                            <dd class="col-md-9 row">
                                <div class="col-4">
                                    <x-form.letra-rif />
                                </div>
                                <div class="col px-0">
                                    <x-adminlte.form.input name="numeroRif" class="border rounded px-2" required data-inputmask="'mask': '9999999999'"/>
                                </div>
                            </dd>
                            <dt class="col-md-3"><small class="text-muted">Teléfono</small></dt>
                            <dd class="col-md-9">
                                <x-adminlte.form.input name="telefono" class="border rounded px-2" required data-inputmask="'mask': '+58 999-9999999'"/>
                            </dd>
                            <dt class="col-md-3"><small class="text-muted">Logo de la institución</small></dt>
                            <dd class="col-md-9">
                                <x-adminlte-input-file name="logo" accept="image/*" />
                            </dd>
                        </dl>
                    </div>                    
                </x-adminlte-card>
            </div>
            <div class="col-md-6">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Métodos de calificación">
                    <h6>Método cuantitativo</h6>
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted">Calificación Mínima</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input 
                                name="calificacionNumericaMinima" 
                                type="number" 
                                min="0" 
                                max="100" 
                                step="0.01" 
                                class="border rounded px-2" 
                                required 
                            />
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Máxima</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input 
                                name="calificacionNumericaMaxima" 
                                type="number" 
                                min="0" 
                                max="100" 
                                step="0.01" 
                                class="border rounded px-2" 
                                required 
                            />
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Aprobatoria</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input 
                                name="calificacionNumericaAprobatoria" 
                                type="number" 
                                min="0" 
                                max="100" 
                                step="0.01" 
                                class="border rounded px-2" 
                                required 
                            />
                        </dd>
                    </dl>
                    <h6>Método cualitativo</h6>
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted">Literales</small></dt>
                        <dd class="col-md-9">
                            <x-form.literales-input :$referencias />
                        </dd>


                        <dt class="col-md-3"><small class="text-muted">Calificación Aprobatoria</small></dt>
                        <dd class="col-md-9">
                            <x-adminlte-select 
                                id="calificacionCualitativaAprobatoria" 
                                name="calificacionCualitativaAprobatoria" 
                                class="border rounded px-2" 
                                placeholder="Seleccione un literal"
                                required
                            >
                            </x-adminlte-select>
                        </dd>
                    </dl>
                </x-adminlte-card>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar institución</button>
        </div>
    </form>
@endsection