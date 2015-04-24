<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            //$table->softDeletes();

            $table->string('mandante')->index();

            /**
             * Relacionamentos entre as tabelas
             */
            $table->integer('partner_id')->unsigned()->index();
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('currency_id')->unsigned()->index();
            $table->foreign('currency_id')
                ->references('id')
                ->on('shared_currencies')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('order_type_id')->unsigned()->index();
            $table->foreign('order_type_id')
                ->references('id')
                ->on('shared_order_types')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('order_payment_id')->unsigned()->index();
            $table->foreign('order_payment_id')
                ->references('id')
                ->on('shared_order_payments')
                ->onDelete('restrict')
                ->onUpdate('cascade');


            $table->float('valor_total');
            $table->float('desconto_total');

//            $table->enum('tipo_da_ordem', [
//                'orcamentoVenda',
//                'orcamentoServico',
//                'producao',
//                'venda',
//                'servico',
//                'compra',
//                'consumo'
//            ]);
//            $table->enum('tipo_do_pagamento', [
//                'pagseguro',
//                'fiado',
//                'vistad',
//                'vistacc',
//                'vistacd',
//                'parcelado'
//            ]);

            $table->text('descricao')->nullable();
            $table->string('referencia')->nullable();
            $table->string('obsevacao')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
