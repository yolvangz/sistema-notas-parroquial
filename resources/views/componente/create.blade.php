<!-- Very little is needed to make a happy life. - Marcus Aurelius -->

@extends('layouts.app')

@section('subtitle', 'Crear Componente de '. $planEstudio->nombre)

@section('content_header_title', 'Plan de Estudio')
@section('content_header_subtitle', 'Nuevo Componente de '. $planEstudio->nombre)

@section('content_body')
    <x-layout.two-column-cards>
        <form method="POST" action="{{ route('componente.store', $planEstudio) }}">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="nombre">Nombre del componente</label></small></div>
                <div class="col-sm-8 col-md-9"><x-adminlte.form.input name="nombre" placeholder="1er grado, 1er año, 1er nivel..." maxlength="100" required value="{{ old('nombre') }}" /></div>
                
                <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="descripcion">Descripción (opcional)</label></small></div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.textarea name="descripcion" placeholder="Descripción del plan de estudio" rows="3" maxlength="255" >{{ old('descripcion') }}</x-adminlte.form.textarea>
                </div>

                {{-- <div class="col-sm-4 col-md-3"><small class="text-muted"><label style="font-weight: 400;" for="prela">Componente que le prela (opcional)</label></small></div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte-select2 name="prela" placeholder="Seleccione un componente" value="{{ old('prela') }}">
                        <option value="">Ninguno</option>
                        @foreach($planEstudio->componentes as $componente)
                            <option value="{{ $componente->id }}" {{ old('prela') == $componente->id ? 'selected' : '' }}>{{ $componente->nombre }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div> --}}
            </div>
            <div class="text-center">
                <x-adminlte-button type="submit" label="Crear componente" theme="primary" icon="fas fa-lg fa-save"/>
            </div>
        </form>
        <x-slot:mainCardFooter><x-app.boton-regresar route="planEstudio.show" :params="['planEstudio' => $planEstudio]" /></x-slot>
    </x-layout.two-column-cards>
@endsection
