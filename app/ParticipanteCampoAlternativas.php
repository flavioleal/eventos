<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParticipanteCampoAlternativas
 * @package Talentos
 */
class ParticipanteCampoAlternativas extends Model
{
	protected $fillable = [
		'id',
		'participante_campo_id',
		'campo_alternativa_id'
	];
}