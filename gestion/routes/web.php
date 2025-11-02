<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubEspacioController;

// --- RUTAS PÚBLICAS ---
Route::get('/', function () {
    return view('welcome');
});

// --- RUTAS PARA USUARIOS AUTENTICADOS (CUALQUIER ROL) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('turnos', TurnoController::class);
    Route::resource('actividades', ActividadController::class);


    // --- RUTAS SOLO PARA ADMINISTRADORES ---
    Route::middleware(['can:es-admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/panel', function() {
            return "Bienvenido al Panel de Administrador"; 
        })->name('panel');

        Route::resource('espacios', EspacioController::class);
        Route::resource('recursos', RecursoController::class);
        Route::resource('subespacios', SubEspacioController::class);
        Route::resource('usuarios', UserController::class);
    });

});


require __DIR__.'/auth.php';