<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->

@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInp`ut', true)

@section('subtitle', 'Crear Profesor')

@section('content_header_title', 'Profesores')

@section('content_header_subtitle', 'crear nuevo')


@section('content')
    <form method="POST" action="{{ route('profesor.store') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Datos del Profesor">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <x-adminlte.form.input label="Nombres" name="nombres" id="nombres" class="px-2" maxlength="100" required/>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <x-adminlte.form.input label="Apellidos" name="apellidos" id="apellidos" class="px-2" maxlength="100" required/>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="cedulaLetra">Cédula de Identidad</label>
                            <div class="d-flex flex-nowrap">
                                <div class="w-25">
                                    <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" />
                                </div>
                                <div class="ml-2 flex-grow-1">
                                    <x-adminlte.form.input type="text" name="cedulaNumero" id="cedulaNumero" class="px-2" data-inputmask="'mask': '9{7,15}'" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <x-form.genero label="Género" required />
                        </div>
                        <div class=".col-md-6 col-lg-4">
                            <x-form.input-telefono label="Teléfono Principal" class="px-2" name="telefonoPrincipal" id="telefonoPrincipal" required />
                        </div>
                        <div class=".col-md-6 col-lg-4">
                            <label for="telefonoSecundario">Teléfono Secundario</label>
                            <x-form.input-telefono class="px-2" name="telefonoSecundario" id="telefonoSecundario" />
                        </div>
                        <div class=".col-md-6 col-lg-4">
                            <x-adminlte.form.input label="Correo Electrónico" type="email" name="email" id="email" class="px-2" required/>
                        </div>
                        <div class=".col-md-6 col-lg-4">
                            <x-adminlte.form.input label="Dirección" type="text" name="direccion" id="direccion" class="px-2" required/>
                        </div>
                        <div class=".col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                            </div>
                        </div>
                        <div class=".col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="fechaIngreso">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso" required>
                            </div>
                        </div>
                    </div>
                    <x-slot name="footerSlot">
                        <a href="{{ route('profesor.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Regresar</a>
                    </x-slot>
                </x-adminlte-card>
            </div>
            {{-- <div class="col-lg-4">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Documentos subidos del Profesor">
                    <x-adminlte-input-file label="Foto Carnet" name="fotoPerfilPath" accept="image/*" legend="Buscar imagen" />
                    <x-adminlte-input-file label="Cedula Escaneada" name="cedulaPath" accept="image/*" legend="Buscar imagen" />
                    <x-adminlte-input-file label="Registro del Rif" name="registroRifPath" accept=".pdf" legend="Buscar archivo" />
                </x-adminlte-card>
            </div> --}}
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Crear Profesor</button>
        </div>
    </form>
@endsection