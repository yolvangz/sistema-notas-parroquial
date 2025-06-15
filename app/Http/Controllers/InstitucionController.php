<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Configuracion;
use App\Models\Institucion;
use App\Models\LetraCedula;

class InstitucionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        $institucion = Institucion::with('letraRif', 'configuracion')->find(1);
        
        return view('institucion.show', [
            'institucion' => $institucion,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): RedirectResponse|View
    {
        // Check if an institution already exists
        if (Institucion::exists()) {
            return redirect()->route('institucion.show')->with('error', 'Ya existe una institución registrada.');
        }

        return view('institucion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if an institution already exists
        if (Institucion::exists()) {
            return redirect()->route('institucion.show')->with('error', 'Ya existe una institución registrada.');
        }
        // Decode the JSON string into an array
        $calificacionCualitativaLiterales = json_decode($request->input('calificacionCualitativaLiterales'), true);

        // Ensure the decoded value is an array
        if (!is_array($calificacionCualitativaLiterales)) {
            return redirect()->route('institucion.create')->with('error', 'El formato de calificacionCualitativaLiterales no es válido.');
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
            return redirect()->route('institucion.create')->with('error', 'La calificación aprobatoria debe estar asociada a una letra existente.');
        }
        // Check that minimo < aprobatoria < maximo
        if ($request->input('calificacionNumericaMinima') >= $request->input('calificacionNumericaAprobatoria') || $request->input('calificacionNumericaAprobatoria') >= $request->input('calificacionNumericaMaxima')) {
            return redirect()->route('institucion.create')->with('error', 'La calificación mínima debe ser menor que la calificación aprobatoria y la calificación aprobatoria debe ser menor que la calificación máxima.');
        }
        
        // Merge the decoded array back into the request data
        $request->merge(['calificacionCualitativaLiterales' => $calificacionCualitativaLiterales]);


        $validatedConfiguracionData = $request->validate([
            'calificacionNumericaMinima' => 'required|numeric|min:0|max:9999.99',
            'calificacionNumericaMaxima' => 'required|numeric|min:0|max:9999.99',
            'calificacionNumericaAprobatoria' => 'required|numeric|min:0|max:9999.99',
            'calificacionCualitativaLiterales' => 'required|array',
            'calificacionCualitativaLiterales.*.letra' => 'required|string|max:1',
            'calificacionCualitativaLiterales.*.descripcion' => 'nullable|string|max:255',
            'calificacionCualitativaAprobatoria' => 'required|numeric|min:1|max:'.count($calificacionCualitativaLiterales),
        ]);
        
        $validatedInstitucionData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'letraRif' => ['required', 'string', 'max:1'],
            'numeroRif' => ['required', 'numeric'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
            'logo' => ['nullable','image'],
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = Storage::putFileAs('institucion', $request->file('logo'),'logo.'.''.$request->file('logo')->extension());
            $validatedInstitucionData['logoPath'] = $logoPath;
        }
        $validatedInstitucionData['letraRifID'] = LetraCedula::where('letra', $validatedInstitucionData['letraRif'])->value('IDLetraCedula');
        if (!$validatedInstitucionData['letraRifID']) {
            return redirect()->route('institucion.create')->with('error', 'La letra del RIF no es válida.');
        }
        
        $validatedInstitucionData['letraRif'] = null; // Remove letraRif from the validated data
        
        DB::transaction(function () use ($validatedInstitucionData, $validatedConfiguracionData) {
            try {
                $institucion = Institucion::create($validatedInstitucionData);
                $validatedConfiguracionData['institucionID'] = $institucion->IDInstitucion;
                Configuracion::create($validatedConfiguracionData);
            } catch (QueryException $e) {
                DB::rollBack();
                throw $e;
            } catch(\Throwable $e) {
                DB::rollBack();
                throw $e;
            }
        });

        return redirect()->route('institucion.show')->with('success', 'Institución creada correctamente.');
    }

    /**
     * Display the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(): RedirectResponse|View
    {
        $institucion = Institucion::with('letraRif', 'configuracion')->find(1);

        if (!$institucion) return redirect()->route('institucion.show');

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
    public function update(Request $request): RedirectResponse
    {
        $institucion = Institucion::find(1);

        if (!$institucion) return redirect()->route('institucion.show');

        $validatedData = $request->validate([
            'nombre' => ['required','string','max:255'],
            'letraRif' => ['required','string','max:1'],
            'numeroRif' => ['required','numeric'],
            'direccion' => ['required','string','max:500'],
            'telefono' => ['required','string','regex:/^\+58 \d{3}-\d{7}$/'],
            'logo' => ['nullable','image'],
        ]);

        if ($request->hasFile('logo')) {
            if ($institucion->logoPath) Storage::disk('public')->delete($institucion->logoPath);
            $logoPath = Storage::putFileAs('institucion', $request->file('logo'),'logo.'.''.$request->file('logo')->extension());
            $validatedData['logoPath'] = $logoPath;
        }
        $validatedData['letraRifID'] = LetraCedula::where('letra', $validatedData['letraRif'])->value('IDLetraCedula');
        if (!$validatedData['letraRifID']) {
            return redirect()->route('institucion.edit')->with('error', 'La letra del RIF no es válida.');
        }
        
        $validatedData['letraRif'] = null; // Remove letraRif from the validated data

        $institucion->update($validatedData);

        return redirect()->route('institucion.show')->with('success', 'Institución actualizada correctamente.');
    }
    public function configuracionEdit(): RedirectResponse|View
    {
        $configuracion = configuracion::where('IDConfiguracion', 1)->first();

        if (!$configuracion) return redirect()->route('institucion.show');

        return view('configuracion.edit', [
            'configuracion' => $configuracion,
        ]);
    }
    public function configuracionUpdate(Request $request): RedirectResponse
    {
        $configuracion = configuracion::where('IDConfiguracion', 1)->first();

        if (!$configuracion) return redirect()->route('institucion.show');

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
        // Check that minimo < aprobatoria < maximo
        if ($request->input('calificacionNumericaMinima') >= $request->input('calificacionNumericaAprobatoria') || $request->input('calificacionNumericaAprobatoria') >= $request->input('calificacionNumericaMaxima')) {
            return redirect()->route('institucion.configuracion.edit')->with('error', 'La calificación mínima debe ser menor que la calificación aprobatoria y la calificación aprobatoria debe ser menor que la calificación máxima.');
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
