<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'uncategorized'
            ],
            [
                'name' => 'html'
            ],
            [
                'name' => 'css'
            ],
            [
                'name' => 'js'
            ],
            [
                'name' => 'vue.js'
            ],
            [
                'name' => 'mySql'
            ],
            [
                'name' => 'php'
            ],
            [
                'name' => 'laravel'
            ],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
