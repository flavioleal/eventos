<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const PARTICIPANTE = 'participante';
    const ADMIN = 'Administrador';
    const GERENCIA = 'gerencia';

    public static function getIdByName($name)
    {
        $e = self::where('name', $name)->first();
        return $e->id;
    }
}