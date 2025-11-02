<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Devolverá `true` si el usuario está logueado y su rol es 'Administrador'.
        Gate::define('es-admin', function (User $user) {
        // Primero, nos aseguramos de que el usuario TENGA un rol.
        // Si $user->rol es null, la comprobación se detiene y devuelve false.
        return $user->rol && $user->rol->name === 'Administrador';
    });
        
        // Podrías definir más Gates aquí
        Gate::define('es-profesor', function (User $user) {
            return $user->rol->name === 'Profesor';
        });
    }
}