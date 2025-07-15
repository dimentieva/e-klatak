<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
    ** Run the database seeds.
     */
    public function run(): void
    {
      // Admin
    User::create([
        'name' => 'Bela',
        'email' => 'bela@gmail.com',
        'password' => Hash::make('123456789'),
        'role' => 'admin',
    ]);

    // Kasir
    User::create([
        'name' => 'Imelda',
        'email' => 'imelda@gmail.com',
        'password' => Hash::make('123456789'),
        'role' => 'kasir',
    ]);
    }
}
