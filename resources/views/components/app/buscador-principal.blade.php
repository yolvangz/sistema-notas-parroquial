<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
@php
    $placeholder = $attributes->get('placeholder') ?? 'Buscar...';
    $route = $attributes->get('route');
    $class = $attributes->get('class');
@endphp

<x-adminlte-card theme="dark" class="{{ $class }}">
    <form action="{{ $route }}" method="get">
        <x-adminlte.form.input name="search" placeholder="Buscar Plan de Estudio..." value="{{ request('search') }}" fgroup-class="mb-0">
            <x-slot name="appendSlot">
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-search"></i>
                </button>
            </x-slot>
        </x-adminlte.form.input>
    </form>
</x-adminlte-card>