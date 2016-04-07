<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParticipanteCampos
 * @package Talentos
 */
class ParticipanteCampos extends Model
{
	protected $fillable = [
		'id',
		'campo_id',
		'participante_id',
        'valor'
	];
}