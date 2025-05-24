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
        Schema::create('PeriodosAcademicos', function (Blueprint $table) {
            $table->id('IDPeriodoAcademico');
            $table->string('nombre', 50);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            // Registro modificaciones
            $table->dateTimeTz('fechaCreado')->nullable();
            $table->dateTimeTz('fechaModificado')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PeriodosAcademicos');
    }
};
