<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->seed(1234);

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        \App\User::truncate();

        foreach (range(1, 10) as $index) {
            \App\User::create([
                'mandante' => 'teste',
                'name'=> $faker->name,
                'email'=> $faker->email,
                'password' => bcrypt('1234')
            ]);
        }

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}