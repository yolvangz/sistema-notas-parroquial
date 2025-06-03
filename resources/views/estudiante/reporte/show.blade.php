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
                    <dt class="h5">Fecha de Nacimiento:</dt>
                    <dd>{{$estudiante->fechaNacimiento->format('d/m/Y')}}</dd>
                    <dt class="h5">Fecha de Registro:</dt>
                    <dd>{{$estudiante->fechaCreado->format('d/m/Y')}}</dd>
                </div>
                <div class="col">
                    <dt class="h5">Género:</dt>
                    <dd>{{$estudiante->genero->descripcion}}</dd>
                    <dt class="h5">Dirección:</dt>
                    <dd>{{$estudiante->direccion}}</dd>
                </div>
            </dl>
        </div>
    </div>
    <hr>
@endsection
