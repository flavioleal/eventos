<?php namespace Talentos;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model {
	
	//
	protected $fillable = [
		'id',
		'titulo',
		'evento_categoria_id',
		'evento_tipo_id',
		'descricao',
		'data_inicio',
		'data_fim',
		'cep',
		'local',
		'logradouro',
		'numero',
		'complemento',
		'bairro',
		'municipio',
		'uf',
		'gllpLatitude',
		'gllpLongitude',
		'gllpZoom',
		'dia_inteiro',
		'logo_arquivo_id',
		'banner_arquivo_id',
		'background_arquivo_id',
		'cor_texto',
		'cor_predominante',
		'cor_fundo',
		'facebook',
		'twitter',
		'youtube',
		'slug'
	];

	/*public function profissionalArea(){
		return $this->belongsToMany('Talentos\Area','profissional_areas','profissional_id','area_id');
	}

	public function areasProfissional(){
		return $this->hasMany('Talentos\ProfissionalArea','profissional_id');
	}

	public function solicitacoesProfissional(){
		return $this->hasMany('Talentos\ProfissionalSolicitacao','profissional_id');
	}*/
}
