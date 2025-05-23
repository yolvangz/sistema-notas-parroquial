<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Configuracion;
use App\Models\Institucion;

class InstitucionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $institucion = Institucion::with('letraRif', 'configuracion')->find(1);

        return view('institucion.show', [
            'institucion' => $institucion,
        ]);
    }
}
