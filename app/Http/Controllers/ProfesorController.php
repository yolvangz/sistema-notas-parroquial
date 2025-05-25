<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\LetraCedula;

class ProfesorController extends Controller
{
    public function index(Request $request) : View
    {
        $search = $request->input('search');
    
        $profesores = Profesor::with('letraCedula')
            ->when($search, function ($query, $search) {
                $query->where('nombres', 'like', "%{$search}%")
                    ->orWhere('apellidos', 'like', "%{$search}%")
                    ->orWhere('cedulaNumero', 'like', "%{$search}%");
            })
            ->orderBy('apellidos')
            ->paginate(10);
        return view('profesor.index', ['profesores' => $profesores]);
    }
    public function show(Profesor $profesor) : View
    {
        return view('profesor.show', ['profesor' => $profesor]);
    }
    public function create()
    {
        $letrasCedula = LetraCedula::all();
        return view('profesor.create', compact('letrasCedula'));
    }
    
    public function store(Request $request)
    {
        $letraCedulaID = LetraCedula::where('letra', $request->input('cedulaLetra'))->value('IDLetraCedula');

        $request->merge(['cedulaLetra' => $letraCedulaID]);

        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedulaLetra' => ['required', 'exists:LetrasCedula,IDLetraCedula'],
            'cedulaNumero' => ['required', 'numeric', 'unique:Profesores'],
            'telefonoPrincipal' => ['required', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
            'telefonoSecundario' => ['nullable', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
            'email' => ['required', 'email', 'unique:Profesores', 'max:320'],
            'direccion' => ['required', 'string', 'max:255'],
            'fechaNacimiento' => ['required', 'date', 'before:today'],
            'fechaIngreso' => ['required', 'date', 'before:today'],
        ]);
    
        $profesor = new Profesor();
        $profesor->nombres = $validatedData['nombres'];
        $profesor->apellidos = $validatedData['apellidos'];
        $profesor->cedulaLetra = $validatedData['cedulaLetra'];
        $profesor->cedulaNumero = $validatedData['cedulaNumero'];
        $profesor->telefonoPrincipal = $validatedData['telefonoPrincipal'];
        $profesor->email = $validatedData['email'];
        $profesor->direccion = $validatedData['direccion'];
        $profesor->fechaNacimiento = $validatedData['fechaNacimiento'];
        $profesor->fechaIngreso = $validatedData['fechaIngreso'];
        $profesor->save();
    
        return redirect()->route('profesor.index')->with('success', 'Profesor creado con éxito');
    }
}
