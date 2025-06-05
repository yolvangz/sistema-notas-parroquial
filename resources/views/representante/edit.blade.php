<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->

@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)

@section('subtitle', 'Editar Representante')

@section('content_header_title', 'Representantes')
@section('content_header_subtitle', 'Editar Información')

@php
    $cedulaLetra = $representante->letraCedula ?? App\Models\LetraCedula::where('letra', old('cedulaLetra'))->first();
@endphp

@section('content_body')
    <form method="POST" action="{{ route('representante.update', $representante) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <x-adminlte-card theme="primary" theme-mode="outline" title="Datos Personales del Representante">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="nombres" label="Nombres" placeholder="Nombres del representante" fgroup-class="col-12" value="{{ old('nombres', $representante->nombres) }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="apellidos" label="Apellidos" placeholder="Apellidos del representante" fgroup-class="col-12" value="{{ old('apellidos', $representante->apellidos) }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <label for="cedulaLetra">Cédula de Identidad</label>
                            <div class="input-group">
                                <div style="max-width: 80px;">
                                     <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" :selected="$cedulaLetra" />
                                </div>
                                <x-adminlte-input name="cedulaNumero" placeholder="Número" fgroup-class="flex-grow-1" value="{{ old('cedulaNumero', $representante->cedulaNumero) }}" data-inputmask="'mask': '9{7,9}'" required/>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <x-form.genero required selected="{{old('genero', $representante->genero->letra)}}" />
                        </div>
                        <div class="col-md-6 col-lg-4">
                             <x-adminlte-input-date name="fechaNacimiento" label="Fecha de Nacimiento" placeholder="Seleccione fecha" fgroup-class="col-12" value="{{ old('fechaNacimiento', $representante->fechaNacimiento ? $representante->fechaNacimiento->format('Y-m-d') : '') }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                        </div>
                    </div>

                    <x-adminlte-input name="direccion" label="Dirección de Habitación" placeholder="Dirección completa" fgroup-class="col-12" value="{{ old('direccion', $representante->direccion) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="email" type="email" label="Correo Electrónico" placeholder="ejemplo@dominio.com" fgroup-class="col-12" value="{{ old('email', $representante->email) }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                         <div class="col-md-6">
                            <x-form.input-telefono label="Teléfono Principal" name="telefonoPrincipal" id="telefonoPrincipal" value="{{ old('telefonoPrincipal', $representante->telefonoPrincipal) }}" required />
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6">
                             <x-form.input-telefono label="Teléfono Secundario (Opcional)" name="telefonoSecundario" id="telefonoSecundario" value="{{ old('telefonoSecundario', $representante->telefonoSecundario) }}" />
                        </div>
                    </div>

                    {{-- <hr> --}}
                    {{-- <h5>Documentos</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input-file name="fotoPerfilPath" label="Foto de Perfil (Opcional)" placeholder="Seleccionar imagen..." legend="Buscar" fgroup-class="col-12" accept="image/*">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                            @if($representante->fotoPerfilPath && Storage::disk('public')->exists($representante->fotoPerfilPath))
                            <div class="mb-2">
                                <small>Actual: <a href="{{ Storage::url($representante->fotoPerfilPath) }}" target="_blank">Ver foto</a></small>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input-file name="cedulaPath" label="Cédula Escaneada (Opcional)" placeholder="Seleccionar archivo..." legend="Buscar" fgroup-class="col-12" accept="image/*,.pdf">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                             @if($representante->cedulaPath && Storage::disk('public')->exists($representante->cedulaPath))
                            <div class="mb-2">
                                <small>Actual: <a href="{{ Storage::url($representante->cedulaPath) }}" target="_blank">Ver documento</a></small>
                            </div>
                            @endif
                        </div>
                    </div> --}}


                    <x-slot name="footerSlot">
                        <a href="{{ route('representante.show', $representante) }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
                        <x-adminlte-button class="btn-flat" type="submit" label="Actualizar Representante" theme="success" icon="fas fa-lg fa-save"/>
                    </x-slot>
                </x-adminlte-card>
            </div>
        </div>
    </form>
@endsection