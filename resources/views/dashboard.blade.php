<!-- Order your soul. Reduce your wants. - Augustine -->
@extends('adminlte::page')

@section('title', 'Inicio')
		

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
@stop

@section('content')
	<x-adminlte-card title="Lightblue Card" theme="lightblue" theme-mode="outline"
	icon="fas fa-lg fa-envelope" header-class="text-uppercase rounded-bottom border-info"
	removable>
	A removable card with outline lightblue theme...
	</x-adminlte-card>
@endsection
