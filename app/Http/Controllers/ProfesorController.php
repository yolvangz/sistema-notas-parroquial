<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        return view('profesor.create');
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
            'genero' => ['required', Rule::in(['M', 'F'])],
            'fechaNacimiento' => ['required', 'date', 'before:today'],
            'fechaIngreso' => ['required', 'date', 'before:today'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:320', Rule::unique('Representantes', 'email')],
            'telefonoPrincipal' => ['required', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
            'telefonoSecundario' => ['nullable', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
        ]);
    
        $profesor = new Profesor();
        $profesor->nombres = $validatedData['nombres'];
        $profesor->apellidos = $validatedData['apellidos'];
        $profesor->cedulaLetra = $validatedData['cedulaLetra'];
        $profesor->cedulaNumero = $validatedData['cedulaNumero'];
        $profesor->genero = $validatedData['genero'];
        $profesor->telefonoPrincipal = $validatedData['telefonoPrincipal'];
        $profesor->email = $validatedData['email'];
        $profesor->direccion = $validatedData['direccion'];
        $profesor->fechaNacimiento = $validatedData['fechaNacimiento'];
        $profesor->fechaIngreso = $validatedData['fechaIngreso'];
        $profesor->save();
    
        return redirect()->route('profesor.index')->with('success', 'Profesor creado con éxito');
    }
    
    public function edit(Profesor $profesor): View
    {        
        return view('profesor.edit', ['profesor' => $profesor]);
    }
    
    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $letraCedulaID = LetraCedula::where('letra', $request->input('cedulaLetra'))->value('IDLetraCedula');
        
        
        $request->merge(['cedulaLetra' => $letraCedulaID]);

        $validatedData = $request->validate([
            'nombres' => ['required', 'string', 'max:100'],
            'apellidos' => ['required', 'string', 'max:100'],
            'cedulaLetra' => ['required', 'exists:LetrasCedula,IDLetraCedula'],
            'cedulaNumero' => ['required', 'numeric', 'unique:App\Models\Profesor,cedulaNumero,' . $profesor->id],
            'genero' => ['required', Rule::in(['M', 'F'])],
            'telefonoPrincipal' => ['required', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
            'telefonoSecundario' => ['nullable', 'string', 'regex:/^\+58 \d{3}-\d{7}$/'],
            'email' => ['required', 'email', 'unique:App\Models\Profesor,email,' . $profesor->id, 'max:320'],
            'direccion' => ['required', 'string', 'max:255'],
            'fechaNacimiento' => ['required', 'date', 'before:today'],
            'fechaIngreso' => ['required', 'date', 'before:today'],
        ]);
               
        $profesor->nombres = $validatedData['nombres'];
        $profesor->apellidos = $validatedData['apellidos'];
        $profesor->cedulaLetra = $validatedData['cedulaLetra'];
        $profesor->cedulaNumero = $validatedData['cedulaNumero'];
        $profesor->genero = $validatedData['genero'];
        $profesor->telefonoPrincipal = $validatedData['telefonoPrincipal'];
        $profesor->telefonoSecundario = $validatedData['telefonoSecundario'];
        $profesor->email = $validatedData['email'];
        $profesor->direccion = $validatedData['direccion'];
        $profesor->fechaNacimiento = $validatedData['fechaNacimiento'];
        $profesor->fechaIngreso = $validatedData['fechaIngreso'];
        $profesor->save();
    
        return redirect()->route('profesor.show', ['profesor' => $profesor])->with('success', 'Profesor actualizado con éxito');
    }

    public function destroy(Profesor $profesor): RedirectResponse
    {
        $profesor->delete();
        return redirect()->route('profesor.index')->with('success', 'Profesor eliminado con éxito');
    }
}
