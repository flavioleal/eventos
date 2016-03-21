<?php
/**
 * Created by PhpStorm.
 * User: jorgeluciojr
 * Date: 04/03/16
 * Time: 22:23
 */

namespace Talentos;

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
        return $this->hasMany('Talentos\Campos','evento_perfil_grupo_id');
    }
}