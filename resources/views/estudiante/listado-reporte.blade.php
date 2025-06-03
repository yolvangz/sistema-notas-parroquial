<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->

@extends('layouts.app')

@section('subtitle', 'Imprimir listado de estudiantes')

@section('content_header_title', 'Estudiantes')
@section('content_header_subtitle', 'Imprimir listado')

@section('content_body')
    <x-adminlte-card theme="dark" theme-mode="outline" title="Parámetros de selección">
        <form action="{{route('reporte.estudiante.index')}}">
            @csrf
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <div class="row">
                            <div class="col">
                                <input type="range" name="edad_min" id="edad_min" class="form-control" min="0" max="100" value="{{ old('edad_min', $filtros->edad_min ?? 0) }}" step="1" oninput="">
                                desde <output id="edadMinOutput"></output> años
                            </div>
                            <div class="col">
                                <input type="range" name="edad_max" id="edad_max" class="form-control" min="0" max="100" value="{{ old('edad_max', $filtros->edad_max ?? 18) }}" step="1" oninput="">
                                hasta <output id="edadMaxOutput"></output> años
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="form-group">
                        <label for="genero">Género</label>
                        <x-form.genero selected="{{old('genero', $filtros->genero ?? '')}}" />
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" formmethod="GET"><i class="fas fa-search"></i> Filtrar</button>
                <button type="submit" class="btn btn-secondary" formmethod="POST" formtarget="_blank"><i class="fas fa-print"></i> Imprimir</button>
            </div>
        </form>
    </x-adminlte-card>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Estudiantes</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table text-nowrap">
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
                    @if($estudiantes->count() === 0)
                        <tr>
                            <td colspan="5" class="text-center">No hay estudiantes que coincidan con los criterios.</td>
                        </tr>
                    @else
                        @foreach($estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->nombreSimple }}</td>
                                <td>{{ $estudiante->letraCedula->letra ?? 'N/A' }}-{{ $estudiante->cedulaNumero }}</td>
                                <td>{{ $estudiante->fechaNacimiento->format('d/m/Y') }} ({{ $estudiante->edad }} año{{ $estudiante->edad > 1 ? 's' : '' }})</td>
                                <td>{{ $estudiante->genero->descripcion }}</td>
                                <td>{{ $estudiante->direccion }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function updateOutput(id) {
            document.getElementById(id).value = this.value;
        }
        document.getElementById('edad_min').addEventListener('input', function(e) {
          updateOutput.call(e.target, 'edadMinOutput')
        });
        document.getElementById('edad_max').addEventListener('input', function(e) {
          updateOutput.call(e.target, 'edadMaxOutput')
        });

        // Initialize the output values on page load
        updateOutput.call(document.getElementById('edad_min'), 'edadMinOutput');
        updateOutput.call(document.getElementById('edad_max'), 'edadMaxOutput');
    </script>
@endpush