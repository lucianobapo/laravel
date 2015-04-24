<?php
use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        if (DB::connection()->getName() == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\Partner::truncate();

        foreach (range(1, 5) as $index) {
            \App\Partner::create([
                'mandante' => 'teste',
                'nome' => $faker->sentence(2),
            ]);
        }

        if (DB::connection()->getName() == 'mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}