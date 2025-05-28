<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->

@extends('layouts.app')

@section('plugins.inputmask', true)

@section('subtitle', 'Crear Plan de Estudio')

@section('content_header_title', 'Plan de Estudio')
@section('content_header_subtitle', 'Nuevo Plan de Estudio')

@section('content_body')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline">
                <form method="POST" action="{{ route('planEstudio.store') }}">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombre">Nombre del plan</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombre" placeholder="nombre del plan de estudio" maxlength="100" required value="{{ old('nombre') }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="codigo">Código</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="codigo" placeholder="Debe ser único y no tener espacios" maxlength="100" required value="{{ old('codigo') }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="descripcion">Descripción</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <x-adminlte.form.textarea name="descripcion" placeholder="Descripción del plan de estudio" rows="3" maxlength="500" required>{{ old('descripcion') }}</x-adminlte.form.textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <x-adminlte-button type="submit" label="Crear plan de estudio" theme="primary" icon="fas fa-lg fa-save"/>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <a href="{{ route('planEstudio.index') }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection