<?php

use App\Models\Product;
use App\Models\SharedUnitOfMeasure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        $randomSteatment = (DB::connection()->getName()=='mysql')?'RAND()':((DB::connection()->getName()=='sqlite')?'RANDOM()':'');

        $faker = Faker\Factory::create();
//        $faker->seed(1234);

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        Product::truncate();

        foreach (range(1, 10) as $index) {
            $uomId = SharedUnitOfMeasure::orderBy(DB::raw($randomSteatment))->first()->id;
            Product::create([
                'mandante' => 'teste',
                'uom_id' => $uomId,
                'nome' => $faker->sentence(2),
            ]);
        }

        if (DB::connection()->getName()=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}