<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contatos extends Model {
	
	//
	protected $fillable = [
		'id',
		'nome',
		'tratamento',
		'apelido',
		'cpf',
		'nascimento',
		'foto'
	];
}
