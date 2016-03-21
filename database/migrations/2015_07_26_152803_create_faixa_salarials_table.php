<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaixaSalarialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('faixa_salarials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('faixa_salarial',250);
			$table->decimal('min_salario',10,2);
			$table->decimal('max_salario',10,2);
			$table->boolean('ativo')->default(1);
			$table->timestamps();
		});

		DB::table('faixa_salarials')->insert(
			array(
				array(
					'faixa_salarial'	=>'Até 2.500,00',
					'min_salario'		=>0,
					'max_salario'		=>2500.00,
					'ativo'				=>1
				),
				array(
					'faixa_salarial'	=>'De 2.500,01 até 5.000,00',
					'min_salario'		=>2500.01,
					'max_salario'		=>5000.00,
					'ativo'				=>1
				),
				array(
					'faixa_salarial'	=>'De 5.000,01 até 10.000,00',
					'min_salario'		=>5000.01,
					'max_salario'		=>10000.00,
					'ativo'				=>1
				),
				array(
					'faixa_salarial'	=>'De 10.000,01 até 20.000,00',
					'min_salario'		=>10000.01,
					'max_salario'		=>20000.00,
					'ativo'				=>1
				),
				array(
					'faixa_salarial'	=>'Acima de 20.000,01',
					'min_salario'		=>20000.01,
					'max_salario'		=>1000000.00,
					'ativo'				=>1
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
			$table->dropForeign('profissionals_faixa_salarials_id_foreign');
		});
		Schema::drop('faixa_salarials');
	}

}
