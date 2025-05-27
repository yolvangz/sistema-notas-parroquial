<!-- Order your soul. Reduce your wants. - Augustine -->

{{-- secciones del layout:
	- subtitle => titulo de la pagina
	- content_header_title => Encabezado de la vista h1
	- content_header_subtitle => Subtitulo de la vista (content_header_title > content_header_subtitle)
	- content_body => Contenido de la vista
	- js => Javascript personalizado de la vista
	- css => CSS personalizado de la vista
--}}

{{-- Layout principal de la aplicacion --}}
@extends('adminlte::page')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
@stop

{{-- Titulo del navegador --}}
@section('title')
	@hasSection('subtitle')
		@yield('subtitle') | 
	@endif
	{{ config('adminlte.title') }}
@endsection

{{-- Contenido del cabecero --}}
@section('content_header')
    <div class="d-flex justify-content-between">
        @hasSection('content_header_title')
            <h1>
                @yield('content_header_title')
                @hasSection('content_header_subtitle')
                    <small class="text-dark">
                        <i class="fas fa-xs fa-angle-right text-muted"></i>
                        @yield('content_header_subtitle')
                    </small>
                @endif
            </h1>
        @endif
        @hasSection('content_header_actions')
            @yield('content_header_actions')
        @endif
    </div>
@endsection

{{-- Rename section content to content_body --}}

@section('content')
    <div class="px-2">
        @if ($errors->any())
            <x-adminlte-alert title="Error" theme="danger" dismissable>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </x-adminlte-alert>
        @endif
        @if (session('error'))
            <x-adminlte-alert title="Error" theme="danger" dismissable>{{session('error')}}</x-adminlte-alert>
        @elseif(session('success'))
            <x-adminlte-alert theme="success" dismissable>{{session('success')}}</x-adminlte-alert>
        @endif
        <div class="py-2">
            @yield('content_body')
        </div>
    </div>
    @stack('modals')
    
@endsection

{{-- Create a common footer --}}

@section('footer')
    <div class="text-center">
        Version: {{ config('app.version', 'unknown') }} (experimental)
    </div>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')

@endpush

{{-- Add common CSS customizations --}}

@push('css')
<style type="text/css">
    .ratio {
        object-fit: cover;
    }
    .ratio.ratio-1x1{
        aspect-ratio: 1;
    }
    .ratio.ratio-3x4{
        aspect-ratio: 3 / 4;
    }
</style>
@endpush