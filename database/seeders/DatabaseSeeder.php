<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@none.no',
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@none.no',
            'role' => User::ROLE_CUTOMER,
        ]);
    }
}
