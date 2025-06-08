<?php

namespace Database\Seeders;

use App\Models\PlanEstudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planMediaGeneral = [
            'nombre' => 'Media General',
            'codigo' => 'MG-2020',
            'descripcion' => 'Plan de estudios para la media general',
            'activo' => true,
        ];
        $componentesMediaGeneral = [
            [
                'nombre' => '1er Año',
                'descripcion' => 'Primer año de la media general',
                'prelaID' => null,
            ],
            [
                'nombre' => '2do Año',
                'descripcion' => 'Segundo año de la media general',
                'prelaID' => null,
            ],
            [
                'nombre' => '3er Año',
                'descripcion' => 'Tercer año de la media general',
                'prelaID' => null,
            ],
            [
                'nombre' => '4to Año',
                'descripcion' => 'Cuarto año de la media general',
                'prelaID' => null,
            ],
            [
                'nombre' => '5to Año',
                'descripcion' => 'Quinto año de la media general',
                'prelaID' => null,
            ],
        ];
        $materiasMediaGeneral = [
            [[
                'nombre' => 'Castellano',
                'descripcion' => 'Castellano para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Inglés y otras Lenguas Extranjeras',
                'descripcion' => 'Inglés y otras Lenguas Extranjeras para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Matemáticas',
                'descripcion' => 'Matemáticas para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Educación Física',
                'descripcion' => 'Educación Física para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Arte y Patrimonio',
                'descripcion' => 'Arte y Patrimonio para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Ciencias Naturales',
                'descripcion' => 'Ciencias Naturales para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Geografía, Historia y Ciudadanía',
                'descripcion' => 'Geografía, Historia y Ciudadanía para el primer año',
                'cualitativa' => false,
                'calcular' => true,
            ],],
            [[
                'nombre' => 'Castellano',
                'descripcion' => 'Castellano para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Inglés y otras Lenguas Extranjeras',
                'descripcion' => 'Inglés y otras Lenguas Extranjeras para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Matemáticas',
                'descripcion' => 'Matemáticas para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Educación Física',
                'descripcion' => 'Educación Física para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Arte y Patrimonio',
                'descripcion' => 'Arte y Patrimonio para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Ciencias Naturales',
                'descripcion' => 'Ciencias Naturales para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Geografía, Historia y Ciudadanía',
                'descripcion' => 'Geografía, Historia y Ciudadanía para el segundo año',
                'cualitativa' => false,
                'calcular' => true,
            ],],
            [[
                'nombre' => 'Castellano',
                'descripcion' => 'Castellano para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Inglés y otras Lenguas Extranjeras',
                'descripcion' => 'Inglés y otras Lenguas Extranjeras para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Matemáticas',
                'descripcion' => 'Matemáticas para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
             [
                'nombre' => 'Física',
                'descripcion' => 'Física para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Química',
                'descripcion' => 'Química para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Biología',
                'descripcion' => 'Biología para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Geografía, Historia y Ciudadanía',
                'descripcion' => 'Geografía, Historia y Ciudadanía para el tercer año',
                'cualitativa' => false,
                'calcular' => true,
            ],],
            [[
                'nombre' => 'Castellano',
                'descripcion' => 'Castellano para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Inglés y otras Lenguas Extranjeras',
                'descripcion' => 'Inglés y otras Lenguas Extranjeras para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Matemáticas',
                'descripcion' => 'Matemáticas para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Física',
                'descripcion' => 'Física para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Química',
                'descripcion' => 'Química para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Biología',
                'descripcion' => 'Biología para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Geografía, Historia y Ciudadanía',
                'descripcion' => 'Geografía, Historia y Ciudadanía para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Formación para la Soberanía Nacional',
                'descripcion' => 'Formación para la Soberanía Nacional para el cuarto año',
                'cualitativa' => false,
                'calcular' => true,
            ],],
            [[
                'nombre' => 'Castellano',
                'descripcion' => 'Castellano para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Inglés y otras Lenguas Extranjeras',
                'descripcion' => 'Inglés y otras Lenguas Extranjeras para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Matemáticas',
                'descripcion' => 'Matemáticas para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Física',
                'descripcion' => 'Física para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Química',
                'descripcion' => 'Química para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Biología',
                'descripcion' => 'Biología para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Geografía, Historia y Ciudadanía',
                'descripcion' => 'Geografía, Historia y Ciudadanía para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],
            [
                'nombre' => 'Formación para la Soberanía Nacional',
                'descripcion' => 'Formación para la Soberanía Nacional para el quinto año',
                'cualitativa' => false,
                'calcular' => true,
            ],],
        ];
        DB::transaction(function () use ($planMediaGeneral, $componentesMediaGeneral, $materiasMediaGeneral) {
            // Insertar el plan de estudios
            $mediaGeneral = PlanEstudio::updateOrCreate(
                ['codigo' => $planMediaGeneral['codigo']],
                $planMediaGeneral,
            );
            foreach ($componentesMediaGeneral as $iterator => $componente) {
                $componenteDeTurno = $mediaGeneral->componentes()->updateOrCreate(
                    ['nombre' => $componente['nombre'], 'planEstudioID' => $mediaGeneral->IDPlanEstudio],
                    $componente
                );
                foreach ($materiasMediaGeneral[$iterator] as $materia) {
                    $componenteDeTurno->materias()->updateOrCreate(
                        ['nombre' => $materia['nombre'], 'componenteID' => $componenteDeTurno->IDComponente],
                        $materia
                    );
                }
            }
        });
    }
}
