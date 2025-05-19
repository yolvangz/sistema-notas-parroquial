<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('AuxInscripciones', function (Blueprint $table) {
            $table->bigInteger('seccionID')->unsigned();
            $table->bigInteger('estudianteID')->unsigned();
            $table->dateTimeTz('fechaInscripcion')->nullable();

            // Registro modificaciones
            $table->timestampTz('fechaModificado')->nullable();
            $table->softDeletesTz();
            
            $table->foreign('seccionID')->references('IDSeccion')->on('Secciones')->cascadeOnDelete();
            $table->foreign('estudianteID')->references('IDEstudiante')->on('Estudiantes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AuxInscripciones');
    }
};
