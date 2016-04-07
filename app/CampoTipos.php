<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoTipos extends Model {

	const CAMPO_TEXTO  = 1;
	const CAMPO_NÚMERO = 2;
	const DATA = 3;
	const MONETARIO = 4;
	const TEXTO = 5;
	const ALTERNATIVA = 6;
	const OPCOES = 7;
	const CAIXA_SELECAO = 8;
	const ARQUIVO = 9;
	const PARAGRAFO = 10;

	protected $fillable = [
		'id',
		'tipo'
	];

	public function camposModelos()
	{
		return $this->belongsTo('CamposModelos');
	}
}
