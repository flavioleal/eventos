<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivos extends Model {
	
	//
	protected $fillable = [
		'id',
		'name',
		'file',
		'mime',
		'size',
		'extensao'
	];
}
