<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->

@extends('layouts.app')

@section('subtitle', 'Instituciones')

@section('content_header_title', 'Datos de la institución')

@section('content_body')
    @if($institucion)
        <div class="row">
            <div class="col-md-8">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Datos de la institución">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ratio ratio-1x1 mb-3">
                                @if($institucion->logoPath)
                                    <img src="{{ $institucion->logoPath }}" alt="Logo" class="img-fluid">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 100%; padding-bottom: 0; position: relative;">
                                        <div style="width: 100%; padding-bottom: 100%;"></div>
                                        <span class="text-muted" style="position: absolute;">Sin imagen</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8 d-flex flex-column justify-content-between pb-2">
                            <dl class="row">
                                <dt class="col-md-3"><small class="text-muted">Nombre</small></dt>
                                <dd class="col-md-9">
                                    <div class="form-control-plaintext border rounded px-2">{{ $institucion->nombre }}</div>
                                </dd>
                                <dt class="col-md-3"><small class="text-muted">RIF</small></dt>
                                <dd class="col-md-9">
                                    <div class="form-control-plaintext border rounded px-2">{{ $institucion->letraRif }}-{{ $institucion->numeroRif }}</div>
                                </dd>
                                <dt class="col-md-3"><small class="text-muted">Teléfono</small></dt>
                                <dd class="col-md-9">
                                    <div class="form-control-plaintext border rounded px-2">{{ $institucion->telefono }}</div>
                                </dd>
                                <dt class="col-md-3"><small class="text-muted">Dirección</small></dt>
                                <dd class="col-md-9">
                                    <div class="form-control-plaintext border rounded px-2">{{ $institucion->direccion }}</div>
                                </dd>
                            </dl>
                            <div>
                                <div class="text-center">
                                    <a href="{{ route('institucion.modificar') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar institución</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-slot name="footerSlot">
                        <div class="row">
                            <div class="col-sm-12">
                                <small class="text-muted">Fecha de última modificación: {{ date('d/m/Y h:i A', strtotime($institucion->fechaModificacion)) }}</small>
                            </div>
                        </div>
                    </x-slot>
                </x-adminlte-card>
            </div>
            <div class="col-md-4">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Métodos de calificación">
                    <h6>Método cuantitativo</h6>
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted">Calificación Mínima</small></dt>
                        <dd class="col-md-9 d-inline-flex align-items-center">
                            <div class="h6 mb-0" style="vertical-align: middle;">{{$institucion->configuracion->calificacionNumericaMinima}}</div>
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Máxima</small></dt>
                        <dd class="col-md-9 d-inline-flex align-items-center">
                            <div class="h6 mb-0" style="vertical-align: middle;">{{$institucion->configuracion->calificacionNumericaMaxima}}</div>
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Aprobatoria</small></dt>
                        <dd class="col-md-9 d-inline-flex align-items-center">
                            <div class="h6 mb-0" style="vertical-align: middle;">{{$institucion->configuracion->calificacionNumericaAprobatoria}}</div>
                        </dd>
                    </dl>
                    <h6>Método cualitativo</h6>
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted">Literales</small></dt>
                        <dd class="col-md-9">
                            <ul class="list-group">
                                @foreach ($institucion->configuracion->calificacionCualitativaLiterales as $literal)
                                    <li class="list-group-item">{{$literal->literal}} ({{$literal->descripcion}})</li>
                                @endforeach
                            </ul>
                        </dd>

                        <dt class="col-md-3"><small class="text-muted">Calificación Aprobatoria</small></dt>
                        <dd class="col-md-9 d-inline-flex align-items-center">
                            <div class="h6 mb-0" style="vertical-align: middle;">{{$institucion->configuracion->calificacionCualitativaAprobatoria}}</div>
                        </dd>
                    </dl>
                    <div>
                        <div class="text-center">
                            <a href="{{ route('institucion.modificar.calificacion') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Modificar métodos de calificación</a>
                        </div>
                    </div>
                    <x-slot name="footerSlot">
                        <div class="row">
                            <div class="col-sm-12">
                                <small class="text-muted">Fecha de última modificación: {{ date('d/m/Y h:i A', strtotime($institucion->fechaModificacion)) }}</small>
                            </div>
                        </div>
                    </x-slot>
                </x-adminlte-card>
            </div>
        </div>
    @else
        <x-adminlte-card theme="info" title="Información" icon="fas fa-exclamation-triangle">
            <h1 class="display-4">No se ha creado una configuración todavía.</h1>
            <p class="lead">Por favor, haga clic en el botón a continuación para crear una nueva institución.</p>
            <hr class="my-4">
            <a class="btn btn-primary btn-lg" href="{{ route('institucion.crear') }}" role="button">Crear nueva institución</a>
        </x-adminlte-card>
    @endif
    
@endsection

@push('js')
@endpush
