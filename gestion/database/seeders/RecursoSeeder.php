<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recurso;

class RecursoSeeder extends Seeder
{
    public function run()
    {
        Recurso::create(['name' => 'Proyector Aula 101']);
        Recurso::create(['name' => 'Equipo de Sonido SUM']);
        Recurso::create(['name' => 'Kit de Laboratorio de Química']);
    }
}