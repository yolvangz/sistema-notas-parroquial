<!-- Order your soul. Reduce your wants. - Augustine -->

@extends('layouts.app')

@section('plugins.inputmask', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.tempusdominusBootstrap4', true)

@section('subtitle', 'Editar Estudiante')

@section('content_header_title', 'Estudiantes')

@section('content_header_subtitle', 'Editar Información')

@php
    $cedulaLetra = $estudiante->letraCedula ?? App\Models\LetraCedula::where('letra', old('cedulaLetra'))->first();
@endphp

@section('content_body')
    <form method="POST" action="{{ route('estudiante.update', $estudiante) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <x-adminlte-card theme="primary" theme-mode="outline" title="Datos Personales del Estudiante">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="nombres" label="Nombres" placeholder="Nombres del estudiante" fgroup-class="col-12" value="{{ old('nombres', $estudiante->nombres) }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input name="apellidos" label="Apellidos" placeholder="Apellidos del estudiante" fgroup-class="col-12" value="{{ old('apellidos', $estudiante->apellidos) }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <label for="cedulaLetra">Cédula de Identidad</label>
                            <div class="input-group">
                                <div style="max-width: 80px;">
                                     <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" :selected="$cedulaLetra" :except="['J']" />
                                </div>
                                <x-adminlte-input name="cedulaNumero" placeholder="Número" fgroup-class="flex-grow-1" value="{{ old('cedulaNumero', $estudiante->cedulaNumero) }}" data-inputmask="'mask': '9{7,9}'" required/>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <x-form.genero label="Género" required selected="{{ old('genero', $estudiante->genero->letra) }}" />
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <x-adminlte-input-date name="fechaNacimiento" label="Fecha de Nacimiento" placeholder="Seleccione fecha" fgroup-class="col-12" value="{{ old('fechaNacimiento', $estudiante->fechaNacimiento ? $estudiante->fechaNacimiento->format('Y-m-d') : '') }}" required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                        </div>
                    </div>

                    <x-adminlte-input name="direccion" label="Dirección de Habitación" placeholder="Dirección completa" fgroup-class="col-12" value="{{ old('direccion', $estudiante->direccion) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>

                    {{-- <hr> --}}
                    {{-- <h5>Documentos</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input-file name="fotoPerfilPath" label="Foto de Perfil (Opcional)" placeholder="Seleccionar imagen..." legend="Buscar" fgroup-class="col-12" accept="image/*">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                            @if($estudiante->fotoPerfilPath && Storage::disk('public')->exists($estudiante->fotoPerfilPath))
                            <div class="mb-2">
                                <small>Actual: <a href="{{ Storage::url($estudiante->fotoPerfilPath) }}" target="_blank">Ver foto</a></small>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input-file name="cedulaPath" label="Cédula Escaneada (Opcional)" placeholder="Seleccionar archivo..." legend="Buscar" fgroup-class="col-12" accept="image/*,.pdf">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-file>
                             @if($estudiante->cedulaPath && Storage::disk('public')->exists($estudiante->cedulaPath))
                            <div class="mb-2">
                                <small>Actual: <a href="{{ Storage::url($estudiante->cedulaPath) }}" target="_blank">Ver documento</a></small>
                            </div>
                            @endif
                        </div>
                    </div> --}}


                    <x-slot name="footerSlot">
                        <a href="{{ route('estudiante.show', $estudiante) }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancelar</a>
                        <x-adminlte-button class="btn-flat" type="submit" label="Actualizar Estudiante" theme="success" icon="fas fa-lg fa-save"/>
                    </x-slot>
                </x-adminlte-card>
                
            </div>
            <div class="col-xl-4 mx-auto">
                <x-adminlte-card theme="dark" theme-mode="outline" title="Añadir representantes al Estudiante">
                    <x-adminlte.form.input name="" id="buscarRepresentante" type="search" placeholder="Buscar Representante" class="form-control">
                        <x-slot name="appendSlot">
                            <button id="sendBuscarRepresentante" class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </x-slot>
                    </x-adminlte.form.input>
                    <hr>
                    <div id="listaRepresentantes" class="d-flex flex-column">
                        @forelse ($estudiante->representantes as $representante)
                            <div class="border rounded p-2 mb-2 align-items-start">
                                <input type="checkbox" name="representantes[]" checked value="{{$representante->id}}" class="mr-1">
                                <em>{{$representante->letraCedula->letra.'-'.$representante->cedulaNumero}}</em>
                                <div class="ml-4">
                                    <span class="d-block">{{ $representante->nombreCompleto }}</span>
                                    <input type="radio" name="representantePrincipal" id="representantePrincipal{{$representante->id}}" value="{{$representante->id}}" @checked($representante->pivot->representantePrincipal) required />
                                    <label for="representantePrincipal{{$representante->id}}"><small class="text-muted">Representante principal</small></label>
                                </div>
                            </div>
                        @empty
                            <span class="text-center text-muted">No hay representantes añadidos</span>
                        @endforelse
                    </div>
                </x-adminlte-card>
            </div>
        </div>
    </form>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buscarRepresentanteInput = document.getElementById('buscarRepresentante');
        const sendBuscarRepresentanteButton = document.getElementById('sendBuscarRepresentante');
        const listaRepresentantesDiv = document.getElementById('listaRepresentantes');

        console.log('Initializing representante search functionality...');
        const fetchRepresentantes = () => {
            const search = buscarRepresentanteInput.value;
            const checkedRepresentantes = Array.from(listaRepresentantesDiv.querySelectorAll('input[name="representantes[]"]:checked'))
                .map(input => input.value);

            fetch('{{ route('estudiante.buscarRepresentantes') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ search, checkedRepresentantes }),
            })
            .then(response => response.json())
            .then(data => {
                listaRepresentantesDiv.innerHTML = ''; // Clear the list

                data.forEach(representante => {
                    const representanteDiv = document.createElement('div');
                    representanteDiv.className = 'border rounded p-2 mb-2 align-items-start';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'representantes[]';
                    checkbox.value = representante.id;
                    checkbox.checked = representante.checked;
                    checkbox.className = 'mr-1';
                    checkbox.addEventListener('change', fetchRepresentantes); // Re-fetch on change

                    const em = document.createElement('em');
                    em.textContent = `${representante.letraCedula}-${representante.cedulaNumero}`;

                    const ml4Div = document.createElement('div');
                    ml4Div.className = 'ml-4';

                    const span = document.createElement('span');
                    span.className = 'd-block';
                    span.textContent = representante.nombreCompleto;

                    const radio = document.createElement('input');
                    radio.type = 'radio';
                    radio.name = 'representantePrincipal';
                    radio.id = `representantePrincipal${representante.id}`;
                    radio.value = representante.id;
                    radio.required = true;

                    const label = document.createElement('label');
                    label.htmlFor = `representantePrincipal${representante.id}`;
                    label.innerHTML = '<small class="text-muted">Representante principal</small>';

                    ml4Div.appendChild(span);
                    ml4Div.appendChild(radio);
                    ml4Div.appendChild(label);

                    representanteDiv.appendChild(checkbox);
                    representanteDiv.appendChild(em);
                    representanteDiv.appendChild(ml4Div);

                    listaRepresentantesDiv.appendChild(representanteDiv);
                });
            })
            .catch(error => console.error('Error fetching representantes:', error));
        };

        // Add event listeners to existing checkboxes
        const existingCheckboxes = listaRepresentantesDiv.querySelectorAll('input[name="representantes[]"]');
        existingCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', fetchRepresentantes);
        });

        buscarRepresentanteInput.addEventListener('input', fetchRepresentantes);
        sendBuscarRepresentanteButton.addEventListener('click', fetchRepresentantes);
    });
</script>
@endpush