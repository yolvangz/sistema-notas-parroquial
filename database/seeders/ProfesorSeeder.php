<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Insertar un profesor de ejemplo
            $profesorId = DB::table('Profesores')->insertGetId([
                'nombres' => 'Juan',
                'apellidos' => 'González',
                'cedulaLetra' => DB::table('LetrasCedula')->where('letra', 'V')->value('IDLetraCedula'),
                'cedulaNumero' => 12345678,
                'genero' => 'M',
                'fechaNacimiento' => '1980-01-01',
                'fechaIngreso' => '2020-01-01',
                'direccion' => 'Calle Principal, Ciudad',
                'email' => 'profesor@colegio.com',
                'telefonoPrincipal' => '+582121234567',
                'fechaCreado' => now(),
                'fechaModificado' => now(),
            ]);
            $seccion1A = DB::table('Secciones')
                ->select('IDSeccion as id', 'componenteID as componenteId')
                ->where('codigo', '1A')
                ->first();

            $materiaId = DB::table('Materias')
                ->where('componenteID', $seccion1A->componenteId)
                ->where('nombre', 'Matemáticas')
                ->value('IDMateria');

            // Asignar al profesor como guía de la sección A1
            DB::table('Secciones')
            ->where('IDSeccion', $seccion1A->id)
            ->update([
                'profesorGuiaID' => $profesorId,
                'fechaModificado' => now(),
            ]);
            
            // Relacionar al profesor con la sección A1 como profesor de matemáticas
            DB::table('AuxAsignacionMaterias')->insert([
                'profesorID' => $profesorId,
                'seccionID' => $seccion1A->id,
                'materiaID' => $materiaId,
                'fechaCreado' => now(),
                'fechaModificado' => now(),
            ]);
        });
    }
}