<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->timestamps();
            $table->integer('cep')->unsigned();
            $table->text('logradouro');
            $table->text('bairro')->nullable();
            $table->text('cidade')->nullable();
            $table->text('estado')->nullable();
            $table->text('pais')->nullable();
            $table->text('obs')->nullable();
            $table->boolean('principal');
            $table->boolean('cancelado');


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
