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
        Schema::create('Instituciones', function (Blueprint $table) {
            $table->tinyIncrements('IDInstitucion');
            $table->string('nombre', 250);
            $table->tinyInteger('letraRif')->unsigned();
            $table->bigInteger('numeroRif')->unsigned()->unique();
            $table->string('direccion', 150);
            $table->string('telefono', 13);
            $table->string('logoPath', 255)->nullable();
            // Registro modificaciones
            $table->dateTimeTz('fechaCreado')->nullable();
            $table->dateTimeTz('fechaModificado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Instituciones');
    }
};
