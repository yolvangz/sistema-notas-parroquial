<!-- Well begun is half done. - Aristotle -->

@extends('layouts.app')

@section('subtitle', 'Todos los profesores')

@section('content_header_title', 'Todos los profesores')

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('profesor.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Profesor
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Profesores</h3>
            <div class="card-tools">
                <form action="" method="get">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Buscar Profesor">
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
                        <th>Fecha de Ingreso</th>
                        <th>Cédula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($profesores->count() === 0)
                        <tr>
                            <td colspan="4" class="text-center">No se han creado profesores</td>
                        </tr>
                    @else
                        @foreach($profesores as $profesor)
                            <tr>
                                <td>{{ $profesor->nombreSimple }}</td>
                                <td>{{ $profesor->fechaIngreso->format('d/m/Y') }}</td>
                                <td>{{ $profesor->letraCedula->letra }}-{{ $profesor->cedulaNumero }}</td>
                                <td>
                                    <a href="{{ route('profesor.show', $profesor) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $profesores->links() }}
        </div>
    </div>
@endsection