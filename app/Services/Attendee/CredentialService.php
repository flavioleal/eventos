<?php
/**
 * Created by PhpStorm.
 * User: jorgeluciojr
 * Date: 06/04/16
 * Time: 20:42
 */

namespace App\Services\Attendee;

use App\Eventos;

class CredentialService
{
    /**
     * @param $eventoId
     * @param $credencialHtml
     * @return bool|int
     * @throws \Exception
     */
    public function update($eventoId, $credencialHtml)
    {
        try {
            $evento = Eventos::find($eventoId)->update([
                'credencial_html' => $credencialHtml
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Falha ao atualizar credencial do evento' . $e->getMessage());
        }
        return $evento;
    }
}