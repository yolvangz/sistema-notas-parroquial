<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profesores;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/letras-cedula', function () {
    $letrasCedula = DB::table('letrasCedula')->orderBy('IDLetraCedula')->select('IDLetraCedula as id', 'letra', 'nombre')->get();
    return view('letrasCedula', ['letrasCedula' => $letrasCedula]);
});

Route::controller(Profesores::class)->group(function () {
    Route::prefix('profesores')->group(function () {
        Route::get('/', 'index')->name('profesores.index');
        Route::get('/nuevo', 'create')->name('profesores.create');
        Route::post('/', 'store')->name('profesores.store');
        Route::get('/{id}', 'show')->name('profesores.show');
        Route::get('/{id}/editar', 'edit')->name('profesores.edit');
        Route::put('/{id}', 'update')->name('profesores.update');
        Route::delete('/{id}', 'destroy')->name('profesores.destroy');
    });
});