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
                'name' => 'politica',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'attualità',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'informatica',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'letteratura',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'cucina',
                'description' => $faker->words(rand(30, 80), true),
            ],
            [
                'name' => 'videogiochi',
                'description' => $faker->words(rand(30, 80), true),
            ],
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
