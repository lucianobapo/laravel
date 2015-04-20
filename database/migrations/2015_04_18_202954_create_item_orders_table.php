<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

            /**
             * Mandante do Banco de dados
             */
            $table->string('mandante')->index();

            /**
             * Relacionamentos entre as tabelas
             */
            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('cost_id')->unsigned()->index();
            $table->foreign('cost_id')
                ->references('id')
                ->on('cost_allocates')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->float('quantidade');

            $table->float('valor_unitario');
            $table->float('desconto_unitario');
            $table->integer('currency_id')->unsigned()->index();
            $table->foreign('currency_id')
                ->references('id')
                ->on('shared_currencies')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->text('descricao')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_orders');
	}

}
