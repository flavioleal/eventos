<?php namespace App\Http\Controllers\Admin;

use App\ParticipanteCampos;
use Illuminate\Support\Facades\DB;
use App\Campos;
use App\CampoTipos;
use App\Eventos;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Participantes;
use App\Services\Attendee\CredentialService;
use App\Services\Attendee\BarCodeGenerator;

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
        $eventoData = $this->getEvento($evento);
        $campos = $this->getCampos($evento);

        return view('admin.attendee.badgeModel', [
            'evento' => $eventoData,
            'campos' => $campos
        ]);
    }

    public function badgeModelV2(Request $request, $evento)
    {
        $eventoData = $this->getEvento($evento);
        $campos = $this->getCampos($evento);

        return view('admin.attendee.badgeModelV2', [
            'evento' => $eventoData,
            'campos' => $campos
        ]);
    }

    public function credential(Request $request, $participante)
    {
        $evento = Participantes::eventoFromParticipante($participante);
        $eventoData = $this->getEvento($evento->id);
        $respostas = ParticipanteCampos::select('participante_campos.valor', 'c.classe')
            ->join('campos as c', function($join) {
                $join->on('c.id', '=', 'participante_campos.campo_id');
            })
            ->where('participante_campos.participante_id', $participante)
            ->get();

        $code = strtoupper(md5($participante));
        //var_dump($code); die;
        $barCode = new BarCodeGenerator($code, 1, public_path() . '/img/' .$code . '.gif');

        return view('admin.attendee.credential', [
            'evento' => $eventoData,
            'campos' => $respostas,
            'barcode' => '/img/' .$code . '.gif'
        ]);
    }

    public function storeCredential(Request $request)
    {
        $eventoId = $request->get('evento');
        $credencialHtml = $request->get('campos');
        $service = new CredentialService();

        try {
            if (!$service->update($eventoId, json_encode($credencialHtml))) {
                throw new \Exception('Não foi possível alterar o modelo da credencial');
            }
        } catch (\Exception $e) {
            return json_encode([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }

        return json_encode([
            'status' => true,
            'message' => 'Modelo da credencial alterado com sucesso'
        ]);
    }

    private function getEvento($eventoId)
    {
        $evento = Eventos::select(
            'eventos.id',
            'cor_texto',
            'cor_predominante',
            'cor_fundo',
            'eventos.titulo',
            "eventos.logo_arquivo_id",
            "logo.extensao as logo_extensao",
            "eventos.credencial_html"
        )
            ->leftJoin('arquivos as logo', function($join) {
                $join->on('logo.id', '=', 'eventos.logo_arquivo_id');
            })
            ->where('eventos.id', $eventoId)
            ->get()[0];

        $evento->credencial_html = json_decode($evento->credencial_html, true);

        return $evento;
    }

    private function getCampos($eventoId)
    {
        $campos = Campos::from('campos as c')
            ->select('c.classe')
            ->join('evento_perfis as ep', function($join) {
                $join->on('ep.id', '=', 'c.evento_perfil_id');
            })
            ->where('ep.evento_id', $eventoId)
            ->whereNotIn('c.campo_tipo_id', [CampoTipos::PARAGRAFO, CampoTipos::ARQUIVO])
            ->groupBy('c.classe')
            ->get();

        return $campos;
    }
}