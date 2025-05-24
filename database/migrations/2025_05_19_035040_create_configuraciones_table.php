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
        Schema::create('Configuraciones', function (Blueprint $table) {
            $table->tinyIncrements('IDConfiguracion');
            $table->tinyInteger('institucionID')->unsigned();

            // Calificacion Cuantitativa
            $table->decimal('calificacionNumericaMinima', 6, 2)->unsigned();
            $table->decimal('calificacionNumericaMaxima', 6, 2)->unsigned();
            $table->decimal('calificacionNumericaAprobatoria', 6, 2)->unsigned();
            // Calificacion Cualitativa
            $table->json('calificacionCualitativaLiterales');
            $table->integer('calificacionCualitativaAprobatoria')->unsigned();
            // Registro modificaciones
            $table->dateTimeTz('fechaCreado')->nullable();
            $table->dateTimeTz('fechaModificado')->nullable();

            $table->foreign('institucionID')
                ->references('IDInstitucion')
                ->on('Instituciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Configuraciones');
    }
};
