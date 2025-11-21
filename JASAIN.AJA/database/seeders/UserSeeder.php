<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;                 
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'Pelanggan 1',
            'email' => 'pelangan@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);
    }
}
