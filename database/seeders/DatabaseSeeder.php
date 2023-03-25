<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
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

        Category::factory()->has(Product::factory(10))->create([
            'id' => 1,
        ]);

        Category::factory()->has(Product::factory(15))->create([
            'id' => 2,
        ]);

        Category::factory(5)->create([
            'parent_id' => 1,
        ]);

        Category::factory(3)->create([
            'parent_id' => 2,
        ]);
    }
}
