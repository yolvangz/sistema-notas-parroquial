<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LetrasCedulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letrasCedula = [
            ['letra' => 'V', 'nombre' => 'Venezolano'],
            ['letra' => 'E', 'nombre' => 'Extranjero'],
            // ['letra' => 'P', 'nombre' => 'Pasaporte'],
            // ['letra' => 'G', 'nombre' => 'Grupo Familiar'],
            ['letra' => 'J', 'nombre' => 'Jurídico'],
            ['letra' => 'T', 'nombre' => 'Generado por el sistema'],
        ];
        DB::table('letrasCedula')->upsert($letrasCedula, ['letra'], ['nombre']);
    }
}
