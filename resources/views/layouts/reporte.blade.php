{{--  
    La simplicidad es la máxima sofisticación. - Leonardo da Vinci

    Esta plantilla Blade se utiliza para generar un diseño de reporte. Incluye secciones para 
    detalles de la institución, título del reporte, descripción, número, fecha, contenido y comentarios.

    Secciones disponibles para ser utilizadas:
    - reporte_title: El título del reporte (para el nombre de archivo y titulo de pagina).
    - reporte_titulo: El título del reporte.
    - reporte_descripcion: Una descripción del reporte (opcional).
    - reporte_numero: El número del reporte.
    - reporte_fecha: La fecha de emisión del reporte.
    - reporte_contenido: El contenido principal del reporte.
    - reporte_comentarios: Cualquier comentario adicional relacionado con el reporte.
--}}


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

    <title>@yield('reporte_title')</title>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        body {
            /* font-size: 1.025rem; */
            margin: 0;
        }
        header .datos-empresa {
            line-height: 1.8;
        }
        .page-header, .page-header-space {
            height: 290px;
        }

        .page-footer, .page-footer-space {
            height: 50px;
        }

        .page-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .page-header {
            position: fixed;
            top: 0mm;
            width: 100%;
        }

        .page {
            page-break-after: always;
        }
        
        @media print {
            thead {display: table-header-group;} 
            tfoot {display: table-footer-group;}
        
            @page {
                size: letter portrait;
                margin: 10mm;
            }            
        }
    </style>
</head>
<body>
    <div class="page-header">
        <header class="container-fluid mx-auto border-bottom pb-3">
            <div class="d-flex">
                    @if($institucion->logoPath)
                <div class="d-flex justify-content-center align-items-center flex-shrink-0" style="max-width:500px;">
                    <img src="{{ Storage::url($institucion->logoPath) }}" alt="Logo" class="img-fluid ratio ratio-3x4 border rounded">
                </div>
                @endif
                <div class="datos-empresa pl-3">
                    <h1 class="h2">{{ $institucion->nombre }}</h1>
                    <p>
                        {{ $institucion->rif }}
                        <br>
                        {{ $institucion->telefono }}
                        <br>
                        {{ $institucion->direccion }}
                    </p>
                </div>
            </div>
        </header>
        <div class="pt-3 container-fluid">
            <div class="row">
                <div class="col-8">
                    <h2 class="h3">@yield('reporte_titulo')</h2>
                    @hasSection ('reporte_descripcion')
                        <div class="lead">
                            @yield('reporte_descripcion')
                        </div>
                    @endif
                </div>
                <div class="col-4 d-flex flex-column justify-content-between text-right">
                    <div>
                        @hasSection ('reporte_numero')
                        <span class="d-block h4"><small>N. </small>#@yield('reporte_numero')</span>
                        @endif
                        @hasSection ('reporte_fecha')
                        <span class="d-block h5">Fecha de emisión: @yield('reporte_fecha')</span>
                        @else
                        <span class="d-block h5">Fecha de emisión: {{ now()->format('d/m/Y') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="w-100">
        <thead>
            <tr>
                <td>
                    <div class="page-header-space"></div>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <main>
                        <div class="container-fluid">
                            
                            <div class="content">
                                @yield('reporte_contenido')
                            </div>
                            
                            @hasSection ('reporte_comentarios')
                                <h5>Comentarios:</h5>
                                <div>
                                    @yield('reporte_comentarios')
                                </div>
                            @endif
                        </div>
                    </main>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <div class="page-footer-space"></div>
                </td>
            </tr>
        </tfoot>
    </table>
    <footer class="page-footer">
        <div class="container-fluid text-center mt-4">
            <p class="text-muted">Este es un reporte generado por el sistema.</p>
        </div>
    </footer>
    <script>
        window.addEventListener('load', function() {
            // Automatically print the report when the page loads
            window.print();
            setTimeout(function() {
                window.close();
            }, 0);
        });
    </script>
</body>
</html>
