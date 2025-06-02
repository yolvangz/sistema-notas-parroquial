<!-- Very little is needed to make a happy life. - Marcus Aurelius -->

@extends('layouts.app')

@section('subtitle', 'Editar Componente '. $componente->nombre)

@section('content_header_title', 'Componentes')
@section('content_header_subtitle', 'Editar '. $planEstudio->nombre)

@section('content_body')
    @php
        dd($planEstudio, $componente, $materia);
    @endphp
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <x-adminlte-card theme="dark" theme-mode="outline">
                <form method="POST" action="{{ route('componente.update', ['planEstudio' => $planEstudio, 'componente' => $componente]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombre">Nombre del componente</label></small></div>
                        <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombre" placeholder="1er grado, 1er año, 1er nivel..." maxlength="100" required value="{{ old('nombre', $componente->nombre) }}" /></div>
                        
                        <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="descripcion">Descripción (opcional)</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <x-adminlte.form.textarea name="descripcion" placeholder="Descripción del plan de estudio" rows="3" maxlength="255" >{{ old('descripcion', $componente->descripcion) }}</x-adminlte.form.textarea>
                        </div>

                        {{-- <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="prela">Componente que le prela (opcional)</label></small></div>
                        <div class="col-sm-8 col-md-9">
                            <x-adminlte-select2 name="prela" placeholder="Seleccione un componente" value="{{ old('prela', $componente->prela->id ?? '') }}">
                                <option value="">Ninguno</option>
                                @foreach($planEstudio->componentes as $componenteItem)
                                    @if ($componenteItem->id == $componente->id)
                                        @continue
                                    @endif
                                    <option value="{{ $componenteItem->id }}" {{ old('prela', $componente->prela->id ?? null) == $componenteItem->id ? 'selected' : '' }}>{{ $componenteItem->nombre }}</option>
                                @endforeach
                            </x-adminlte-select2>
                        </div> --}}
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
