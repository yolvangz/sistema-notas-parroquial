<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profesores;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/letras-cedula', function () {
    $letrasCedula = DB::table('LetrasCedula')->orderBy('IDLetraCedula')->select('IDLetraCedula as id', 'letra', 'nombre')->get();
    return view('letrasCedula', ['letrasCedula' => $letrasCedula]);
});

Route::controller(Profesores::class)->group(function () {
    Route::prefix('profesores')->group(function () {
        Route::name('profesores.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/nuevo', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{profesor}', 'show')->name('show');
            Route::get('/{profesor}/editar', 'edit')->name('edit');
            Route::put('/{profesor}', 'update')->name('update');
            Route::delete('/{profesor}', 'destroy')->name('destroy');
        });
    });
});

Route::get('/configuracion', function () {
    $configuracion = DB::table('Configuraciones')
        ->join('Instituciones', 'Configuraciones.institucionID', '=', 'Instituciones.IDInstitucion')
        ->select('Configuraciones.*', 'Instituciones.*')
        ->first();

    return $configuracion;
});

Route::get('/planes-estudio', function () {
    $planesEstudio = DB::table('PlanesDeEstudios')->get();
    return $planesEstudio;
});
Route::get('/planes-estudio/{planEstudio}', function ($planEstudio) {
    $componentes = DB::table('Componentes')->where('planEstudioID', $planEstudio)->get();
    return $componentes;
});
Route::get('planes-estudio/{planEstudio}/{componente}', function ($planEstudio, $componente) {
    $materias = DB::table('Materias')->where('componenteID', $componente)->get();
    return $materias;
});
Route::get('/matematicas', function () {
    $materias = DB::table('Materias')->whereLike('nombre', '%matematica%')->get();
    $materias->each(function ($materia) {
        $materia->componente = DB::table('Componentes')->where('IDComponente', $materia->componenteID)->first();
        $materia->planEstudio = DB::table('PlanesDeEstudios')->where('IDPlanEstudio', $materia->componente->planEstudioID)->first();
    });
    return $materias;
});
Route::get('/secciones', function () {
    $secciones = DB::table('Secciones')
        ->join('Componentes', 'Secciones.componenteID', '=', 'Componentes.IDComponente')
        ->join('PlanesDeEstudios', 'Componentes.planEstudioID', '=', 'PlanesDeEstudios.IDPlanEstudio')
        ->join('Profesores', 'Secciones.profesorGuiaID', '=', 'Profesores.IDProfesor')
        ->select('Secciones.*', 'Componentes.nombre as componenteNombre', 'PlanesDeEstudios.nombre as planEstudioNombre', 'Profesores.nombres as profesorGuiaNombres', 'Profesores.apellidos as profesorGuiaApellidos')
        ->get();
    return $secciones;
});

Route::get('/profesor', function () {
    $profesor = DB::table('Profesores')
        ->join('LetrasCedula', 'Profesores.cedulaLetra', '=', 'LetrasCedula.IDLetraCedula')
        ->select('Profesores.*', 'LetrasCedula.letra as cedulaLetra', 'LetrasCedula.nombre as cedulaNombre')
        ->first();
    
    $profesor->asignaciones = DB::table('AuxAsignacionMaterias')
        ->join('Secciones', 'AuxAsignacionMaterias.seccionID', '=', 'Secciones.IDSeccion')
        ->join('Materias', 'AuxAsignacionMaterias.materiaID', '=', 'Materias.IDMateria')
        ->where('AuxAsignacionMaterias.profesorID', $profesor->IDProfesor)
        ->select('AuxAsignacionMaterias.*', 'Secciones.nombre as seccionNombre', 'Materias.nombre as materiaNombre')
        ->get();
    return $profesor;
});