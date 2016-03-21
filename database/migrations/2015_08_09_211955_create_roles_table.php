<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',40);
			$table->string('description',255);
			$table->timestamps();
		});

        DB::table('roles')->insert(
        	array(
		        array(
		            'id'            => 1,
		            'name'          => 'Master',
		            'description'   => 'Use essa conta com extrema cautela. Ao usar esta conta é possível causar danos irreversíveis ao sistema.'
		        ),
		        array(
		            'id'            => 2,
		            'name'          => 'Administrador',
		            'description'   => 'Acesso total para criar, editar e atualizar.'
		        ),
		        array(
		            'id'            => 3,
		            'name'          => 'Gerência',
		            'description'   => 'Capacidade de criar ou editar e atualizar quaisquer já existentes.'
		        ),
		        array(
		            'id'            => 4,
		            'name'          => 'Usuário',
		            'description'   => 'Um usuário padrão que pode ter uma licença que lhes foi atribuído. Sem recursos administrativos.'
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
		Schema::table('users',function($table){
			$table->dropForeign('users_role_id_foreign');
		});
		Schema::drop('roles');
	}

}
