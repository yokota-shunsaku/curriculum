<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        for($i = 0; $i < 10; $i++){
            Post::create([
                'user_id' => $faker->numberBetween(2,11),
                'body' => $faker->realText($maxNbChars = 20),
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisMonth
            ]);
        }
    }
}
