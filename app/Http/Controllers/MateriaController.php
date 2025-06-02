<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Componente;
use App\Models\PlanEstudio;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $materias = Materia::when($search, function ($query, $search) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('codigo', 'like', "%{$search}%");
        })
        ->orderBy('nombre');

        return view('materia.index', ['materias' => $materias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PlanEstudio $planEstudio, Componente $componente): View
    {
        return view('materia.create', ['planEstudio' => $planEstudio, 'componente' => $componente]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PlanEstudio $planEstudio, Componente $componente): RedirectResponse
    {
        $request->merge([
            'calcular' => ($request->has('calcular')) ? true : false,
        ]);
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'tipo' => ['required', Rule::in(['cuantitativo', 'cualitativo'])],
            'calcular' => 'boolean',
        ]);
        
        $validatedData['componenteID'] = $componente->id;
        $validatedData['cualitativa'] = $validatedData['tipo'] === 'cualitativo';
        
        Materia::create($validatedData);
        return redirect()->route('componente.show', ['planEstudio'=> $planEstudio, 'componente' => $componente])
            ->with('success', 'Materia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        dd('materia.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanEstudio $planEstudio, Componente $componente, Materia $materia): View
    {
        return view('materia.edit', [
            'planEstudio' => $planEstudio,
            'componente' => $componente,
            'materia' => $materia
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanEstudio $planEstudio, Componente $componente, Materia $materia): RedirectResponse
    {
        $request->merge([
            'calcular' => ($request->has('calcular')) ? true : false,
        ]);
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'tipo' => ['required', Rule::in(['cuantitativo', 'cualitativo'])],
            'calcular' => 'boolean',
        ]);
        
        $validatedData['componenteID'] = $componente->id;
        $validatedData['cualitativa'] = $validatedData['tipo'] === 'cualitativo';
        $materia->update($validatedData);

        return redirect()->route('componente.show', ['planEstudio'=> $planEstudio, 'componente' => $componente])
            ->with('success', 'Materia actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanEstudio $planEstudio, Componente $componente, Materia $materia): RedirectResponse
    {
        // Soft delete the component
        $materia->delete();

        return redirect()->route('componente.show', ['planEstudio'=> $planEstudio, 'componente' => $componente])
            ->with('success', 'Materia eliminada exitosamente.');
    }
}
