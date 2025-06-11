<!-- Well begun is half done. - Aristotle -->

@extends('layouts.app')

@section('subtitle', 'Todos los profesores')

@section('content_header_title', 'Todos los profesores')

@php
    $titulo = 'Lista de Profesores';
    $search = (object) [
        'route' => route('profesor.index'),
        'placeholder' => 'Buscar profesor...'
    ];
    $columns = [
        'nombreSimple' => (object) ['text' => 'Nombre',],
        'cedula' => (object) [
            'text' => 'Cédula',
            'getter' => fn($e) => ($e->letraCedula->letra ?? 'N/A'). '-' . $e->cedulaNumero
        ],
        'fechaIngreso' => (object) [
            'text' => 'Fecha de Ingreso',
            'getter' => fn($e) => $e->fechaIngreso->format('d/m/Y')
        ],
        'email' => (object) ['text' => 'Correo electrónico',],
        'telefonoPrincipal' => (object) ['text' => 'Teléfono Principal',]
    ];
    $items = $profesores;
    $emptyMessage = 'No se han registrado profesores.';
    $actions = [
        ['route' => 'profesor.show', 'class' => 'primary', 'icon' => 'eye', 'label' => 'Ver'],
        ['route' => 'profesor.edit', 'class' => 'info', 'icon' => 'edit', 'label' => 'Editar'],
    ];
    
@endphp

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('profesor.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Profesor
        </a>
    </div>
@endsection

@section('content')
    <x-app.listado-tabla
        :titulo=$titulo
        :search=$search
        :columns=$columns
        :items=$items
        :emptyMessage=$emptyMessage
        :actions=$actions
    />
@endsection