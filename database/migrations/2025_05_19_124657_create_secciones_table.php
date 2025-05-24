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
        Schema::create('Secciones', function (Blueprint $table) {
            $table->id('IDSeccion');
            $table->string('nombre', 50);
            $table->string('codigo', 10)->unique();
            $table->tinyInteger('maximoEstudiantes')->unsigned()->default(0);
            $table->bigInteger('periodoAcademicoID')->unsigned();
            $table->bigInteger('componenteID')->unsigned();
            $table->bigInteger('profesorGuiaID')->unsigned()->nullable();
            // Registro modificaciones
            $table->dateTimeTz('fechaCreado')->nullable();
            $table->dateTimeTz('fechaModificado')->nullable();
            $table->softDeletesTz();

            // Claves foráneas
            $table->foreign('periodoAcademicoID')->references('IDPeriodoAcademico')->on('PeriodosAcademicos')->restrictOnDelete();
            $table->foreign('componenteID')->references('IDComponente')->on('Componentes')->restrictOnDelete();
            $table->foreign('profesorGuiaID')->references('IDProfesor')->on('Profesores')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Secciones');
    }
};
