@extends('adminlte::master')

@section('adminlte_css')
    <style>
            .card-page{
                -ms-flex-align: center;
                align-items: center;
                background-color: #e9ecef;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                height: 100vh;
                -ms-flex-pack: center;
                justify-content: center;
            }
    </style>
    @stack('css')
    @yield('css')
@stop

asdf

@section('classes_body') card-page @stop

@section('body')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title float-none text-center">
                    @yield('card_title')
                </h3>
            </div>
            <div class="card-body">
                @yield('card_body')
            </div>
            <div class="card-footer">
                @yield('card_footer')
            </div>
        </div>
    </div>
@endsection

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
