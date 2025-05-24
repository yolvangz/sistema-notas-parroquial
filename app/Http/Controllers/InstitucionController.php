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
        $institucion = Institucion::with('letraCedula', 'configuracion')->find(1);
        
        return view('institucion.show', [
            'institucion' => $institucion,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit() : View
    {
        $institucion = Institucion::with('letraCedula', 'configuracion')->find(1);

        return view('institucion.edit', [
            'institucion' => $institucion,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) : RedirectResponse
    {
        $institucion = Institucion::find(1);

        if (!$institucion) {
            return redirect()->route('institucion.edit')->with('error', 'Institución no encontrada.');
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'letraRif' => 'required|string|max:1',
            'numeroRif' => 'required|numeric',
            'direccion' => 'nullable|string|max:500',
            'telefono' => 'nullable|string|max:20',
            'logoPath' => 'nullable|string|max:255',
        ]);

        $institucion->update($validatedData);

        return redirect()->route('institucion.edit')->with('success', 'Institución actualizada correctamente.');
    }
    public function configuracionEdit() : View
    {
        $configuracion = configuracion::where('IDConfiguracion', 1)->first();

        return view('configuracion.edit', [
            'configuracion' => $configuracion,
        ]);
    }
    public function configuracionUpdate(Request $request) 
    {
        $configuracion = configuracion::where('IDConfiguracion', 1)->first();

        if (!$configuracion) {
            return redirect()->route('institucion.configuracion.edit')->with('error', 'Configuración no encontrada.');
        }

        // Decode the JSON string into an array
        $calificacionCualitativaLiterales = json_decode($request->input('calificacionCualitativaLiterales'), true);

        // Ensure the decoded value is an array
        if (!is_array($calificacionCualitativaLiterales)) {
            return redirect()->route('institucion.configuracion.edit')->with('error', 'El formato de calificacionCualitativaLiterales no es válido.');
        }
        // Check if calificacionCualitativaAprobatoria is inside letra property of one of the elements
        $aprobarEncontrado = false;
        foreach ($calificacionCualitativaLiterales as $index => $item) {
            // Convert empty descripcion strings into null
            if (empty($item['descripcion'])) {
                $calificacionCualitativaLiterales[$index]['descripcion'] = null;
            }
            if ($item['letra'] === $request->input('calificacionCualitativaAprobatoria')) {
                $aprobarEncontrado = true;
                $request->merge(['calificacionCualitativaAprobatoria' => $index + 1]);
                break;
            }
        }
        if (!$aprobarEncontrado) {
            return redirect()->route('institucion.configuracion.edit')->with('error', 'La calificación aprobatoria debe estar asociada a una letra existente.');
        }
        
        // Merge the decoded array back into the request data
        $request->merge(['calificacionCualitativaLiterales' => $calificacionCualitativaLiterales]);
        
        // Validate the request
        $validatedData = $request->validate([
            'calificacionNumericaMinima' => 'required|numeric|min:0|max:9999.99',
            'calificacionNumericaMaxima' => 'required|numeric|min:0|max:9999.99',
            'calificacionNumericaAprobatoria' => 'required|numeric|min:0|max:9999.99',
            'calificacionCualitativaLiterales' => 'required|array',
            'calificacionCualitativaLiterales.*.letra' => 'required|string|max:1',
            'calificacionCualitativaLiterales.*.descripcion' => 'nullable|string|max:255',
            'calificacionCualitativaAprobatoria' => 'required|numeric|min:1|max:'.count($calificacionCualitativaLiterales),
        ]);
        // Update the configuration
        $configuracion->update($validatedData);
        
        return redirect()->route('institucion.show')->with('success', 'Configuración actualizada correctamente.');
    }
}
