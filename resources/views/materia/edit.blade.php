<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->

@extends('layouts.app')
@section('plugins.BootstrapSwitch', true)


@section('subtitle', 'Modificar '. $materia->nombre)

@section('content_header_title', 'Materias')
@section('content_header_subtitle', 'Editar '. $componente->nombre)

@php
    $tipoSwitchConfig = [
        'onText' => 'cualitativa',
        'offText' => 'cuantitativa',
        'state' => false,
        'indeterminate' => true,
        'inverse' => true,
    ];
    $tipo = old('tipo', $materia->cualitativa ? 'cualitativo' : 'cuantitativo');
@endphp

@section('content_body')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline">
                <form method="POST" action="{{ route('materia.update', ['planEstudio' => $planEstudio, 'componente' => $componente, 'materia' => $materia]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombre">Nombre de la materia</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombre" placeholder="Matemática, castellano..." maxlength="100" required value="{{ old('nombre', $materia->nombre) }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="descripcion">Descripción (opcional)</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <x-adminlte.form.textarea name="descripcion" rows="3" maxlength="255" >{{ old('descripcion', $materia->descripcion) }}</x-adminlte.form.textarea>
                        </div>

                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="tipo">Tipo de calificación</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cuantitativo" name="tipo" class="custom-control-input" value="cuantitativo" {{ $tipo === 'cuantitativo' ? 'checked' : '' }} required />
                                <label class="custom-control-label" for="cuantitativo">Cuantitativo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="cualitativo" name="tipo" class="custom-control-input" value="cualitativo" {{ $tipo === 'cualitativo' ? 'checked' : '' }} required />
                                <label class="custom-control-label" for="cualitativo">Cualitativo</label>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="calcular">¿Calcular en el promedio?</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <x-adminlte-input-switch name="calcular" id="calcular" :config="[
                                'onText' => 'Sí',
                                'offText' => 'No',
                                'state' => (bool) $materia->calcular,
                            ]"
                            />
                        </div>
                    </div>
                    <div class="text-center">
                        <x-adminlte-button type="submit" label="Guardar cambios" theme="primary" icon="fas fa-lg fa-save"/>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <a href="{{ route('componente.show', ['planEstudio' => $planEstudio, 'componente' => $componente]) }}" class="text-decoration-none text-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function handleTipoChange(first = false) {
            if ($(this).val() === 'cualitativo') {
                $('#calcular').bootstrapSwitch('state', false, true);
                $('#calcular').bootstrapSwitch('disabled', true);
            } else {
                $('#calcular').bootstrapSwitch('disabled', false);
                if(!first) {
                    $('#calcular').bootstrapSwitch('state', $(this).val() === 'cuantitativo', true);
                } else {
                    $('#calcular').bootstrapSwitch('state', {{ Js::from($materia->calcular) }}, true);
                }
            }
        }
        $('input[name="tipo"]').on('change', handleTipoChange);
        $(document).ready(handleTipoChange.bind($('input[name="tipo"]:checked'), true));
    </script>
@endpush