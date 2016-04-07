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
		'chave'
	];

	public function campos(){
		return $this->hasMany('Talentos\ParticipanteCampos','participante_id');
	}

	public function campoAlternativas(){
		return $this->hasMany('Talentos\ParticipanteCampoAlternativas','participante_id');
	}

	public static function slugFromContact($contato_id)
	{
		$evento = Eventos::select('eventos.slug')
			->join('EventoPerfis as ep', function($join) {
				$join->on('ep.evento_id', '=', 'eventos.id');
			})
			->join('Participantes as p', function($join) {
				$join->on('p.evento_perfil_id', '=', 'ep.id');
			})
			->where('p.contato_id', $contato_id)
			->get()
			->first();

		return $evento->slug;
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

	public function generateKey()
	{
		return strtoupper(md5($this->id));
	}
}