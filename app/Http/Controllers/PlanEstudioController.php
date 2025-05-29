<?php

namespace App\Http\Controllers;

use App\Models\PlanEstudio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PlanEstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $search = $request->input('search');

        $planesEstudio = PlanEstudio::when($search, function ($query, $search) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('codigo', 'like', "%{$search}%");
        })
        ->orderBy('nombre');

        return view('planEstudio.index', ['planesEstudio' => $planesEstudio]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('planEstudio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'nombre' => ['required', 'string'],
            'codigo' => ['required', 'regex:/^[a-z0-9-]+$/i', 'unique:App\Models\PlanEstudio,codigo'],
            'descripcion' => ['nullable', 'string'],
        ]);

        $planEstudio = new PlanEstudio();
        $planEstudio->nombre = $request->nombre;
        $planEstudio->codigo = $request->codigo;
        $planEstudio->descripcion = $request->descripcion;
        $planEstudio->save();

        return redirect()->route('planEstudio.show', ['planEstudio' => $planEstudio])->with('success', 'Plan de estudio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanEstudio $planEstudio) : View
    {
        return view('planEstudio.show', ['planEstudio' => $planEstudio]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanEstudio $planEstudio) : View
    {
        return view('planEstudio.edit', ['planEstudio' => $planEstudio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanEstudio $planEstudio) : RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre' => ['required', 'string'],
            'codigo' => [
                'required',
                'regex:/^[a-z0-9-]+$/i',
                // 'unique:App\Models\PlanEstudio,codigo'
            ],
            'descripcion' => ['nullable', 'string'],
        ]);

        $planEstudio->update($validatedData);
        return redirect()->route('planEstudio.show', $planEstudio)->with('success', 'Plan de estudio actuailizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanEstudio $planEstudio) : RedirectResponse
    {
        return redirect('');
    }
}
