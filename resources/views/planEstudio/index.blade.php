<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->

@extends('layouts.app')

@section('subtitle', 'Todos los Planes de Estudios')

@section('content_header_title', 'Planes de Estudios')
@section('content_header_subtitle', 'Todos los Planes de Estudios')

@php
    $listado = [];
    if ($planesEstudio->count() > 0) {
        $planesEstudio->each(function ($plan) use (&$listado) {
            $listado[] = (object) [
                'titulo' => $plan->nombre,
                'descripcion' => $plan->descripcion,
                'links' => (object) [
                    'ver' => route('planEstudio.show', ['planEstudio' => $plan]),
                    'editar' => route('planEstudio.edit', ['planEstudio' => $plan]),
                ],
            ];
        });
    }
@endphp

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('planEstudio.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Plan de Estudios
        </a>
    </div>
@endsection

@section('content_body')
    <div class="row">
        <x-app.buscador-principal class="col-md-8 col-lg-6 mx-auto" placeholder="Buscar Plan de Estudio" />
        <x-app.listado-principal :listado="$listado" :config="
            (object) [
                'singular' => 'plan de estudio',
                'plural' => 'planes de estudio',
                'nuevo' => 'un plan nuevo',
                'rutaNuevo' => route('planEstudio.create'),
            ]
        " />
    </div>
@endsection