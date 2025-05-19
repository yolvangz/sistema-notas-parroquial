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
        Schema::create('Componentes', function (Blueprint $table) {
            $table->id('IDComponente');
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->bigInteger('planEstudioID')->unsigned();
            $table->bigInteger('prelaID')->unsigned()->nullable();
            
            // Registro modificaciones
            $table->timestampTz('fechaCreado')->nullable();
            $table->timestampTz('fechaModificado')->nullable();
            $table->softDeletesTz();

            // Foreign key constraints
            $table->foreign('planEstudioID')
                ->references('IDPlanEstudio')
                ->on('PlanesDeEstudios')
                ->cascadeOnDelete();

            $table->foreign('prelaID')
                ->references('IDComponente')
                ->on('Componentes')
                ->noActionOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Componentes');
    }
};
