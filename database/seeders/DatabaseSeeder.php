<?php

namespace Database\Seeders;

use App\Models\Category;
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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        //     Category::factory()->create([
        //         'name' => 'Chaussure',
        //         'image' => asset('assets/images/banner/chaussures.png'),
        //         'is_visible' => true,
        //         'description' => fake()->sentence(),
        //     ]);
    }
}
