<?php namespace Talentos\Http\Controllers\Admin;

use Talentos\Eventos;
use Talentos\Http\Controllers\Controller;
use Talentos\Http\Requests;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAll(Request $request)
    {
        if (!empty($request->ajax())) {
            $eventos = Eventos::select('eventos.*');

            if (!empty($request->get('searchPhrase'))) {
                $eventos->where('eventos.titulo', 'LIKE', '%' .$request->get('searchPhrase'). '%');
            }
            $eventos = $eventos->get();
            $all = [];

            foreach ($eventos as $e) {
                $t = Participantes::select(DB::raw('COUNT(0) as total'))
                    ->join('evento_perfis as ep', function($join) {
                        $join->on('ep.id', '=', 'participantes.evento_perfil_id');
                    })
                    ->where('ep.evento_id', $e['id'])
                    ->get()->first();

                $e['participantes'] = $t->total;
                $e['data_inicio'] = $e->getDataInicio();
                $e['data_fim'] = $e->getDateFim();
                $all[] = $e;
            }

            return json_encode([
                'current' => 1,
                'rowCount' => 10,
                'rows' => $all,
                'total' => $eventos->count()
            ]);
        }
        return view('admin.attendee.showAll');
    }
}