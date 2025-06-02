<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use App\Models\PlanEstudio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ComponenteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(PlanEstudio $planEstudio): View
    {
        return view('componente.create', ['planEstudio' => $planEstudio]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanEstudio $planEstudio, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'prela' => ['nullable', 'integer', Rule::exists(Componente::class, 'IDComponente')],
        ]);
        $validatedData['prelaID'] = $request->prela ?: null; // Allow null for prela
        $validatedData['planEstudioID'] = $planEstudio->id;
        
        Componente::create($validatedData);
        return redirect()->route('planEstudio.show', $planEstudio)
            ->with('success', 'Componente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanEstudio $planEstudio, Componente $componente): View
    {
        $componente->load('materias');
        return view('componente.show', ['planEstudio'=> $planEstudio, 'componente' => $componente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanEstudio $planEstudio, Componente $componente): View
    {
        return view('componente.edit', [
            'planEstudio' => $planEstudio,
            'componente' => $componente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanEstudio $planEstudio, Componente $componente): RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'prela' => ['nullable', 'integer', Rule::exists(Componente::class, 'IDComponente')],
        ]);
        $validatedData['prelaID'] = $request->prela ?: null; // Allow null for prela
        $validatedData['planEstudioID'] = $planEstudio->id;
        if ($request->prela === $componente->id) {
            $validatedData['prela'] = null; // Prevent self-reference
        }
        $componente->update($validatedData);

        return redirect()->route('componente.show', ['planEstudio' => $planEstudio, 'componente' => $componente])
            ->with('success', 'Componente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanEstudio $planEstudio, Componente $componente): RedirectResponse
    {
        // Soft delete the component
        $componente->delete();

        return redirect()->route('planEstudio.show', ['planEstudio' => $componente->planEstudio])
            ->with('success', 'Componente eliminado exitosamente.');
    }
}
