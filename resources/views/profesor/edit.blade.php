<!-- Order your soul. Reduce your wants. - Augustine -->

@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)

@section('subtitle', 'Editar Profesor')

@section('content_header_title', 'Profesores')

@section('content_header_subtitle', 'Editar')

@section('content_body')
    <x-layout.two-column-cards>
        <x-slot:mainCardTitle>Datos del Profesor</x-slot>
        <form action="{{ route('profesor.update', $profesor) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- <div class="col-md-4">
                    <div class="d-flex justify-content-center align-items-center mb-3" style="max-width:500px;">
                        @if($profesor->fotoPerfilPath)
                            <img src="{{ Storage::url($profesor->fotoPerfilPath) }}" alt="Foto Perfil" class="img-fluid ratio ratio-3x4">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 100%; padding-bottom: 0; position: relative;">
                                <div style="width: 100%; padding-bottom: 100%;"></div>
                                <span class="text-muted" style="position: absolute;">Sin imagen</span>
                            </div>
                        @endif
                    </div>
                </div> --}}
                {{-- <div class="col-md-8"> --}}
                <div class="col">
                    <dl class="row">
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="nombres">Nombres</label></small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input name="nombres" id="nombres" value="{{ $profesor->nombres }}" placeholder="Nombres" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="apellidos">Apellidos</label></small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input name="apellidos" id="apellidos" value="{{ $profesor->apellidos }}" placeholder="Apellidos" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="cedulaNumero">Cédula de Identidad</label></small></dt>
                        <dd class="col-md-9">
                            <div class="input-group">
                                <div class="w-25">
                                    <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" id="cedulaLetra" :selected="$profesor->letraCedula" :except="['J']" />
                                </div>
                                <div class="ml-2 flex-grow-1">
                                    <x-adminlte.form.input name="cedulaNumero" id="cedulaNumero" value="{{ $profesor->cedulaNumero }}" placeholder="Número de Cédula" data-inputmask="'mask': '9{7,9}'" />
                                </div>
                            </div>
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="genero">Género</label></small></dt>
                        <dd class="col-md-9">
                            <x-form.genero required selected="{{ old('genero', $profesor->genero->letra) }}" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="fechaNacimiento">Fecha de Nacimiento</label></small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input name="fechaNacimiento" id="fechaNacimiento" value="{{ $profesor->fechaNacimiento->format('Y-m-d') }}" placeholder="Fecha de Nacimiento" type="date" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="fechaIngreso">Fecha de Ingreso</label></small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input name="fechaIngreso" id="fechaIngreso" value="{{ $profesor->fechaIngreso->format('Y-m-d') }}" placeholder="Fecha de Ingreso" type="date" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="direccion">Dirección</label></small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input name="direccion" id="direccion" value="{{ $profesor->direccion }}" placeholder="Dirección" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="email">Correo Electrónico</label></small></dt>
                        <dd class="col-md-9">
                            <x-adminlte.form.input name="email" id="email" value="{{ $profesor->email }}" placeholder="Correo Electrónico" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="telefonoPrincipal">Teléfono Principal</label></small></dt>
                        <dd class="col-md-9">
                            <x-form.input-telefono name="telefonoPrincipal" id="telefonoPrincipal" id="telefonoPrincipal" value="{{ $profesor->telefonoPrincipal }}" placeholder="Teléfono Principal" />
                        </dd>
                        <dt class="col-md-3"><small class="text-muted"><label style="font-weight: 400" for="telefonoSecundario">Teléfono Secundario (opcional)</label></small></dt>
                        <dd class="col-md-9">
                            <x-form.input-telefono name="telefonoSecundario" id="telefonoSecundario" id="telefonoSecundario" value="{{ $profesor->telefonoSecundario }}" placeholder="Teléfono Secundario" />
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Actualizar Profesor</button>
                </div>
            </div>
        </form>
        <x-slot:mainCardFooter>
            <x-app.boton-regresar route="profesor.show" :params="['profesor' => $profesor]" />
        </x-slot>
    </x-layout.two-column-cards>
@endsection

@pushOnce('modals')
    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Eliminar Profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar al profesor {{ $profesor->nombreCompleto }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('profesor.destroy', $profesor) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endPushOnce