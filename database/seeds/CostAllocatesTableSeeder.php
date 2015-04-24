<?php
use Illuminate\Database\Seeder;

class CostAllocatesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        if (DB::connection()->getName() == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\CostAllocate::truncate();

        foreach (range(1, 5) as $index) {
            \App\CostAllocate::create([
                'mandante' => 'teste',
                'numero' => $faker->randomNumber(2),
                'nome' => ucfirst($faker->word),
                'descricao' => $faker->sentence(2),
            ]);
        }

        if (DB::connection()->getName() == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}