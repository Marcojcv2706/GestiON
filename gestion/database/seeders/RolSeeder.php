<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder {
    public function run() {
        Rol::create(['name' => 'Administrador']);
        Rol::create(['name' => 'Profesor']);
        Rol::create(['name' => 'Usuario']);
    }
}