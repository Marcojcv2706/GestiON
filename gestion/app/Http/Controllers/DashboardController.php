<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\User;
use App\Models\Espacio; // <-- ¡LÍNEA AÑADIDA AQUÍ! Asegúrate de que esta línea esté presente

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard principal de la aplicación.
     */
    public function index()
    {
        // 1. BUSCAMOS LOS PRÓXIMOS 5 TURNOS:
        $proximosTurnos = Turno::with(['user', 'actividad', 'subEspacio'])
                                ->where('start_time', '>=', now())
                                ->orderBy('start_time', 'asc')
                                ->take(5)
                                ->get();

        // 2. OBTENEMOS ESTADÍSTICAS
        $totalUsuarios = User::count();
        $totalEspacios = Espacio::count(); // Ahora PHP sabe qué clase es 'Espacio'
        $turnosHoy = Turno::whereDate('start_time', today())->count();

        // 3. PASAMOS TODO A LA VISTA
        return view('dashboard', [
            'proximosTurnos' => $proximosTurnos,
            'totalUsuarios' => $totalUsuarios,
            'totalEspacios' => $totalEspacios,
            'turnosHoy' => $turnosHoy,
        ]);
    }

    // Tu método testTurnos() si aún lo tienes...
    public function testTurnos()
    {
        $proximosTurnos = Turno::with(['user', 'actividad', 'subEspacio'])
                                ->where('start_time', '>=', now())
                                ->orderBy('start_time', 'asc')
                                ->take(5)
                                ->get();
        dd($proximosTurnos);
    }
}