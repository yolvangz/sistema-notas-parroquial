<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParroquialConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('Instituciones')->upsert([
                'nombre' => 'Unidad Educativa Colegio "Parroquial Punta Cardón"',
                'letraRifID' => DB::table('LetrasCedula')->where('letra', 'J')->value('IDLetraCedula'),
                'numeroRif' => 123456789,
                'direccion' => 'Calle Zamora, Punta Cardón',
                'telefono' => '212-1234567',
                'logoPath' => null,
            ], ['IDInstitucion'], ['nombre', 'letraRifID', 'numeroRif', 'direccion', 'telefono', 'logoPath']);
            DB::table('Configuraciones')->upsert([
                'institucionID' => 1,
                'calificacionNumericaMinima' => 0,
                'calificacionNumericaMaxima' => 20,
                'calificacionNumericaAprobatoria' => 10,
                'calificacionCualitativaLiterales' => json_encode([
                    ['letra' => 'A', 'descripcion' => null],
                    ['letra' => 'B', 'descripcion' => null],
                    ['letra' => 'C', 'descripcion' => null],
                    ['letra' => 'D', 'descripcion' => null],
                ]),
                'calificacionCualitativaAprobatoria' => 1,
            ], ['IDConfiguracion'], [ 
                'institucionID',
                'calificacionNumericaMinima',
                'calificacionNumericaMaxima',
                'calificacionNumericaAprobatoria',
                'calificacionCualitativaLiterales',
                'calificacionCualitativaAprobatoria',
            ]);
        });
    }
}
