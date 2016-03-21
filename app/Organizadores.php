<?php namespace Talentos;

use Illuminate\Database\Eloquent\Model;

class Organizadores extends Model {
	
	//
	protected $fillable = [
		'id',
		'contato_id',
		'empresa_id',
		'descricao'
	];
}
