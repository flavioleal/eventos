<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfissionalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
	public function up()
	{
		Schema::create('profissionals', function(Blueprint $table)
		{
			$table->increments('id_profissional');
			$table->string('cod_job',250);
			$table->timestamp('data_inclusao');
			$table->timestamp('data_expiracao');
			$table->string('profissao',250);
			$table->string('cargo',250);
			$table->decimal('salario',10,2);
			$table->string('sinopse',8000);
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
		Schema::drop('profissionals');
	}

}
