<?php namespace Talentos;

use Illuminate\Database\Eloquent\Model;

class CupomDescontos extends Model {
	
	//
	protected $fillable = [
		'id',
		'evento_perfil_id',
		'data_inicio',
		'data_fim',
		'valor',
		'valor_tipo',
		'codigo'
	];
}
