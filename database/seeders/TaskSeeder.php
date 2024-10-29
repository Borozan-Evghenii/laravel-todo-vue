<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Testing\Fakes\Fake;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $categoryIds = Category::pluck('id')->toArray();


        for ($i = 0; $i < 50; $i++) {
            Task::create([
                'title' => $faker->sentence,
                'completed' => $faker->boolean,
                'categoryId' => $faker->randomElement($categoryIds)
            ]);
        };
    }
}
