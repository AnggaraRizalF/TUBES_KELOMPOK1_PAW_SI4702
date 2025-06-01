<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'anggararf@gmail.com')->exists()) {
            User::create([
                'name' => 'Anggararf',
                'email' => 'anggararf@gmail.com',
                'password' => Hash::make('anggauhuy22'),
                'nim' => null,
                'role' => 'admin',
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }

        if (!User::where('email', 'nabil@gmail.com')->exists()) {
            User::create([
                'name' => 'Nabilathala',
                'email' => 'nabil@gmail.com',
                'password' => Hash::make('nabil22'),
                'role' => 'user',
            ]);
            $this->command->info('Regular user created successfully.');
        } else {
            $this->command->info('Regular user already exists.');
        }
    }
}
