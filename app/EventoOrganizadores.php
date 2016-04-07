<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoOrganizadores extends Model {
	
	//
	protected $fillable = [
		'evento_id',
		'organizador_id'
	];
}