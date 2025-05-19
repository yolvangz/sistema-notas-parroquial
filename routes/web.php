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