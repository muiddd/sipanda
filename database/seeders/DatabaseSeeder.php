<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin Sipanda',
            'email' => 'admin@sipanda.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // 
        ]);


        User::create([
            'name' => 'Siswa Sipanda',
            'email' => 'siswa1@sipanda.com',
            'password' => Hash::make('password'),
            'role' => 'user', 
        ]);
    }
}
