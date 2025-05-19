<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('PlanesDeEstudios', function (Blueprint $table) {
            $table->id('IDPlanEstudio');
            $table->string('nombre', 100);
            $table->string('codigo', 50);
            $table->string('descripcion', 255)->nullable();
            $table->boolean('activo')->default(true);

            // Registro modificaciones
            $table->timestampTz('fechaCreado')->nullable();
            $table->timestampTz('fechaModificado')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('PlanesDeEstudios');
    }
};
