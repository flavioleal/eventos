<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfissionalAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profissional_areas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('profissional_id')->unsigned()->index();
			$table->integer('area_id')->unsigned()->index();
			$table->foreign('profissional_id')->references('id')->on('profissionals');
			$table->foreign('area_id')->references('id')->on('areas');
			
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
		Schema::drop('profissional_areas');
	}

}
