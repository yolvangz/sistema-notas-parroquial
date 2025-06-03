<!-- The only way to do great work is to love what you do. - Steve Jobs -->

@extends('layouts.reporte')

@section('reporte_title', 'Listado de Estudiantes')

@section('reporte_titulo', 'Listado de Estudiantes')

@section('reporte_contenido')
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Género</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->nombreCompleto }}</td>
                            <td>{{ $estudiante->letraCedula->letra ?? 'N/A' }}-{{ $estudiante->cedulaNumero }}</td>
                            <td>{{ $estudiante->fechaNacimiento->format('d/m/Y') }}</td>
                            <td>{{ $estudiante->genero->descripcion }}</td>
                            <td>{{ $estudiante->direccion }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay estudiantes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection