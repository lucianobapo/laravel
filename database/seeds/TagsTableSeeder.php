<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();
//        $faker->seed(1234);

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\Tag::truncate();

        foreach (range(1, 5) as $index) {
            \App\Tag::create([
                'name' => $faker->word
            ]);
        }

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}