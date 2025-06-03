<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->

@extends('layouts.reporte')

@section('reporte_title', 'Plan de Estudio '.$planEstudio->nombre)

@section('reporte_titulo', 'Plan de Estudio: '.$planEstudio->nombre)

@section('reporte_descripcion')
    <span class="lead"><small class="font-weight-bold">Código: {{ $planEstudio->codigo }}</small></span>
@endsection

@section('reporte_contenido')
    <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre de componente</th>
            <th>Cantidad de materias</th>
            <th>Nombre Materia</th>
            <th>Tipo calificación</th>
            <th>Incluida en el promedio</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($planEstudio->componentes as $componente)
                @forelse ($componente->materias as $materia)
                    <tr>
                    @if ($loop->first)
                        <td rowspan="{{ $componente->materias->count() }}" class="text-center align-middle">{{ $loop->parent->iteration }}</td>
                        <td rowspan="{{ $componente->materias->count() }}" class="align-middle">{{ $componente->nombre }}</td>
                        <td rowspan="{{ $componente->materias->count() }}" class="text-center align-middle">{{ $componente->materias->count() }}</td>
                    @endif
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->cualitativa ? 'cualitativo' : 'cuantitativo' }}</td>
                        <td>{{ $materia->calcular ? 'Sí' : 'No'}}</td>
                    </tr>
                @empty
                    
                @endforelse

            @empty
                
            @endforelse
        </tbody>
      </table>
@endsection
    