<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actividad;

class ActividadSeeder extends Seeder
{
    public function run(): void
    {
        
        Actividad::create([
            'name'           => 'Entrenamiento de Voley Femenino',
            'description'    => 'Práctica semanal del equipo.',
            'sub_espacio_id' => 1, 
            'user_id'        => 2, 
        ]);

        Actividad::create([
            'name'           => 'Clase de Educación Física 5to Año',
            'description'    => 'Clase regular.',
            'sub_espacio_id' => 3, 
            'user_id'        => 2,
        ]);
    }
}