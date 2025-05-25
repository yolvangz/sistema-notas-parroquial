<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Profesor;

class ProfesorController extends Controller
{
    public function index() : View
    {
        $profesores = Profesor::with('letraCedula')
        ->orderBy('apellidos')
        ->get()
        ->map(function ($profesor) {
            $profesor->url = route('profesores.show', ['profesor' => $profesor->id]);
            return $profesor;
        });

        return view('profesores.index', ['profesores' => $profesores]);
    }
    public function show(Profesor $profesor) : View
    {
        return view('profesores.show', ['profesor' => $profesor]);
    }
    public function create() : RedirectResponse
    {
        $dummyProfesor = [
            'nombres' => 'Pedro',
            'apellidos' => 'Perez',
            'cedulaLetra' => 1,
            'genero' => 'M',
            'cedulaNumero' => '87654321',
            'fechaNacimiento' => '1992-01-01',
            'fechaIngreso' => '2024-06-10',
            'direccion' => '345 Second St',
            'telefonoPrincipal' => '+585434654320',
            'email'=> 'user2@example.com'
        ];

        Profesor::create($dummyProfesor);
        return redirect()->route('profesores.index');
    }
}
