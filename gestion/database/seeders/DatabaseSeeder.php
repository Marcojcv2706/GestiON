<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolSeeder::class,
            UserSeeder::class, 
            RecursoSeeder::class,
            EspacioSeeder::class,
            SubEspacioSeeder::class,
            ActividadSeeder::class,
            TurnoSeeder::class,
        ]);
    }
}