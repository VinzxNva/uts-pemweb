<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Akun Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Akun User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
    }
}