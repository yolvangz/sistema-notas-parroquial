<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)

@section('subtitle', 'Modificar la institución')

@section('content_header_title', 'Institución')

@section('content_header_subtitle', 'Modificar la institución')

@php
    $logoFilename = pathinfo($institucion->logoPath)['basename'];
@endphp

@section('content_body')
    <form method="POST" action="{{ route('institucion.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-layout.two-column-cards>
            <x-slot:mainCardTitle>Datos de la institución</x-slot:mainCardTitle>
            <div class="d-flex flex-column justify-content-between pb-2">
                <dl class="row">
                    <dt class="col-md-3"><small class="text-muted">Nombre</small></dt>
                    <dd class="col-md-9">
                        <x-adminlte.form.input name="nombre" class="border rounded px-2" required value="{{$institucion->nombre}}" />
                    </dd>
                    <dt class="col-md-3"><small class="text-muted">RIF</small></dt>
                    <dd class="col-md-9 row">
                        <div class="col-4">
                            <x-form.letra-documento name="letraRif" id="letraRif" :selected="$institucion->letraRif" />
                        </div>
                        <div class="col px-0">
                            <x-adminlte.form.input name="numeroRif" class="border rounded px-2" required data-inputmask="'mask': '999999999'" value="{{$institucion->numeroRif}}" />
                        </div>
                    </dd>
                    <dt class="col-md-3"><small class="text-muted">Teléfono</small></dt>
                    <dd class="col-md-9">
                        <x-form.input-telefono name="telefono" id="telefono" required value="{{ $institucion->telefono }}" />
                    </dd>
                    <dt class="col-md-3"><small class="text-muted">Dirección</small></dt>
                    <dd class="col-md-9">
                        <x-adminlte-textarea name="direccion" rows=3 required class="border rounded px-2">{{ $institucion->direccion }}</x-adminlte-textarea>
                    </dd>
                    <dt class="col-md-3"><small class="text-muted">Logo de la institución</small></dt>
                    <dd class="col-md-9">
                        <x-adminlte-input-file name="logo" accept="image/*" legend="Buscar imagen" />
                    </dd>
                    </dd>
                </dl>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar cambios</button>
            </div>
            <x-slot:mainCardFooter>
                <x-app.boton-regresar route="institucion.show" />
            </x-slot:mainCardFooter>
        </x-layout.two-column-cards>
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init()
            })
    </script>
@endpush