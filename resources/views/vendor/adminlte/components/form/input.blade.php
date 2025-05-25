@extends('adminlte::components.form.input-group-component')

{{-- Set errors bag internallly --}}

@php($setErrorsBag($errors ?? null))
{{-- Set input group item section --}}

@section('input_group_item')
    {{-- Input --}}
    <input id="{{ $id }}" name="{{ $name }}"
        value="{{ html_entity_decode($getOldValue($errorKey, $attributes->get('value')), ENT_QUOTES, 'UTF-8') }}"
        {{ $attributes->merge(['class' => $makeItemClass()]) }}>

@overwrite
