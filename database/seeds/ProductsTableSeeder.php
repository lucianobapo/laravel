<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();
//        $faker->seed(1234);

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\Product::truncate();

        foreach (range(1, 10) as $index) {
            \App\Product::create([
                'mandante' => 'teste',
                'nome' => $faker->sentence(2),
            ]);
        }

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}