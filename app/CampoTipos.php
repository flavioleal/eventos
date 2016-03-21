<?php namespace Talentos;

use Illuminate\Database\Eloquent\Model;

class CampoTipos extends Model {
	
	//
	protected $fillable = [
		'id',
		'tipo'
	];

	public function camposModelos()
	{
		return $this->belongsTo('CamposModelos');
	}
}
