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
        Schema::create('Representantes', function (Blueprint $table) {
            // datos basicos
            $table->bigIncrements('IDRepresentante');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->tinyInteger('cedulaLetra')->unsigned();
            $table->bigInteger('cedulaNumero', 9)->unsigned();
            $table->enum('genero', ['M', 'F']);
            $table->date('fechaNacimiento');
            $table->string('direccion', 255);
            $table->string('email', 320);
            $table->char('telefonoPrincipal', 13);
            $table->char('telefonoSecundario', 13)->nullable();
            // Rutas de los archivos subidos
            $table->string('fotoPerfilPath', 255)->nullable();
            $table->string('cedulaPath', 255)->nullable();
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Representantes');
    }
};
