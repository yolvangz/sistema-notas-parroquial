<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->

@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)

@section('subtitle', 'Crear Representante')

@section('content_header_title', 'Representantes')
@section('content_header_subtitle', 'Nuevo representante')

@php
    $letraCedulaModel = App\Models\LetraCedula::where('letra', old('cedulaLetra'))->first();
@endphp

@section('content_body')
    <x-layout.two-column-cards>
        <x-slot:mainCardTitle>Datos Personales del Representante</x-slot:mainCardTitle>
        <form method="POST" action="{{ route('representante.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombres">Nombres</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombres" placeholder="Nombres del representante" maxlength="100" required value="{{ old('nombres') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="apellidos">Apellidos</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="apellidos" placeholder="Apellidos del representante" maxlength="100" required value="{{ old('apellidos') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="cedulaNumero">Cédula de Identidad</label></small></div>
                <div class="col-sm-8 col-md-9">
                    <div class="d-flex flex-nowrap">
                        <div class="w-25">
                            <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" :selected="$letraCedulaModel" />
                        </div>
                        <div class="ml-2 flex-grow-1">
                            <x-adminlte.form.input name="cedulaNumero" placeholder="Número de cédula" fgroup-class="flex-grow-1" data-inputmask="'mask': '9{7,9}'" required value="{{ old('cedulaNumero') }}" />
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="genero">Género</label></small></div>
                <div class="col-sm-8 col-md-9"><x-form.genero required selected="{{ old('genero') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="fechaNacimiento">Fecha de Nacimiento</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="fechaNacimiento" type="date" required value="{{ old('fechaNacimiento') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="direccion">Dirección</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="direccion" type="text" placeholder="Dirección" required value="{{ old('direccion') }}" /></div>

                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="email">Correo Electrónico</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="email" type="email" placeholder="Correo Electrónico" required value="{{ old('email') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="telefonoPrincipal">Teléfono Principal</label></small></div>
                <div class="col-sm-8 col-md-9"><x-form.input-telefono name="telefonoPrincipal" id="telefonoPrincipal" required value="{{ old('telefonoPrincipal') }}" /></div>

                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="telefonoSecundario">Teléfono Secundario (opcional)</label></small></div>
                <div class="col-sm-8 col-md-9"><x-form.input-telefono name="telefonoSecundario" id="telefonoSecundario" value="{{ old('telefonoSecundario') }}" /></div>
            </div>
            <div class="text-center">
                <x-adminlte-button type="submit" label="Crear Representante" theme="primary" icon="fas fa-lg fa-save"/>
            </div>
        </form>
        <x-slot:mainCardFooter>
            <x-app.boton-regresar route="representante.index" />
        </x-slot:mainCardFooter>
        {{-- <x-slot:asideCardTitle>Añadir estudiantes al Representante</x-slot:asideCardTitle>
        <x-slot:aside>
            <x-adminlte.form.input name="" id="buscarEstudiante" type="search" placeholder="Buscar Estudiante" class="form-control">
                <x-slot name="appendSlot">
                    <div class="input-group-text">
                        <i class="fas fa-search"></i>
                    </div>
                </x-slot>
            </x-adminlte.form.input>
            <hr>
            <div id="listaEstudiantes" class="d-flex flex-column">
                <span class="text-center text-muted">Buscar estudiantes aquí</span>
            </div>
        </x-slot:aside> --}}
    </x-layout.two-column-cards>
@endsection