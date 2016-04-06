<?php namespace Talentos\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Talentos\Campos;
use Talentos\CampoTipos;
use Talentos\Eventos;
use Talentos\Http\Controllers\Controller;
use Talentos\Http\Requests;
use Illuminate\Http\Request;
use Talentos\Participantes;

class AttendeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll(Request $request, $evento = null)
    {
        $eventos = Eventos::select('id', 'titulo')->get();
        if (!empty($request->ajax())) {
            $participantes = Participantes::from('participantes as p')
                ->select(
                    'p.id',
                    'u.email as usuario',
                    'p.chave',
                    'e.titulo as evento',
                    'ep.titulo as perfil',
                    DB::raw("'Pendente de pagamento' as situacao")
                )
                ->join('contatos as c', function($join) {
                    $join->on('c.id', '=', 'p.contato_id');
                })
                ->join('users as u', function($join) {
                    $join->on('c.id', '=', 'u.contato_id');
                })
                ->join('evento_perfis as ep', function($join) {
                    $join->on('ep.id', '=', 'p.evento_perfil_id');
                })
                ->join('eventos as e', function($join) {
                    $join->on('e.id', '=', 'ep.evento_id');
                });

            if (!empty($request->get('searchPhrase'))) {
                $participantes->where('p.chave', 'LIKE', '%' .$request->get('searchPhrase'). '%');
            }

            if (!empty($evento)) {
                $participantes->where('e.id', $evento);
            } else {
                $participantes->where('e.id', $eventos[0]->id);
            }

            return json_encode([
                'current' => 1,
                'rowCount' => 10,
                'rows' => $participantes->get()->toArray(),
                'total' => $participantes->count()
            ]);
        }

        return view('admin.attendee.showAll', [
            'eventos' => $eventos,
            'eventoId' => empty($evento) ? $eventos[0]->id : $evento,
        ]);
    }

    public function badgeModel(Request $request, $evento)
    {
        $evento = Eventos::select(
                'eventos.id',
                'cor_texto',
                'cor_predominante',
                'cor_fundo',
                'eventos.titulo',
                "eventos.logo_arquivo_id",
                "logo.extensao as logo_extensao"
            )
            ->leftJoin('arquivos as logo', function($join) {
                $join->on('logo.id', '=', 'eventos.logo_arquivo_id');
            })
            ->where('eventos.id', $evento)
            ->get()[0];

        $campos = Campos::from('campos as c')
            ->select('c.campo')
            ->join('evento_perfis as ep', function($join) {
                $join->on('ep.id', '=', 'c.evento_perfil_id');
            })
            ->where('ep.evento_id', $evento->id)
            ->whereNotIn('c.campo_tipo_id', [CampoTipos::PARAGRAFO, CampoTipos::ARQUIVO])
            ->groupBy('c.campo')
            ->get();

        return view('admin.attendee.badgeModel', [
            'evento' => $evento,
            'campos' => $campos
        ]);
    }

    public function badgeModelV2(Request $request, $evento)
    {
        $evento = Eventos::select(
            'eventos.id',
            'cor_texto',
            'cor_predominante',
            'cor_fundo',
            'eventos.titulo',
            "eventos.logo_arquivo_id",
            "logo.extensao as logo_extensao"
        )
            ->leftJoin('arquivos as logo', function($join) {
                $join->on('logo.id', '=', 'eventos.logo_arquivo_id');
            })
            ->where('eventos.id', $evento)
            ->get()[0];

        $campos = Campos::from('campos as c')
            ->select('c.campo')
            ->join('evento_perfis as ep', function($join) {
                $join->on('ep.id', '=', 'c.evento_perfil_id');
            })
            ->where('ep.evento_id', $evento->id)
            ->whereNotIn('c.campo_tipo_id', [CampoTipos::PARAGRAFO, CampoTipos::ARQUIVO])
            ->groupBy('c.campo')
            ->get();

        return view('admin.attendee.badgeModelV2', [
            'evento' => $evento,
            'campos' => $campos
        ]);
    }
}