<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
@extends('layouts.app')

@section('subtitle', 'Todos los Estudiantes')

@section('content_header_title', 'Estudiantes')
@section('content_header_subtitle', 'Todos los Estudiantes')

@php
    $titulo = 'Lista de Estudiantes';
    $search = (object) [
        'route' => route('estudiante.index'),
        'placeholder' => 'Buscar Estudiante...'
    ];
    $columns = [
        'nombreSimple' => (object) ['text' => 'Nombre',],
        'cedula' => (object) [
            'text' => 'Cédula',
            'getter' => fn($e) => ($e->letraCedula->letra ?? 'N/A'). '-' . $e->cedulaNumero
        ],
        'fechaNacimiento' => (object) [
            'text' => 'Fecha de Nacimiento',
            'getter' => fn($e) => $e->fechaNacimiento->format('d/m/Y') . ' (' . $e->edad . Str::plural(' año', $e->edad) . ')'
        ],
        'direccion' => (object) ['text' => 'Dirección',],
    ];
    $items = $estudiantes;
    $emptyMessage = 'No se han registrado estudiantes.';
    $actions = [
        ['route' => 'estudiante.show', 'class' => 'primary', 'icon' => 'eye', 'label' => 'Ver'],
        ['route' => 'estudiante.edit', 'class' => 'info', 'icon' => 'edit', 'label' => 'Editar'],
        ['route' => 'estudiante.reporte.show', 'class' => 'secondary printWindow', 'icon' => 'print', 'label' => 'Imprimir']
    ];
    
@endphp

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('estudiante.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Estudiante
        </a>
        <a href="{{ route('estudiante.reporte.index') }}" class="btn btn-secondary">
            <i class="fas fa-clipboard-list"></i> Imprimir listado
        </a>
    </div>
@endsection

@section('content_body')
<x-app.listado-tabla
    :titulo=$titulo
    :search=$search
    :columns=$columns
    :items=$items
    :emptyMessage=$emptyMessage
    :actions=$actions
/>
@endsection
