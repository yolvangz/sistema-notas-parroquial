<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $search = $request->input('search');

        $componentes = Componente::when($search, function ($query, $search) {
            $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('codigo', 'like', "%{$search}%");
        })
        ->orderBy('nombre');

        return view('componente.index', ['componentes' => $componentes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Componente $componente)
    {
        dd('componente.show');
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Componente $componente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Componente $componente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Componente $componente)
    {
        //
    }
}
