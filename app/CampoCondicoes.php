<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoCondicoes extends Model {
	
	//
	protected $fillable = [
		'id',
		'campo_id',
		'condicao',
		'valor',
		'dependente_campo_id'
	];
}
