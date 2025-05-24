<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)

@section('subtitle', 'Instituciones')

@section('content_header_title', 'Institución')

@section('content_header_subtitle', 'Modificar institución')

@section('content_body')
    <form method="POST" action="{{ route('institucion.update') }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 mx-auto">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Datos de la institución">
                    <div class="d-flex flex-column justify-content-between pb-2">
                        <dl class="row">
                            <dt class="col-md-3"><small class="text-muted">Nombre</small></dt>
                            <dd class="col-md-9">
                                <x-adminlte-input name="nombre" class="border rounded px-2" required value="{!! $institucion->nombre !!}" />
                            </dd>
                            <dt class="col-md-3"><small class="text-muted">RIF</small></dt>
                            <dd class="col-md-9 row">
                                <div class="col-4">
                                    <x-form.letra-rif selected="{{$institucion->letraCedula->letra}}" />
                                </div>
                                <div class="col px-0">
                                    <x-adminlte-input name="numeroRif" class="border rounded px-2" required data-inputmask="'mask': '999999999'" value="{{$institucion->numeroRif}}" />
                                </div>
                            </dd>
                            <dt class="col-md-3"><small class="text-muted">Teléfono</small></dt>
                            <dd class="col-md-9">
                                <x-adminlte-input name="telefono" class="border rounded px-2" required data-inputmask="'mask': '+58 999-9999999'" value="{{$institucion->telefono}}" />
                            </dd>
                            <dt class="col-md-3"><small class="text-muted">Logo de la institución</small></dt>
                            <dd class="col-md-9">
                                <x-adminlte-input-file name="logo" accept="image/*" />
                            </dd>
                        </dl>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar cambios</button>
                    </div>
                    <x-slot name="footerSlot">
                        <a href="{{ route('institucion.show') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </x-slot>
                </x-adminlte-card>
            </div>
        </div>
    </form>
@endsection