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
            DB::table('Profesores')->insert([
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
        });
    }
}