<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoPerfis extends Model {
	
	//
	protected $fillable = [
		'id',
		'evento_id',
		'titulo',
		'descricao',
		'periodo',
		'data_inicio',
		'data_fim',
		'limite_participantes',
		'quantidade',
		'minimo',
		'maximo',
		'exigir_pagamento',
		'valor',
		'antecipado_valor',
		'antecipado_inicio',
		'antecipado_fim',
		'desconto_grupos',
		'desconto_grupo_valor',
		'desconto_grupo_tipo',
		'desconto_grupo_min',
		'desconto_grupo_descricao',
		'restrito',
		'captcha'
	];
}
