<!-- The only way to do great work is to love what you do. - Steve Jobs -->

@extends('layouts.reporte')

@section('reporte_title', 'Listado de Estudiantes')

@section('reporte_titulo', 'Listado de Estudiantes')

@section('reporte_contenido')
    <div class="row">
        <div class="col-12">
            <table id="tabla-contenido" class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Estudiante</th>
                        <th>Cédula del Estudiante</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Género</th>
                        <th>Dirección</th>
                        <th>Nombre del Representante</th>
                        <th>Cédula del Representante</th>
                        <th>Teléfonos</th>
                        <th>Email</th>
                        <th>Principal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiantes as $estudiante)
                        @php
                            $representantesCount = $estudiante->representantes->count();
                        @endphp
                        @if($representantesCount > 0)
                            @foreach($estudiante->representantes as $index => $representante)
                                <tr>
                                    @if($index === 0)
                                        <td rowspan="{{ $representantesCount }}">{{ $estudiante->nombreCompleto }}</td>
                                        <td class="text-nowrap" rowspan="{{ $representantesCount }}">{{ $estudiante->letraCedula->letra ?? 'N/A' }}-{{ $estudiante->cedulaNumero }}</td>
                                        <td rowspan="{{ $representantesCount }}">{{ $estudiante->fechaNacimiento->format('d/m/Y') }}</td>
                                        <td rowspan="{{ $representantesCount }}">{{ $estudiante->genero->letra }}</td>
                                        <td rowspan="{{ $representantesCount }}">{{ $estudiante->direccion }}</td>
                                    @endif
                                    <td>{{ $representante->nombreSimple }}</td>
                                    <td class="text-nowrap">{{ $representante->letraCedula->letra ?? 'N/A' }}-{{ $representante->cedulaNumero }}</td>
                                    <td class="text-nowrap">
                                        {{ $representante->telefonoPrincipal }}
                                        @if($representante->telefonoSecundario)
                                            , <br>{{ $representante->telefonoSecundario }}
                                        @endif
                                    </td>
                                    <td>{{ $representante->email }}</td>
                                    <td>{{ $representante->pivot->representantePrincipal ? 'Sí' : 'No' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>{{ $estudiante->nombreCompleto }}</td>
                                <td class="text-nowrap">{{ $estudiante->letraCedula->letra ?? 'N/A' }}-{{ $estudiante->cedulaNumero }}</td>
                                <td>{{ $estudiante->fechaNacimiento->format('d/m/Y') }}</td>
                                <td>{{ $estudiante->genero->letra }}</td>
                                <td>{{ $estudiante->direccion }}</td>
                                <td colspan="5" class="text-center">Sin representantes</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No hay estudiantes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
<style>
    #tabla-contenido {
        font-size: 0.8rem;
    }
</style>
@endpush