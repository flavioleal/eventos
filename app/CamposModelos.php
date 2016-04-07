<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CamposModelos extends Model {
	
	//
	protected $fillable = [
		'id',
		'campo_tipo_id',
		'campo',
		'obrigatorio',
		'duplicado',
		'descricao',
		'ordem',
		'classe',
		'mascara'
	];

	public function campoAlternativas(){
		return $this->hasMany('App\CampoAlternativasModelos','campo_id');
	}

	public function campoTipos(){
		return $this->hasMany('App\CampoTipos', 'id', 'campo_tipo_id');
	}
}