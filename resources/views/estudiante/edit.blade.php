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
        <x-layout.two-column-cards>
            <x-slot:mainCardTitle>Datos del Estudiante</x-slot:mainCardTitle>
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="nombres">Nombres</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input name="nombres" placeholder="Nombres del estudiante" value="{{ old('nombres', $estudiante->nombres) }}" required>
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
                    <x-adminlte.form.input name="apellidos" placeholder="Apellidos del estudiante" value="{{ old('apellidos', $estudiante->apellidos) }}" required>
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
                            <x-form.letra-documento name="cedulaLetra" id="cedulaLetra" :selected="$cedulaLetra" :except="['J']" />
                        </div>
                        <div class="ml-2 flex-grow-1">
                            <x-adminlte.form.input name="cedulaNumero" placeholder="Número" value="{{ old('cedulaNumero', $estudiante->cedulaNumero) }}" data-inputmask="'mask': '9{7,9}'" required/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="genero">Género</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-form.genero required selected="{{ old('genero', $estudiante->genero->letra) }}" />
                </div>
                <div class="col-sm-4 col-md-3">
                    <small class="text-muted"><label style="font-weight: 400" for="genero">Fecha de Nacimiento</label></small>
                </div>
                <div class="col-sm-8 col-md-9">
                    <x-adminlte.form.input type="date" name="fechaNacimiento" id="fechaNacimiento" placeholder="Seleccione fecha" value="{{ old('fechaNacimiento', $estudiante->fechaNacimiento ? $estudiante->fechaNacimiento->format('Y-m-d') : '') }}" required>
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
                    <x-adminlte-input name="direccion" placeholder="Dirección completa" value="{{ old('direccion', $estudiante->direccion) }}" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
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
                    @if($estudiante->fotoPerfilPath && Storage::disk('public')->exists($estudiante->fotoPerfilPath))
                    <div class="mb-2">
                        <small>Actual: <a href="{{ Storage::url($estudiante->fotoPerfilPath) }}" target="_blank">Ver foto</a></small>
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
                     @if($estudiante->cedulaPath && Storage::disk('public')->exists($estudiante->cedulaPath))
                    <div class="mb-2">
                        <small>Actual: <a href="{{ Storage::url($estudiante->cedulaPath) }}" target="_blank">Ver documento</a></small>
                    </div>
                    @endif
                </div>
            </div> --}}
            <x-slot:mainCardFooter>
                <x-app.boton-regresar route="estudiante.show" :params="['estudiante' => $estudiante]" />
            </x-slot>

            <x-slot:asideCardTitle>Añadir representantes al Estudiante</x-slot:asideCardTitle>
            <x-slot:aside>
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
            </x-slot:aside>
        </x-layout.two-column-cards>
    </form>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buscarRepresentanteInput = document.getElementById('buscarRepresentante');
        const sendBuscarRepresentanteButton = document.getElementById('sendBuscarRepresentante');
        const listaRepresentantesDiv = document.getElementById('listaRepresentantes');

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
