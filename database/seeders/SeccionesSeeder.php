<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profesorId = DB::table('Profesores')->where('cedulaNumero', '12345678')->value('IDProfesor');
        DB::transaction(function () {
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
