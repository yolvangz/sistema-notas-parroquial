<?php

namespace App\Http\Controllers;

use App\Models\PlanEstudio;
use Illuminate\Contracts\View\View;
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
    public function show(PlanEstudio $planEstudio)
    {
        dd('materia.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanEstudio $planEstudio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanEstudio $planEstudio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanEstudio $planEstudio)
    {
        //
    }
}
