<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Espacio;

class EspacioSeeder extends Seeder
{
    public function run()
    {
        Espacio::create(['name' => 'SUM']);
        Espacio::create(['name' => 'Canchas Exteriores']);
        Espacio::create(['name' => 'Pabellón de Música']);
        Espacio::create(['name' => 'Salón de Actos']);
    }
}