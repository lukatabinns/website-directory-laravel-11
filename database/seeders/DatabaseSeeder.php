<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Website;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Category::factory()->count(10)->create();

        Website::factory()->count(100)->create()->each(function ($website) {
            $categories = Category::all()->random(rand(1, 3))->pluck('id');
            $website->categories()->attach($categories);
        });
    }
}
