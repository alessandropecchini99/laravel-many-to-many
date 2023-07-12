<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Type;
use App\Models\Technology;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all();
        $types->shift();

        // pluck scompatta l'array scelto per poter associare i valori
        $technologies = Technology::all()->pluck('id');

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->words(rand(2, 7), true);   // Un bel Titolo
            $slug = Post::slugger($title);              // un-bel-titolo

            $post = Post::create([
                'type_id'       => $faker->randomElement($types)->id,
                'title'         => $title,
                'slug'          => $slug,
                'url_image'     => 'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
                'content'       => $faker->paragraph(rand(2, 20), true),
            ]);

            // associare il post ad un certo numero di technologies
            $post->technologies()->sync($faker->randomElement($technologies, null));
        }
    }
}
