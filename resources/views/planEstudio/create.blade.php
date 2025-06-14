<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->

@extends('layouts.app')

@section('subtitle', 'Crear Plan de Estudio')

@section('content_header_title', 'Plan de Estudio')
@section('content_header_subtitle', 'Nuevo Plan de Estudio')

@section('content_body')
    <x-layout.two-column-cards>
        <form method="POST" action="{{ route('planEstudio.store') }}">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombre">Nombre del plan</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombre" placeholder="nombre del plan de estudio" maxlength="100" required value="{{ old('nombre') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="codigo">Código</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="codigo" placeholder="Debe ser único y no tener espacios" maxlength="100" required value="{{ old('codigo') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="descripcion">Descripción (opcional)</label></small></div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.textarea name="descripcion" placeholder="Descripción del plan de estudio" rows="3" maxlength="500">{{ old('descripcion') }}</x-adminlte.form.textarea>
                </div>
            </div>
            <div class="text-center">
                <x-adminlte-button type="submit" label="Crear plan de estudio" theme="primary" icon="fas fa-lg fa-save"/>
            </div>
        </form>
        <x-slot:mainCardFooter><x-app.boton-regresar route="planEstudio.index" /></x-slot>
    </x-layout.two-column-cards>
@endsection