<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubEspacio;

class SubEspacioSeeder extends Seeder
{
    public function run()
    {
        // Subespacios del SUM (espacio_id = 1)
        SubEspacio::create(['espacio_id' => 1, 'name' => 'Cancha Voley 1']);
        SubEspacio::create(['espacio_id' => 1, 'name' => 'Cancha Voley 2']);
        SubEspacio::create(['espacio_id' => 1, 'name' => 'Cancha Futbol 5']);
        SubEspacio::create(['espacio_id' => 1, 'name' => 'Cancha Basquet']);

        // Subespacios de Canchas Exteriores (espacio_id = 2)
        SubEspacio::create(['espacio_id' => 2, 'name' => 'Cancha Futbol 11']);
        SubEspacio::create(['espacio_id' => 2, 'name' => 'Cancha Tenis']);
    }
}