<?php namespace Talentos;

use Illuminate\Database\Eloquent\Model;

class Campos extends Model {
	
	//
	protected $fillable = [
		'id',
		'evento_perfil_id',
		'evento_perfil_grupo_id',
		'campo_tipo_id',
		'campo',
		'obrigatorio',
		'duplicado',
		'descricao',
		'ordem',
		'mascara',
		'autocomplete',
		'campo_modelo_id',
		'tamanho',
		'classe'
	];

	public function campoAlternativas(){
		return $this->hasMany('Talentos\CampoAlternativas','campo_id');
	}

	public function campoCondicoes(){
		return $this->hasMany('Talentos\CampoCondicoes','campo_id');
	}

    protected static function boot() {
        parent::boot();

        static::deleting(function($campo) { // before delete() method call this
            $campo->campoAlternativas()->delete();
            $campo->campoCondicoes()->delete();
        });
    }
}