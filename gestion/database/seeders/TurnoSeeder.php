<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turno;
use Carbon\Carbon;

class TurnoSeeder extends Seeder
{
    public function run(): void
    {
        Turno::create([
            'description'    => 'Reserva para entrenamiento de Voley',
            'start_time'     => Carbon::now()->addDays(2)->setHour(18),
            'end_time'       => Carbon::now()->addDays(2)->setHour(19),
            'user_id'        => 2,
            'actividad_id'   => 1, 
            'sub_espacio_id' => 1,
            'espacio_id'     => 1,
            'recurso_id'     => 2, 
        ]);
    }
}