<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CampoAlternativasModelos extends Model {
	
	//
	protected $fillable = [
		'id',
		'campo_id',
		'alternativa',
		'ordem'
	];

	

	public function campos(){
		return $this->hasMany('App\CamposModelos');
	}
}
