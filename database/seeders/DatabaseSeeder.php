<?php

namespace Database\Seeders;

use App\Models\AnimalType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Receptionist',
            'email' => 'receptionist@example.com',
            'role' => 'receptionist',
        ]);

        User::factory()->create([
            'name' => 'Doctor One',
            'email' => 'doctorone@example.com',
            'role' => 'doctor',
        ]);

        User::factory()->create([
            'name' => 'Doctor Two',
            'email' => 'doctortwo@example.com',
            'role' => 'doctor',
        ]);

        AnimalType::factory()->create([
            'name' => 'Dog',
        ]);

        AnimalType::factory()->create([
            'name' => 'Cat',
        ]);
    }
}
