<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParticipanteStatus
 * @package Talentos
 */
class ParticipanteStatus extends Model
{
	protected $fillable = [
		'id',
		'status'
	];
}