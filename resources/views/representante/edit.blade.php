<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->

@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.tempusdominusBootstrap4', true)

@section('subtitle', 'Editar Representante')

@section('content_header_title', 'Representantes')
@section('content_header_subtitle', 'Editar Información')

@php
    $cedulaLetra = $representante->letraCedula ?? App\Models\LetraCedula::where('letra', old('cedulaLetra'))->first();
@endphp

@section('content_body')
    <form method="POST" action="{{ route('representante.update', $representante) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-layout.two-column-cards>
            <x-slot:mainCardTitle>Datos del Representante</x-slot:mainCardTitle>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="nombres">Nombres</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input name="nombres" id="nombres" placeholder="Nombres del representante" value="{{ old('nombres', $representante->nombres) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </x-slot>
                    </x-adminlte.form.input>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="apellidos">Apellidos</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input name="apellidos" id="apellidos" placeholder="Apellidos del representante" value="{{ old('apellidos', $representante->apellidos) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </x-slot>
                    </x-adminlte.form.input>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="cedulaNumero">Cédula de Identidad</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <div class="input-group">
                        <div class="w-25">
                            <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" :selected="$cedulaLetra" />
                        </div>
                        <div class="ml-2 flex-grow-1">
                            <x-adminlte.form.input name="cedulaNumero" id="cedulaNumero" placeholder="Número" value="{{ old('cedulaNumero', $representante->cedulaNumero) }}" data-inputmask="'mask': '9{7,9}'" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="genero">Género</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-form.genero required selected="{{old('genero', $representante->genero->letra)}}" />
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="fechaNacimiento">Fecha de Nacimiento</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input name="fechaNacimiento" id="fechaNacimiento" type="date" required value="{{ old('fechaNacimiento', $representante->fechaNacimiento ? $representante->fechaNacimiento->format('Y-m-d') : '') }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte.form.input>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="direccion">Dirección de Habitación</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input name="direccion" placeholder="Dirección completa" value="{{ old('direccion', $representante->direccion) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte.form.input>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="email">Correo Electrónico</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input name="email" type="email" placeholder="ejemplo@dominio.com" value="{{ old('email', $representante->email) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </x-slot>
                    </x-adminlte.form.input>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="telefonoPrincipal">Teléfono Principal</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-form.input-telefono name="telefonoPrincipal" id="telefonoPrincipal" value="{{ old('telefonoPrincipal', $representante->telefonoPrincipal) }}" required >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </div>
                        </x-slot>
                    </x-form.input-telefono>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="telefonoSecundario">Teléfono Secundario</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-form.input-telefono name="telefonoSecundario" id="telefonoSecundario" value="{{ old('telefonoSecundario', $representante->telefonoSecundario) }}" >
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </div>
                        </x-slot>
                    </x-form.input-telefono>
                </div>

            {{-- <hr> --}}
            {{-- <h5>Documentos</h5>
            <div class="row">
                <div class="col-sm-8 col-md-9">
                    <x-adminlte-input-file name="fotoPerfilPath" label="Foto de Perfil (Opcional)" placeholder="Seleccionar imagen..." legend="Buscar" accept="image/*">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-camera"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                    @if($representante->fotoPerfilPath && Storage::disk('public')->exists($representante->fotoPerfilPath))
                    <div class="mb-2">
                        <small>Actual: <a href="{{ Storage::url($representante->fotoPerfilPath) }}" target="_blank">Ver foto</a></small>
                    </div>
                    @endif
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte-input-file name="cedulaPath" label="Cédula Escaneada (Opcional)" placeholder="Seleccionar archivo..." legend="Buscar" accept="image/*,.pdf">
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                        @if($representante->cedulaPath && Storage::disk('public')->exists($representante->cedulaPath))
                    <div class="mb-2">
                        <small>Actual: <a href="{{ Storage::url($representante->cedulaPath) }}" target="_blank">Ver documento</a></small>
                    </div>
                    @endif
                </div>
            </div> --}}
            </div>

            <div class="text-center">
                <x-adminlte-button type="submit" label="Actualizar Representante" theme="primary" icon="fas fa-lg fa-save"/>
            </div>
            <x-slot:mainCardFooter>
                <x-app.boton-regresar route="representante.show" :params="['representante' => $representante]" />
            </x-slot>
            
            <x-slot:asideCardTitle>Añadir estudiantes representados</x-slot>
            <x-slot:aside>
                <x-adminlte.form.input name="" id="buscarEstudiante" type="search" placeholder="Buscar Estudiante" class="form-control">
                    <x-slot name="appendSlot">
                        <button id="sendBuscarEstudiante" class="btn btn-dark"><i class="fas fa-search"></i></button>
                    </x-slot>
                </x-adminlte.form.input>
                <hr>
                <div id="listaEstudiantes" class="d-flex flex-column">
                    @forelse ($representante->estudiantes as $estudiante)
                        <div class="border rounded p-2 mb-2 align-items-start">
                            <input type="checkbox" name="estudiantes[]" checked value="{{$estudiante->id}}" class="mr-1">
                            <em>{{$estudiante->letraCedula->letra.'-'.$estudiante->cedulaNumero}}</em>
                            <div class="ml-4">
                                <span class="d-block">{{ $estudiante->nombreCompleto }}</span>
                                <input type="checkbox" name="representantePrincipal[]" id="representantePrincipal{{$estudiante->id}}" value="{{$estudiante->id}}" @checked($estudiante->pivot->representantePrincipal) required />
                                <label for="representantePrincipal{{$estudiante->id}}"><small class="text-muted">Representante principal</small></label>
                            </div>
                        </div>
                    @empty
                        <span class="text-center text-muted">No hay representantes añadidos</span>
                    @endforelse
                </div>
            </x-slot>
        </x-layout.two-column-cards>
    </form>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buscarEstudianteInput = document.getElementById('buscarEstudiante');
        const sendBuscarEstudianteButton = document.getElementById('sendBuscarEstudiante');
        const listaEstudiantesDiv = document.getElementById('listaEstudiantes');

        const fetchEstudiantes = () => {
            const search = buscarEstudianteInput.value;
            const checkedEstudiantes = Array.from(listaEstudiantesDiv.querySelectorAll('input[name="estudiantes[]"]:checked'))
                .map(input => input.value);

            fetch('{{ route('representante.buscarEstudiantes') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ search, checkedEstudiantes }),
            })
            .then(response => response.json())
            .then(data => {
                listaEstudiantesDiv.innerHTML = ''; // Clear the list

                data.forEach(estudiante => {
                    const estudianteDiv = document.createElement('div');
                    estudianteDiv.className = 'border rounded p-2 mb-2 align-items-start';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'estudiantes[]';
                    checkbox.value = estudiante.id;
                    checkbox.checked = estudiante.checked;
                    checkbox.className = 'mr-1';
                    checkbox.addEventListener('change', fetchEstudiantes); // Re-fetch on change

                    const em = document.createElement('em');
                    em.textContent = `${estudiante.letraCedula}-${estudiante.cedulaNumero}`;

                    const ml4Div = document.createElement('div');
                    ml4Div.className = 'ml-4';

                    const span = document.createElement('span');
                    span.className = 'd-block';
                    span.textContent = estudiante.nombreCompleto;

                    const checkPrincipal = document.createElement('input');
                    checkPrincipal.type = 'checkbox';
                    checkPrincipal.name = 'representantePrincipal[]';
                    checkPrincipal.id = `representantePrincipal${estudiante.id}`;
                    checkPrincipal.value = estudiante.id;

                    const label = document.createElement('label');
                    label.htmlFor = `representantePrincipal${estudiante.id}`;
                    label.innerHTML = '<small class="text-muted">Representante principal</small>';

                    ml4Div.appendChild(span);
                    ml4Div.appendChild(checkPrincipal);
                    ml4Div.appendChild(label);

                    estudianteDiv.appendChild(checkbox);
                    estudianteDiv.appendChild(em);
                    estudianteDiv.appendChild(ml4Div);

                    listaEstudiantesDiv.appendChild(estudianteDiv);
                });
            })
            .catch(error => console.error('Error fetching representantes:', error));
        };

        // Add event listeners to existing checkboxes
        const existingCheckboxes = listaEstudiantesDiv.querySelectorAll('input[name="estudiantes[]"]');
        existingCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', fetchEstudiantes);
        });

        buscarEstudianteInput.addEventListener('input', fetchEstudiantes);
        sendBuscarEstudianteButton.addEventListener('click', fetchEstudiantes);
    });
</script>
@endpush
