<?php namespace Talentos;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Participantes
 * @package Talentos
 */
class Participantes extends Model
{
	protected $fillable = [
		'id',
		'evento_perfil_id',
		'contato_id',
        'data_inicio',
        'data_conclusao',
        'data_checkin',
        'participante_status_id',
	];

	public function campos(){
		return $this->hasMany('Talentos\ParticipanteCampos','participante_id');
	}

	public function campoAlternativas(){
		return $this->hasMany('Talentos\ParticipanteCampoAlternativas','participante_id');
	}

    protected static function boot() {
        parent::boot();

        static::deleting(
            /**
             * @param $campo
             * @type self
             */
            function($campo) {
                $campo->campos()->delete();
                $campo->campoAlternativas()->delete();
            }
        );
    }
}