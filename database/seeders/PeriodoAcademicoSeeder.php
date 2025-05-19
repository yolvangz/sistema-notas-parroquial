<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodoAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('PeriodosAcademicos')->insert([
                [
                    'nombre' => '2024-2025',
                    'fecha_inicio' => '2024-10-01',
                    'fecha_fin' => '2025-06-30',
                    'fechaCreado' => now(),
                    'fechaModificado' => now(),
                ],
            ]);
            DB::table('Secciones')->insert([
                [
                    'nombre' => '1er Año Sección A',
                    'codigo' => '1A',
                    'maximoEstudiantes' => 25,
                    'periodoAcademicoID' => 1,
                    'componenteID' => 1,
                    'fechaCreado' => now(),
                    'fechaModificado' => now(),
                ],
                [
                    'nombre' => 'Tercer Año Sección A',
                    'codigo' => '3B',
                    'maximoEstudiantes' => 30,
                    'periodoAcademicoID' => 1,
                    'componenteID' => 3,
                    'fechaCreado' => now(),
                    'fechaModificado' => now(),
                ],
            ]);
        });
    }
}
