<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
@extends('layouts.app')

@section('subtitle', 'Todos los Estudiantes')

@section('content_header_title', 'Estudiantes')
@section('content_header_subtitle', 'Todos los Estudiantes')

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('estudiante.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Estudiante
        </a>
    </div>
@endsection

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Estudiantes</h3>
            <div class="card-tools">
                <form action="{{ route('estudiante.index') }}" method="get">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Buscar Estudiante..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($estudiantes->count() === 0)
                        <tr>
                            <td colspan="5" class="text-center">No se han registrado estudiantes.</td>
                        </tr>
                    @else
                        @foreach($estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->nombreSimple }}</td>
                                <td>{{ $estudiante->letraCedula->letra ?? 'N/A' }}-{{ $estudiante->cedulaNumero }}</td>
                                <td>{{ $estudiante->fechaNacimiento->format('d/m/Y') }}</td>
                                <td>{{ $estudiante->direccion }}</td>
                                <td>
                                    <a href="{{ route('estudiante.show', $estudiante) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('estudiante.edit', $estudiante) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    {{-- Add delete button/modal if needed --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $estudiantes->links() }}
        </div>
    </div>
@endsection
