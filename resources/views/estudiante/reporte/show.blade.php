<!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->

@extends('layouts.reporte')

@section('reporte_title', 'Ficha de Estudiante '.$estudiante->nombreCompleto)

@section('reporte_titulo', 'Ficha de Estudiante')

@section('reporte_contenido')
    <div class="row">
        <div class="col-4">
            <div class="d-flex justify-content-center">
                @if($estudiante->fotoPerfilPath && Storage::disk('public')->exists($estudiante->fotoPerfilPath))
                    <img src="{{ Storage::url($estudiante->fotoPerfilPath) }}" alt="Foto Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 300px; height: 300px;">
                        <span class="text-muted">Sin foto</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-8">
            <dl class="row">
                <div class="col">
                    <dt class="h5">Nombres:</dt>
                    <dd>{{$estudiante->nombres}}</dd>
                    <dt class="h5">Apellidos:</dt>
                    <dd>{{$estudiante->apellidos}}</dd>
                    <dt class="h5">Cédula de Identidad:</dt>
                    <dd>{{$estudiante->letraCedula->letra}}-{{$estudiante->cedulaNumero}}</dd>
                    <dt class="h5">Género:</dt>
                    <dd>{{$estudiante->genero->descripcion}}</dd>
                </div>
                <div class="col">
                    <dt class="h5">Fecha de Nacimiento:</dt>
                    <dd>{{$estudiante->fechaNacimiento->format('d/m/Y')}}</dd>
                    <dt class="h5">Fecha de Registro:</dt>
                    <dd>{{$estudiante->fechaCreado->format('d/m/Y')}}</dd>
                    <dt class="h5">Dirección:</dt>
                    <dd>{{$estudiante->direccion}}</dd>
                </div>
            </dl>
        </div>
    </div>
    <h4>Representantes del estudiante</h4>
    <hr>
    <dl class="row mt-2 representantes-section">
        @forelse ($estudiante->representantes as $representante)
            <div class="col-6">
                <div class="border rounded p-2 mx-1 row">
                    <div class="col-4 mr-1">
                        @if($representante->fotoPerfilPath && Storage::disk('public')->exists($representante->fotoPerfilPath))
                            <img src="{{ Storage::url($representante->fotoPerfilPath) }}" alt="Foto Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 150px; height: 150px;">
                                <span class="text-muted">Sin foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <dt>Nombres:</dt>
                        <dd>{{$representante->nombres}}</dd>
                        <dt>Apellidos:</dt>
                        <dd>{{$representante->apellidos}}</dd>
                        <dt>Cédula de Identidad:</dt>
                        <dd>{{$representante->letraCedula->letra}}-{{$representante->cedulaNumero}}</dd>
                        <dt>Fecha de Nacimiento:</dt>
                        <dd>{{$estudiante->fechaNacimiento->format('d/m/Y')}}</dd>
                    </div>
                    <div class="col">
                        <dt>Dirección:</dt>
                        <dd>{{$estudiante->direccion}}</dd>
                        <dt>Teléfonos:</dt>
                        <dd>{{$representante->telefonoPrincipal}}
                            @if($representante->telefonoSecundario)
                                <br>{{$representante->telefonoSecundario}}
                            @endif
                        </dd>
                        <dt>Correo Electrónico</dt>
                        <dd>{{$representante->email}}</dd>
                        @if ($representante->pivot->representantePrincipal)
                        <dt class="badge badge-light badge-sm">Representante Principal</dt>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><p class="text-muted text-center">No tiene representantes asociados.</p></div>
        @endforelse
    </dl>
@endsection

@push('css')
    <style>
        .representantes-section {
            font-size: 0.85rem;
        }
        .representantes-section dt {
            font-weight: 500;
            font-size: 1.25em;
        }
        .representantes-section dt.badge {
            font-size: 0.883em;
        }
    </style>
@endpush