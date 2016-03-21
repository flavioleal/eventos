<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVProfissionalAreaSolicitacaosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::create('v_profissional_area_solicitacaos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
		});*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		#Schema::drop('v_profissional_area_solicitacaos');
	}

}
