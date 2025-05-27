<!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

@extends('layouts.app')

@section('subtitle', 'Todos los Representantes')

@section('content_header_title', 'Representantes')
@section('content_header_subtitle', 'Todos los representantes')

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('representante.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Representante
        </a>
    </div>
@endsection

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Representantes</h3>
            <div class="card-tools">
                <form action="{{ route('representante.index') }}" method="get">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Buscar Representante..." value="{{ request('search') }}">
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
                        <th>Email</th>
                        <th>Teléfono Principal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if($representantes->count() === 0)
                        <tr>
                            <td colspan="5" class="text-center">No se han registrado representantes.</td>
                        </tr>
                    @else
                        @foreach($representantes as $representante)
                            <tr>
                                <td>{{ $representante->nombreSimple }}</td>
                                <td>{{ $representante->letraCedula->letra ?? 'N/A' }}-{{ $representante->cedulaNumero }}</td>
                                <td>{{ $representante->email }}</td>
                                <td>{{ $representante->telefonoPrincipal }}</td>
                                <td>
                                    <a href="{{ route('representante.show', $representante) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('representante.edit', $representante) }}" class="btn btn-sm btn-info">
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
            {{ $representantes->links() }}
        </div>
    </div>
@endsection
