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
        Schema::create('AuxAsignacionMaterias', function (Blueprint $table) {
            $table->bigInteger('seccionID')->unsigned();
            $table->bigInteger('materiaID')->unsigned();
            $table->bigInteger('profesorID')->unsigned();

            // Registro modificaciones
            $table->timestampTz('fechaCreado')->nullable();
            $table->timestampTz('fechaModificado')->nullable();
            $table->softDeletesTz();

            $table->foreign('seccionID')->references('IDSeccion')->on('Secciones')->cascadeOnDelete();
            $table->foreign('materiaID')->references('IDMateria')->on('Materias')->cascadeOnDelete();
            $table->foreign('profesorID')->references('IDProfesor')->on('Profesores')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AuxAsignacionMaterias');
    }
};
