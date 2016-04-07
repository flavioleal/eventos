<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model {
	
	//
	protected $fillable = [
		'id',
		'nome_fantasia',
		'razao_social',
		'cnpj',
		'fundacao'
	];
}
