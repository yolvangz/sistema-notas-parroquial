<?php

use App\Http\Controllers\ComponenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\PlanEstudioController;
use App\Http\Controllers\RepresentanteController;
use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\DB;

$dummy = [
    'institucion' => (object)[
        'nombre' => 'U.E.C. Parroquial Punta Cardón',
        'letraRif' => 'J',
        'numeroRif' => '123456789',
        'direccion' => 'Av. 123, Punta Cardón, SUCRE',
        'telefono' => '+58 123-2131231',
        'logoPath' => null,
        'fechaModificacion' => date('Y-m-d H:i:s'),
    ],
    'configuracion' => (object) [
        'calificacionNumericaMinima' => 0,
        'calificacionNumericaMaxima' => 20,
        'calificacionNumericaAprobatoria' => 10,
        'calificacionCualitativaLiterales' => [
            (object) ['literal' => 'A', 'descripcion'=> 'Excelente',],
            (object) ['literal' => 'B', 'descripcion'=> 'Bueno',],
            (object) ['literal' => 'C', 'descripcion'=> 'Regular',],
            (object) ['literal' => 'D', 'descripcion'=> 'Deficiente',],
        ],
        'calificacionCualitativaAprobatoria' => 'C',
        'fechaModificacion' => date('Y-m-d H:i:s'),
    ],
];

// Real Routes
Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('institucion')->name('institucion.')->controller(InstitucionController::class)->group(function () {
    Route::get('/', 'show')->name('show');
    Route::get('/nuevo', 'create')->name('create');
    Route::get('/editar', 'edit')->name('edit');
    Route::post('/', 'store')->name('store');
    Route::put('/', 'update')->name('update');
    // Rutas para la configuracion
    Route::get('/configuracion', fn() => redirect()->route('institucion.show'));
    Route::get('/configuracion/editar', 'configuracionEdit')->name('configuracion.edit');
    Route::put('/configuracion', 'configuracionUpdate')->name('configuracion.update');
});

Route::prefix('profesores')->name('profesor.')->controller(ProfesorController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/nuevo', 'create')->name('create');
    Route::get('/{profesor}', 'show')->name('show');
    Route::get('/{profesor}/editar', 'edit')->name('edit');
    Route::post('/', 'store')->name('store');
    Route::put('/{profesor}', 'update')->name('update');
    Route::delete('/{profesor}', 'destroy')->name('destroy');
});

Route::prefix('representantes')->name('representante.')->controller(RepresentanteController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/nuevo', 'create')->name('create');
    Route::get('/{representante}', 'show')->name('show');
    Route::get('/{representante}/editar', 'edit')->name('edit');
    Route::post('/', 'store')->name('store');
    Route::put('/{representante}', 'update')->name('update');
    Route::delete('/{representante}', 'destroy')->name('destroy');
});

Route::prefix('estudiantes')->name('estudiante.')->controller(EstudianteController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/nuevo', 'create')->name('create');
    Route::get('/{estudiante}', 'show')->name('show');
    Route::get('/{estudiante}/editar', 'edit')->name('edit');
    Route::post('/', 'store')->name('store');
    Route::put('/{estudiante}', 'update')->name('update');
    Route::delete('/{estudiante}', 'destroy')->name('destroy');
});

// --- Plan de Estudio Routes ---
// Prefix: /planes-estudio
// Name prefix: planEstudio.
Route::prefix('planes-estudio')->name('planEstudio.')->controller(PlanEstudioController::class)->group(function () {
    Route::get('/', 'index')->name('index');                      // GET /planes-estudio
    Route::get('/nuevo', 'create')->name('create');                // GET /planes-estudio/nuevo
    Route::post('/', 'store')->name('store');                      // POST /planes-estudio
    Route::get('/{planEstudio:codigo}', 'show')->name('show');            // GET /planes-estudio/{planEstudio:codigo}
    Route::get('/{planEstudio:codigo}/editar', 'edit')->name('edit');    // GET /planes-estudio/{planEstudio:codigo}/editar
    Route::put('/{planEstudio:codigo}', 'update')->name('update');        // PUT /planes-estudio/{planEstudio:codigo}
    Route::delete('/{planEstudio:codigo}', 'destroy')->name('destroy');  // DELETE /planes-estudio/{planEstudio:codigo}
});

// --- Componente Routes ---
// Prefix: /planes-estudio/{planEstudio:codigo}/componentes
// Name prefix: componente.
Route::prefix('planes-estudio/{planEstudio:codigo}/componentes')->name('componente.')->controller(ComponenteController::class)->group(function () {
    Route::get('/nuevo', 'create')->name('create');                             // GET /planes-estudio/{planEstudio:codigo}/componentes/nuevo
    Route::post('/', 'store')->name('store');                                   // POST /planes-estudio/{planEstudio:codigo}/componentes
    Route::get('/{componente}', 'show')->name('show');                          // GET /planes-estudio/{planEstudio:codigo}/componentes/{componente}
    Route::get('/{componente}/editar', 'edit')->name('edit');                   // GET /planes-estudio/{planEstudio:codigo}/componentes/{componente}/editar
    Route::put('/{componente}', 'update')->name('update');                      // PUT /planes-estudio/{planEstudio:codigo}/componentes/{componente}
    Route::delete('/{componente}', 'destroy')->name('destroy');                 // DELETE /planes-estudio/{planEstudio:codigo}/componentes/{componente}
});

// --- Materia Routes ---
// Prefix: /planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias
// Name prefix: materia.
Route::prefix('planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias')->name('materia.')->controller(MateriaController::class)->group(function () {
    Route::get('/nueva', 'create')->name('create');                                      // GET /planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias/nueva
    Route::post('/', 'store')->name('store');                                            // POST /planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias
    Route::get('/{materia}/editar', 'edit')->name('edit');                               // GET /planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias/{materia}/editar
    Route::put('/{materia}', 'update')->name('update');                                  // PUT /planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias/{materia}
    Route::delete('/{materia}', 'destroy')->name('destroy');                             // DELETE /planes-estudio/{planEstudio:codigo}/componentes/{componente}/materias/{materia}
});

Route::prefix('reportes')->group(function () {
    Route::get('/estudiantes', [EstudianteController::class, 'reporteIndex'])->name('reporte.estudiante.index');
    Route::post('/estudiantes', [EstudianteController::class, 'reporteIndex'])->name('reporte.estudiante.index');
    Route::get('/estudiantes/{estudiante}', [EstudianteController::class, 'reporteShow'])->name('reporte.estudiante.show');
});

// RUTAS DE PRUEBA

Route::prefix('pruebas')->group(function () {
    Route::get('/letras-cedula', function () {
        $letrasCedula = App\Models\LetraCedula::orderBy('IDLetraCedula')->select('IDLetraCedula as id', 'letra', 'nombre')->get();
        return view('letrasCedula', ['letrasCedula' => $letrasCedula]);
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

});