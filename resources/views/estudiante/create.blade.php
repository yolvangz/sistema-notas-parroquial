<!-- The only way to do great work is to love what you do. - Steve Jobs -->
@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)

@section('subtitle', 'Crear Estudiante')

@section('content_header_title', 'Estudiantes')
@section('content_header_subtitle', 'Nuevo Estudiante')

@php
    $letraCedulaModel = App\Models\LetraCedula::where('letra', old('cedulaLetra'))->first();
@endphp

@section('content_body')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Datos Personales del Estudiante">
                <form method="POST" action="{{ route('estudiante.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombres">Nombres</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombres" placeholder="Nombres del estudiante" maxlength="100" required value="{{ old('nombres') }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="apellidos">Apellidos</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="apellidos" placeholder="Apellidos del estudiante" maxlength="100" required value="{{ old('apellidos') }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="cedulaNumero">Cédula de Identidad <br>(si se deja vacío se generará una cédula escolar automatizada)</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <div class="d-flex flex-nowrap">
                                <div class="w-25">
                                    <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" :selected="$letraCedulaModel" />
                                </div>
                                <div class="ml-2 flex-grow-1">
                                    <x-adminlte.form.input name="cedulaNumero" placeholder="Número de cédula" fgroup-class="flex-grow-1" data-inputmask="'mask': '9{7,10}'" required value="{{ old('cedulaNumero') }}" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="genero">Género</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-form.genero required selected="{{ old('genero') }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="fechaNacimiento">Fecha de Nacimiento</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="fechaNacimiento" type="date" required value="{{ old('fechaNacimiento') }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="direccion">Dirección</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="direccion" type="text" placeholder="Dirección" required value="{{ old('direccion') }}" /></div>
                    </div>
                    <div class="text-center">
                        <x-adminlte-button type="submit" label="Crear estudiante" theme="primary" icon="fas fa-lg fa-save"/>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <a href="{{ route('estudiante.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-xl-4 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline" title="Añadir representantes al Estudiante">
                <x-adminlte.form.input name="" id="buscarRepresentante" type="search" placeholder="Buscar Representante" class="form-control">
                    <x-slot name="appendSlot">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </x-slot>
                </x-adminlte.form.input>
                <hr>
                <div id="listaRepresentantes" class="d-flex flex-column">
                    <span class="text-center text-muted">Buscar representantes aquí</span>
                </div>
            </x-adminlte-card>
        </div>
    </div>
@endsection