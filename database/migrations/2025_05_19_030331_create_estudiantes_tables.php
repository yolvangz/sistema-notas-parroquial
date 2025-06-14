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
        Schema::create('Estudiantes', function (Blueprint $table) {
            $table->id('IDEstudiante');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->tinyInteger('cedulaLetra')->unsigned();
            $table->bigInteger('cedulaNumero')->unsigned();
            $table->enum('genero', ['M', 'F']);
            $table->date('fechaNacimiento');
            $table->string('direccion', 255);
            // Rutas de los archivos subidos
            $table->string('fotoPerfilPath', 255)->nullable();
            $table->string('cedulaPath', 255)->nullable();
            $table->string('partidaNacimientoPath', 255)->nullable();
            // Registro modificaciones
            $table->timestampTz('fechaCreado')->nullable();
            $table->timestampTz('fechaModificado')->nullable();
            $table->softDeletesTz();

            // llaves foraneas
            $table->foreign('cedulaLetra')
                ->references('IDLetraCedula')
                ->on('LetrasCedula')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Indices
            $table->index(['nombres', 'apellidos'], 'idx_nombres_apellidos');
            $table->unique(['cedulaLetra', 'cedulaNumero'], 'idx_cedula');
        });
        Schema::create('AuxRepresentantesDelEstudiante', function (Blueprint $table) {
            $table->bigInteger('representanteID')->unsigned();
            $table->bigInteger('estudianteID')->unsigned();
            $table->boolean('representantePrincipal')->default(false);
            // llaves foraneas
            $table->foreign('representanteID')
                ->references('IDRepresentante')
                ->on('Representantes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('estudianteID')
                ->references('IDEstudiante')
                ->on('Estudiantes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Indices
            $table->unique(['representanteID', 'estudianteID'], 'idx_representante_estudiante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AuxRepresentantesDelEstudiante');
        Schema::dropIfExists('Estudiantes');
    }
};
