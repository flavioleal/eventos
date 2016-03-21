<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProfissionals extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profissionals', function($table)
		{
		    $table->renameColumn('id_profissional', 'id');
		    $table->renameColumn('salario', 'faixa_salarials_id');
			$table->integer('faixa_etarias_id')->unsigned();
		});
		Schema::table('profissionals', function($table)
		{
			//)$table->integer('faixa_salarials_id')->unsigned()->change();
		    DB::statement('ALTER TABLE `profissionals` MODIFY `faixa_salarials_id` INTEGER UNSIGNED;');
		});

		Schema::table('profissionals', function($table)
		{
			$table->foreign('faixa_salarials_id')->references('id')->on('faixa_salarials');
			$table->foreign('faixa_etarias_id')->references('id')->on('faixa_etarias');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
