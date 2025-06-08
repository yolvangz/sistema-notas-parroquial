<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Institucion;

class ParroquialConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $institucion = Institucion::updateOrCreate(
            ['IDInstitucion' => 1],
            [
                'nombre' => 'Unidad Educativa Colegio "Parroquial Punta Cardón"',
                'letraRifID' => DB::table('LetrasCedula')->where('letra', 'J')->value('IDLetraCedula'),
                'numeroRif' => 123456789,
                'direccion' => 'Calle Zamora, Punta Cardón',
                'telefono' => '+58 212-1234567',
                'logoPath' => 'institucion/logo.jpg',
            ]);
            $institucion->configuracion()->updateOrCreate([
                'institucionID' => $institucion->IDInstitucion,
            ], [
                'calificacionNumericaMinima' => 0,
                'calificacionNumericaMaxima' => 20,
                'calificacionNumericaAprobatoria' => 10,
                'calificacionCualitativaLiterales' => [
                    ['letra' => 'A', 'descripcion' => 'Excelente'],
                    ['letra' => 'B', 'descripcion' => 'Muy Bien'],
                    ['letra' => 'C', 'descripcion' => 'Bien'],
                    ['letra' => 'D', 'descripcion' => 'Necesita Mejorar'],
                    ['letra' => 'E', 'descripcion' => 'Deficiente'],
                ],
                'calificacionCualitativaAprobatoria' => 4, // 'Necesita mejorar' es la calificación mínima aprobatoria
            ]);
        });
    }
}
