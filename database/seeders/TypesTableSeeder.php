<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = [
            [
                'name' => 'uncategorized',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'Front-End',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'Back-End',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'Full-Stack',
                'description' => $faker->words(rand(30, 80), true),
            ],
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
