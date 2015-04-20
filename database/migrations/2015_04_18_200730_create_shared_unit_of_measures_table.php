<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharedUnitOfMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shared_unit_of_measures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

            $table->string('uom');
            $table->string('descricao');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shared_unit_of_measures');
	}

}
