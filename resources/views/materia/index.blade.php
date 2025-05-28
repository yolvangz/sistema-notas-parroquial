<!-- Well begun is half done. - Aristotle -->

@extends('layouts.app')

@section('subtitle', 'Buscar materias de un componente')

@section('content_header_title', 'Materias')
@section('content_header_subtitle', 'Buscar')

@php
    $listado = [];
    if ($materias->count() > 0) {
        foreach ($materias as $materia) {
            dd('si son');
            $listado[] = (object) [
                'titulo' => $materia->nombre,
                'links' => (object) [
                    'ver' => route('materia.show'),
                    'editar' => route('materia.edit'),
                ],
            ];
        }
    }
@endphp

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('materia.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Plan de Estudios
        </a>
    </div>
@endsection

@section('content_body')
    <div class="row">
        <x-app.buscador-principal class="col-md-8 col-lg-6 mx-auto" placeholder="Buscar materia..." />
        <x-app.listado-principal :listado :config="
            (object) [
                'singular' => 'materia',
                'plural' => 'materias de grado',
                'nuevo' => 'un materia de grado nuevo',
                'rutaNuevo' => route('materia.create'),
            ]
        " />
    </div>
@endsection