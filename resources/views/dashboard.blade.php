@extends('layouts.app')

@section('plugins.inputmask', true)

@section('subtitle', 'Inicio')

@section('content_header_title', 'Bienvenido')

@section('content_body')
    <x-adminlte-card title="Formulario de Datos Personales">
        <form>
            @csrf
            @method('POST')
            <x-adminlte-input label="Nombres" id="nombres" name="nombres" />
            <x-adminlte-input label="Apellidos" id="apellidos" name="apellidos" />
            <x-adminlte-input label="Dirección" id="direccion" name="direccion" />
            <x-adminlte-input label="Teléfono Principal" id="telefonoPrincipal" name="telefonoPrincipal" data-inputmask="'mask': '+57 999-9999999'" />
        </form>
    </x-adminlte-card>
@endsection