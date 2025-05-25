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
        Schema::create('Materias', function (Blueprint $table) {
            $table->id('IDMateria');
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->bigInteger('componenteID')->unsigned();
            $table->boolean('cualitativa')->default(false);
            $table->boolean('calcular')->default(true);

            // Registro modificaciones
            $table->dateTimeTz('fechaCreado')->nullable();
            $table->dateTimeTz('fechaModificado')->nullable();
            $table->softDeletesTz();

            // Foreign key constraints
            $table->foreign('componenteID')
                ->references('IDComponente')
                ->on('Componentes')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Materias');
    }
};
