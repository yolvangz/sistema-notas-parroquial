<!-- The only way to do great work is to love what you do. - Steve Jobs -->

@extends('layouts.app')

@section('subtitle', 'Buscar componentes de un plan de estudio')

@section('content_header_title', 'Componentes')
@section('content_header_subtitle', 'Buscar')

@php
    $listado = [];
    if ($componentes->count() > 0) {
        foreach ($componentes as $componente) {
            dd('si son');
            $listado[] = (object) [
                'titulo' => $componente->nombre,
                'links' => (object) [
                    'ver' => route('componente.show'),
                    'editar' => route('componente.edit'),
                ],
            ];
        }
    }
@endphp

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('componente.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Plan de Estudios
        </a>
    </div>
@endsection

@section('content_body')
    <div class="row">
        <x-app.buscador-principal class="col-md-8 col-lg-6 mx-auto" placeholder="Buscar Componente..." />
        <x-app.listado-principal :listado :config="
            (object) [
                'singular' => 'componente',
                'plural' => 'componentes de grado',
                'nuevo' => 'un componente de grado nuevo',
                'rutaNuevo' => route('componente.create'),
            ]
        " />
    </div>
@endsection