<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

@php
use App\Models\Institucion;

$institucion = Institucion::with('LetraRif')->find(1);

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Reporte</title>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        body {
            font-size: 1.025rem;
        }
        header .datos-empresa {
            line-height: 1.8;
        }
    </style>
</head>
<body class="px-0 py-4">
    <header class="container-fluid mx-auto">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                    @if($institucion->logoPath)
                <div class="d-flex justify-content-center align-items-center mb-3 flex-shrink-0" style="max-width:500px;">
                    <img src="{{ Storage::url($institucion->logoPath) }}" alt="Logo" class="img-fluid ratio ratio-3x4 border rounded">
                </div>
                @endif
                <div class="datos-empresa pl-3">
                    <h1>{{ $institucion->nombre }}</h1>
                    <p>
                        {{ $institucion->rif }}
                        <br>
                        {{ $institucion->telefono }}
                        <br>
                        {{ $institucion->direccion }}
                    </p>
                </div>
            </div>
        </div>
    </header>
    <hr>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h2>@yield('reporte_titulo') Título de reporte</h2>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure tenetur, facilis, provident ipsam?</p>
                </div>
                <div class="col-4 d-flex flex-column justify-content-between text-right">
                    <div>
                        <span class="d-block h4"><small>N. </small>#@yield('reporte_numero')0000001</span>
                        <span class="d-block h5">Fecha de emisión: @yield('reporte_fecha')01/01/2025</span>
                    </div>
                </div>
            </div>
        
            <table class="table table-striped rounded">
            <thead>
                <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>Producto A</td>
                <td>2</td>
                <td>$50.00</td>
                <td>$100.00</td>
                </tr>
                <tr>
                <td>Producto B</td>
                <td>1</td>
                <td>$30.00</td>
                <td>$30.00</td>
                </tr>
                <tr>
                <td>Producto C</td>
                <td>3</td>
                <td>$20.00</td>
                <td>$60.00</td>
                </tr>
                <tr>
                <td>Producto D</td>
                <td>1</td>
                <td>$40.00</td>
                <td>$40.00</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td><strong>$230.00</strong></td>
                </tr>
            </tfoot>
            </table>
            <h5>Comentarios:</h5>
            <div>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati, quo!</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="container-fluid text-center mt-4">
            <p class="text-muted">Este es un reporte generado por el sistema.</p>
        </div>
    </footer>
    <script>
        window.addEventListener('load', function() {
            window.print();
            window.close();
        });
    </script>
</body>
</html>
