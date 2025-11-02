<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        User::create([
            'name'     => 'Maximiliano Usandivares (Admin)',
            'email'    => 'maximiliano.usandivares@colegio.com',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
        User::create([
            'name'     => 'Maximiliano Rive (Admin)',
            'email'    => 'maximiliano.rive@colegio.com',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
        User::create([
            'name'     => 'Marco Castro (Admin)',
            'email'    => 'marco.castro@colegio.com',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
    }
}