<?php

use App\Models\User;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;


// Le decimos a Pest que use el TestCase de Laravel Y que refresque la BD.
uses(Tests\TestCase::class, RefreshDatabase::class);

// --- Pruebas para Páginas Públicas ---

test('la página de bienvenida carga correctamente', function () {
    $this->get('/')
        ->assertOk(); 
});

test('la página de login carga correctamente', function () {
    $this->get('/login')
        ->assertOk()
        ->assertSee('login'); 
});

test('la página de registro carga correctamente', function () {
    $this->get('/register')
        ->assertOk()
        ->assertSee('Register');
});

// --- Pruebas para Páginas Autenticadas (Usuario Normal) ---

test('un usuario autenticado puede ver el dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk();
});

test('un usuario autenticado puede ver la lista de sus turnos', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/turnos') 
        ->assertOk();
});

test('un usuario autenticado puede ver la lista de actividades', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/actividades')
        ->assertOk();
});


// --- Pruebas para Páginas de Administración ---

/**
 * Función helper para crear un usuario Administrador.
 */
function createAdmin() {
    $rolAdmin = Rol::firstOrCreate(['name' => 'Administrador']);
    return User::factory()->create([
        'role_id' => $rolAdmin->id,
    ]);
}

test('un administrador puede ver la lista de usuarios', function () {
    $admin = createAdmin(); 

    $this->actingAs($admin)
        ->get('/admin/usuarios') 
        ->assertOk();
});

test('un administrador puede ver la lista de espacios', function () {
    $admin = createAdmin();

    $this->actingAs($admin)
        ->get('/admin/espacios')
        ->assertOk();
});

test('un administrador puede ver la lista de recursos', function () {
    $admin = createAdmin();

    $this->actingAs($admin)
        ->get('/admin/recursos')
        ->assertOk();
});