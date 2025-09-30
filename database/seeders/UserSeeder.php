<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@acme.com',
            'password' => Hash::make('admin123'),
            'phone' => '081370021414',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Dania Laras',
            'email' => 'dania@acme.com',
            'password' => Hash::make('admin1234'),
            'phone' => '081370021414',
            'role' => 'author',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Laras A',
            'email' => 'laras@acme.com',
            'password' => Hash::make('laras123'),
            'phone' => '081370021414',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

    }
}