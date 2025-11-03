<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        User::create([
            'name'     => 'Francisco Usandivares',
            'email'    => 'francisco.usandivares@educacionadventista.org.ar',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
        User::create([
            'name'     => 'Maximiliano Rive',
            'email'    => 'maximiliano.rive@educacionadventista.org.ar',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
        User::create([
            'name'     => 'Marco Castro',
            'email'    => 'marco.jcv.27@gmail.com',
            'password' => Hash::make('password'),
            'role_id'  => 1,
        ]);
    }
}