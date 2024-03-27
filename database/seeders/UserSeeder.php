<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function() {
            $administrator1 = User::create([
                'name' => 'administrador1',
                'email' => 'correo@administador1.com',
                'password' => '12345'
            ]);

            $administrator2 = User::create([
                'name' => 'administrador2',
                'email' => 'correo@administador2.com',
                'password' => '12345'
            ]);

            $user1 = User::create([
                'name' => 'usuario1',
                'email' => 'correo@usuario1.com',
                'password' => '12345'
            ]);

            $user2 = User::create([
                'name' => 'usuario2',
                'email' => 'correo@usuario2.com',
                'password' => '12345'
            ]);

            $administrator1->assignRole('ADMINISTRATOR');
            $administrator2->assignRole('ADMINISTRATOR');
            $user1->assignRole('USER');
            $user2->assignRole('USER');
        }, 2);
    }
}
