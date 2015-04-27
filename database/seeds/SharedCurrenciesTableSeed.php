<?php

use App\Models\SharedCurrency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SharedCurrenciesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();
        //$faker->addProvider(new \Faker\Provider\Miscellaneous($faker));
//        $faker->seed(1234);

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        SharedCurrency::truncate();

        foreach (range(1, 10) as $index) {
            SharedCurrency::create([
                'nome_universal' => strtoupper($faker->word(3)),
            ]);
        }

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}