<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaixaEtariasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faixa_etarias', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('faixa_etaria');
			$table->integer('min_idade');
			$table->integer('max_idade');
			$table->boolean('ativo')->default(1);
			$table->timestamps();
		});

		DB::table('faixa_etarias')->insert(
			array(
				array(
					'faixa_etaria'	=>'Até 25 anos',
					'min_idade'		=>0,
					'max_idade'		=>25,
					'ativo'			=>1
				),
				array(
					'faixa_etaria'	=>'De 26 até 30 anos',
					'min_idade'		=>26,
					'max_idade'		=>30,
					'ativo'			=>1
				),
				array(
					'faixa_etaria'	=>'De 31 até 35 anos',
					'min_idade'		=>31,
					'max_idade'		=>35,
					'ativo'			=>1
				),
				array(
					'faixa_etaria'	=>'De 36 até 40 anos',
					'min_idade'		=>36,
					'max_idade'		=>40,
					'ativo'			=>1
				),
				array(
					'faixa_etaria'	=>'Acima de 40 anos',
					'min_idade'		=>41,
					'max_idade'		=>99,
					'ativo'			=>1
				)
			)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profissionals',function($table){
			$table->dropForeign('profissionals_faixa_etarias_id_foreign');
		});
		Schema::drop('faixa_etarias');
	}

}
