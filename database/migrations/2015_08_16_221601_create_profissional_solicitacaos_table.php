<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfissionalSolicitacaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profissional_solicitacaos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profissional_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			
			$table->integer('operator_id')->unsigned()->index()->nullable();
			$table->foreign('profissional_id')->references('id')->on('profissionals');

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('operator_id')->references('id')->on('users');

			$table->boolean('status')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profissional_solicitacaos');
	}

}
