<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

            $table->string('mandante')->index();

            $table->integer('uom_id')->unsigned()->index();
            $table->foreign('uom_id')
                ->references('id')
                ->on('shared_unit_of_measures')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('nome');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
