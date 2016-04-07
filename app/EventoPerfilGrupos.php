<?php
/**
 * Created by PhpStorm.
 * User: jorgeluciojr
 * Date: 04/03/16
 * Time: 22:23
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoPerfilGrupos extends Model {

    //
    protected $fillable = [
        'id',
        'evento_perfil_id',
        'titulo',
        'ordem'
    ];

    public function campos(){
        return $this->hasMany('App\Campos','evento_perfil_grupo_id');
    }
}