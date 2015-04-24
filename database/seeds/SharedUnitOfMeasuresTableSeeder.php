<?php
use Illuminate\Database\Seeder;

class SharedUnitOfMeasuresTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        if (DB::connection()->getName() == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\SharedUnitOfMeasure::truncate();

        foreach (range(1, 5) as $index) {
            \App\SharedUnitOfMeasure::create([
                'uom' => strtoupper($faker->word(2)),
                'descricao' => $faker->sentence(2),
            ]);
        }

        if (DB::connection()->getName() == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}