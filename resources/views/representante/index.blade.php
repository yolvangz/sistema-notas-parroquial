<!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->

@extends('layouts.app')

@section('subtitle', 'Todos los Representantes')

@section('content_header_title', 'Representantes')
@section('content_header_subtitle', 'Todos los representantes')

@php
    $titulo = 'Lista de Representantes';
    $search = (object) [
        'route' => route('representante.index'),
        'placeholder' => 'Buscar Representante...'
    ];
    $columns = [
        'nombreSimple' => (object) ['text' => 'Nombre',],
        'cedula' => (object) [
            'text' => 'Cédula',
            'getter' => fn($e) => ($e->letraCedula->letra ?? 'N/A'). '-' . $e->cedulaNumero
        ],
        'email' => (object) ['text' => 'Correo Electrónico',],
        'telefonoPrincipal' => (object) ['text' => 'Teléfono Principal',]
    ];
    $items = $representantes;
    $emptyMessage = 'No se han registrado representantes.';
    $actions = [
        ['route' => 'representante.show', 'class' => 'primary', 'icon' => 'eye', 'label' => 'Ver'],
        ['route' => 'representante.edit', 'class' => 'info', 'icon' => 'edit', 'label' => 'Editar'],
        ['route' => 'representante.reporte.show', 'class' => 'secondary printWindow', 'icon' => 'print', 'label' => 'Imprimir']
    ];
    
@endphp

@section('content_header_actions')
    <div class="mt-3">
        <a href="{{ route('representante.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Representante
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
