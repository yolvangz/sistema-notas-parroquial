<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Profesores extends Controller
{
    public function index() : View
    {
        $profesores = DB::table('Profesores')
            ->join('LetrasCedula', 'LetrasCedula.IDLetraCedula', '=', 'Profesores.cedulaLetra')
            ->select('Profesores.IDProfesor as id',
                'Profesores.nombres as nombres',
                'Profesores.apellidos as apellidos',
                'LetrasCedula.letra as cedulaLetra',
                'Profesores.cedulaNumero as cedulaNumero')
            ->orderBy('apellidos')
            ->get();

        foreach ($profesores as $profesor) {
            $profesor->nombre = $profesor->apellidos . ', ' . $profesor->nombres;
            $profesor->url = route('profesores.show', ['profesor' => $profesor->id]);
        }

        return view('profesores.index', ['profesores' => $profesores]);
    }
    public function show($id) : View
    {
        $profesor = DB::table('Profesores')->where('IDProfesor', $id)->first();
        $profesor->cedulaLetra = DB::table('LetrasCedula')->where('IDLetraCedula', $profesor->cedulaLetra)->value('letra');
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

        DB::table('Profesores')->insert($dummyProfesor);
        return redirect()->route('profesores.index');
    }
}
