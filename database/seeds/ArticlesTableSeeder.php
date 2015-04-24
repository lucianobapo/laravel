<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    public function run()
    {
        $randomSteatment = (DB::connection()->getName()=='mysql')?'RAND()':((DB::connection()->getName()=='sqlite')?'RANDOM()':'');

        $faker = Faker\Factory::create();
//        $faker->seed(1234);

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\Article::truncate();

        foreach (range(1, 5) as $index) {
            $userId = \App\User::orderBy(DB::raw($randomSteatment))->first()->id;
            $tag = \App\Tag::orderBy(DB::raw($randomSteatment))->first();

            $article = new \App\Article;
            $newArticle = $article->create([
                'user_id' => $userId,
                'title' => $faker->sentence(5),
                'body' => $faker->paragraph(3),
                'published_at' => $faker->date()
            ]);
            $newArticle->tags()->sync([$tag->id,$tag->name]);
        }

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}