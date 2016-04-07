<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\CampoAlternativas;
use App\Role;
use App\User;
use View;
use Symfony\Component\HttpFoundation\Response;
use App\Campos;
use App\CampoTipos;
use App\EventoPerfilGrupos;
use App\EventoPerfis;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Eventos;
use App\Arquivos;
use Goutte\Client;
use JansenFelipe\CpfGratis as Cpf;
use JansenFelipe\CnpjGratis\CnpjGratis as Cnpj;
use Illuminate\Support\Facades\DB;

use App\Contatos;
use App\Participantes;
use App\ParticipanteCampos;
use App\ParticipanteCampoAlternativas;

use Auth;

class HomeController extends Controller
{
	/**
	 * Show the application dashboard to the userbv.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('site.index');
	}

	public function inscricao(Request $request, $slug)
	{
		$evento = $this->getEventoBySlug($slug)[0];
		$perfis = $this->getEventoById($evento->id);
		$grupos = $this->getGruposByEventoId($evento->id);
		$campos = $this->getCamposByEventoId($evento->id);
		$alternativas = $this->getAlternativasByEventoId($evento->id);
        $condicoes = $this->getCondicoesByEventoId($evento->id);
		$tamanho = [1 => 'col-md-12', 2 => 'col-md-6', 3 => 'col-md-4'];

		return view('site.inscricao',
			[
                'evento' => $evento,
				'perfis' => $perfis,
				'campos' => $campos,
                'condicoes' => $condicoes,
				'grupos' => $grupos,
				'alternativas' => $alternativas,
				'tamanho' => $tamanho,
                'temp' => []
			]
		);
	}

	public function evento(Request $request, $slug)
	{
		$evento = $this->getEventoBySlug($slug);
		return view('site.home')->with('evento', $evento[0]);
	}

	private function getCondicoesByEventoId($id)
	{
        return Eventos::select(
            "campo_condicoes.id",
            "campo_condicoes.campo_id",
            "campo_condicoes.condicao",
            "campo_condicoes.valor",
            "campo_condicoes.dependente_campo_id"
        )
            ->join('evento_perfis', function($join) {
                $join->on('evento_perfis.evento_id', '=', 'eventos.id');
            })
            ->join('campos', function($join) {
                $join->on('campos.evento_perfil_id', '=', 'evento_perfis.id');
            })
            ->join('campo_condicoes', function($join) {
                $join->on('campo_condicoes.campo_id', '=', 'campos.id');
            })
            ->where('eventos.id', '=', $id)
            ->get();
	}

	private function getAlternativasByEventoId($id)
	{
		return Eventos::select(
			"campo_alternativas.id",
			"campo_alternativas.campo_id",
			"campo_alternativas.alternativa"
		)
			->join('evento_perfis', function($join) {
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->join('campos', function($join) {
				$join->on('campos.evento_perfil_id', '=', 'evento_perfis.id');
			})
			->join('campo_alternativas', function($join) {
				$join->on('campo_alternativas.campo_id', '=', 'campos.id');
			})
			->orderBy('campo_alternativas.ordem')
			->where('eventos.id', '=', $id)
			->get();
	}

	private function getCamposByEventoId($id)
	{
		return Eventos::select(
			"campos.id",
			"campos.evento_perfil_id",
			"campos.evento_perfil_grupo_id",
			"campos.campo_tipo_id",
			"campos.campo",
            "campos.descricao",
			"campos.obrigatorio",
			"campos.duplicado",
			"campos.descricao",
			"campos.classe",
			"campos.tamanho",
			"campos.autocomplete",
			"campos.mascara"
		)
			->join('evento_perfis', function($join) {
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->join('campos', function($join) {
				$join->on('campos.evento_perfil_id', '=', 'evento_perfis.id');
			})
			->orderBy('campos.ordem')
			->where('eventos.id', '=', $id)
			->get();
	}

	private function getGruposByEventoId($id)
	{
		return Eventos::select(
			"evento_perfil_grupos.id",
			"evento_perfil_grupos.titulo",
			"evento_perfil_grupos.evento_perfil_id"
		)
			->join('evento_perfis', function($join) {
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->join('evento_perfil_grupos', function($join) {
				$join->on('evento_perfil_grupos.evento_perfil_id', '=', 'evento_perfis.id');
			})
			->orderBy('evento_perfil_grupos.ordem')
			->where('eventos.id', '=', $id)
			->get();
	}

	private function getEventoById($id)
	{
		return Eventos::select(
			"evento_perfis.evento_id",
			"evento_perfis.id",
			"evento_perfis.titulo",
            "evento_perfis.descricao",
            "evento_perfis.valor",
            "evento_perfis.exigir_pagamento",
            "evento_perfis.quantidade"
		)
			->join('evento_perfis', function($join){
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->where('eventos.id', '=', $id)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('campos')
                    ->whereRaw('campos.evento_perfil_id = evento_perfis.id');
            })
			->get();
	}

	private function getEventoBySlug($slug)
	{
		return Eventos::select(
			"eventos.id",
			"eventos.evento_status_id",
			"eventos.titulo",
			"eventos.data_inicio",
			"eventos.data_fim",
			"eventos.cep",
			"eventos.logradouro",
			"eventos.numero",
			"eventos.complemento",
			"eventos.bairro",
			"eventos.municipio_id",
			"eventos.uf",
			"eventos.descricao",
			"eventos.status",
			"eventos.template_id",
			"eventos.evento_categoria_id",
			"eventos.evento_tipo_id",
			"eventos.gllpLatitude",
			"eventos.gllpLongitude",
			"eventos.municipio",
			"eventos.dia_inteiro",
			"eventos.gllpZoom",
			"eventos.logo_arquivo_id",
			"eventos.banner_arquivo_id",
			"eventos.background_arquivo_id",
			"eventos.slug",
			'cor_texto',
			'cor_predominante',
			'cor_fundo',
			'facebook',
			'twitter',
			'youtube',
			"logo.name as logo_name",
			"logo.size as logo_size",
			"logo.mime as logo_mime",
			"logo.extensao as logo_extensao",
			"back.name as bg_name",
			"back.size as bg_size",
			"back.mime as bg_mime",
			"back.extensao as bg_extensao",
			"banner.name as banner_name",
			"banner.size as banner_size",
			"banner.mime as banner_mime",
			"banner.extensao as banner_extensao")
			->leftJoin('arquivos as logo', function($join) {
				$join->on('logo.id', '=', 'eventos.logo_arquivo_id');
			})
			->leftJoin('arquivos as back', function($join) {
				$join->on('back.id', '=', 'eventos.background_arquivo_id');
			})
			->leftJoin('arquivos as banner', function($join) {
				$join->on('banner.id', '=', 'eventos.banner_arquivo_id');
			})
			->where('slug','=', $slug)->get();
	}


	public function fileShow($tipo, $id, $ext)
	{

		$path = [
			'logo' => '/img/logos/',
			'banner' => '/img/banners/',
			'background' => '/img/backgrounds/'
		];

		$dir = public_path().$path[$tipo];

		if (file_exists($dir.'/'.$id.'.'.$ext)) {
			return redirect(url().$path[$tipo].$id.'.'.$ext);
		} else {
			$att = Arquivos::find($id);

			if(!$id)
				$this->respondNotFound();

			$file_contents = base64_decode($att->file);

			return response($file_contents)
				->header('Content-Type', $att->mime)
				->header('Content-length', strlen($file_contents))
				->header('Content-Disposition', 'filename=' . $att->name)
				->header('Cache-Control', 'no-cache private')
				->header('Content-Description', 'File Transfer')
				//->header('Content-Disposition', 'attachment; filename=' . $att->name)
				->header('Content-Transfer-Encoding', 'binary');
		}

	}

	public function cnpj(Request $request)
	{
		$cnpj = $request->get('cnpj');
		$cookie = $request->get('cookie');
		$captcha = $request->get('captcha');

        $consulta = new Cnpj();
		if (!empty($cnpj) && !empty($captcha) && !empty($cookie)) {
			$retorno = $consulta::consulta($cnpj, $captcha, $cookie);

			return json_encode($retorno);
		}
		$params = $consulta::getParams();
		return view('site.cnpj')->with('params', $params);
	}

    public function cpf(Request $request)
    {
        $cpf = $request->get('cpf');
        $dataNascimento = $request->get('dataNascimento');
        $cookie = $request->get('cookie');
        $captcha = $request->get('captcha');

        $consulta = new Cpf();
        if (!empty($cpf) && !empty($dataNascimento) && !empty($captcha) && !empty($cookie)) {
            $retorno = $consulta::consulta($cpf, $dataNascimento, $captcha, $cookie);

            return json_encode($retorno);
        }
        $params = $consulta::getParams();
        return view('site.cpf')->with('params', $params);
    }

    public function cep(Request $request)
    {
        $cep = str_replace(['-', '.'], ['', ''], $request->get('cep'));

        $params = [
            'cepEntrada' => $cep,
            'tipoCep' => '',
            'cepTemp' => '',
            'metodo' => 'buscarCep'
        ];

        $client = new Client();
        $crawler = $client->request('POST', 'http://m.correios.com.br/movel/buscaCepConfirma.do', $params);

        return json_encode([
            'logradouro' => trim($crawler->filter('span.respostadestaque')->eq(0)->html()),
            'bairro' => trim($crawler->filter('span.respostadestaque')->eq(1)->html()),
            'cidade' => trim(explode('/', $crawler->filter('.respostadestaque')->eq(2)->html())[0]),
            'uf' => trim(explode('/', $crawler->filter('.respostadestaque')->eq(2)->html())[1]),
        ]);
    }

    public function store(Request $request)
    {
		$input = $request->all();
		$participante = $this->storeFields($input);

		$finish = false;
		if ($request->get('finish') && $this->validateForm($participante)) {
			$finish = $this->finish($participante);
		}

		return json_encode([
            'status' => 1,
            'mensagem' => '',
			'participante_id' => $participante->id,
			'finish' => $finish
        ]);
    }

	public function participant(Request $request, $slug)
	{
		if (!(Auth::check() && Auth::user()->role_id === Role::getIdByName(Role::PARTICIPANTE))) {
			return redirect(route('site.access', ['slug' => $slug]));
		}

		$participante = Participantes::where('contato_id', Auth::user()->contato_id)->get()->first();

		$evento = $this->getEventoBySlug($slug)[0];
		$perfis = $this->getEventoById($evento->id);
		$grupos = $this->getGruposByEventoId($evento->id);
		$campos = $this->getRespostasByEventoId($evento->id, $participante->id);
		$alternativas = $this->getAlternativasRespostasByEventoId($evento->id, $participante->id);
		$condicoes = $this->getCondicoesByEventoId($evento->id);
		$tamanho = [1 => 'col-md-12', 2 => 'col-md-6', 3 => 'col-md-4'];

		return view('site.participant',
			[
				'confirmacao' => $this->comprovante($participante),
				'participante' => $participante,
				'evento' => $evento,
				'perfis' => $perfis,
				'campos' => $campos,
				'condicoes' => $condicoes,
				'grupos' => $grupos,
				'alternativas' => $alternativas,
				'tamanho' => $tamanho,
				'temp' => []
			]
		);
	}

	private function getRespostasByEventoId($eventoId, $participanteId)
	{
		return Eventos::select(
			"campos.id",
			"campos.evento_perfil_id",
			"campos.evento_perfil_grupo_id",
			"campos.campo_tipo_id",
			"campos.campo",
			"campos.descricao",
			"campos.obrigatorio",
			"campos.duplicado",
			"campos.descricao",
			"campos.classe",
			"campos.tamanho",
			"campos.autocomplete",
			"campos.mascara",
			"pc.valor as resposta"
		)
			->join('evento_perfis', function($join) {
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->join('campos', function($join) {
				$join->on('campos.evento_perfil_id', '=', 'evento_perfis.id');
			})
			->leftJoin('participantes as p', function($join) use($participanteId) {
				$join->on('p.evento_perfil_id', '=', 'evento_perfis.id')
					//->on(DB::raw('p.id = 58'));
					->on('p.id', '=', DB::raw($participanteId));
			})
			->leftJoin('participante_campos as pc', function($join) {
				$join->on('pc.campo_id', '=', 'campos.id')
					->on('pc.participante_id', '=', 'p.id');
			})
			->orderBy('campos.ordem')
			->where('eventos.id', '=', $eventoId)
			->get();
	}

	private function getAlternativasRespostasByEventoId($eventoId, $participanteId)
	{
		return Eventos::select(
			"campo_alternativas.id",
			"campo_alternativas.campo_id",
			"campo_alternativas.alternativa",
			"pca.campo_alternativa_id as checked"
		)
			->join('evento_perfis', function($join) {
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->join('campos', function($join) {
				$join->on('campos.evento_perfil_id', '=', 'evento_perfis.id');
			})
			->join('campo_alternativas', function($join) {
				$join->on('campo_alternativas.campo_id', '=', 'campos.id');
			})
			->leftJoin('participantes as p', function($join) use($participanteId) {
				$join->on('p.evento_perfil_id', '=', 'evento_perfis.id')
					->on('p.id', '=', DB::raw($participanteId));
			})
			->leftJoin('participante_campos as pc', function($join) {
				$join->on('pc.campo_id', '=', 'campos.id')
					->on('pc.participante_id', '=', 'p.id');
			})
			->leftJoin('participante_campo_alternativas as pca', function($join) {
				$join->on('pca.participante_campo_id', '=', 'pc.id')
					->on('pca.campo_alternativa_id', '=', 'campo_alternativas.id');
			})
			->orderBy('campo_alternativas.ordem')
			->where('eventos.id', '=', $eventoId)
			->get();
	}

	public function access(Request $request, $slug)
	{
		if (!empty($request->get('username')) && !empty($request->get('password'))) {
			if (Auth::attempt([
				'email' => $request->get('username'),
				'password' => $request->get('password'),
				'role_id' => Role::getIdByName(Role::PARTICIPANTE),
				'ativo' => 1
			])) {
				return redirect(route('site.participant', ['slug' => $slug]));
			} else {
				Auth::logout();
				Session::flash('erro',"Login ou chave inválido(s). Tente novamente.");
				return redirect(route('site.access', ['slug' => $slug]));
			}
		}
		$evento = $this->getEventoBySlug($slug)[0];

		return view('site.access', [
			'evento' => $evento
		]);
	}

	private function finish(Participantes $participante)
	{

		if (empty($participante->data_conclusao)) {
			$dataConclusao = new \DateTime();
			$participante->data_conclusao = $dataConclusao->format('Y-m-d H:i:s');
			$participante->chave = $participante->generateKey();
			Participantes::find($participante->id)
				->update([
					'data_conclusao' => $participante->data_conclusao,
					'chave' => $participante->chave
				]);
			$contato = Contatos::find($participante->contato_id);

			User::create([
				'name' => $contato->nome,
				'contato_id' => $contato->id,
				'email' => 'usuario' . $contato->id,
				'password' => bcrypt($participante->chave),
				'ativo' => 1,
				'role_id' => Role::getIdByName(Role::PARTICIPANTE)
			]);
		}
		//send email code
		return $this->comprovante($participante);
	}

	private function comprovante(Participantes $participante)
	{
		$evento = Eventos::select(
				'eventos.*',
				'logo.extensao as logo_extensao'
			)
			->where('ep.id', $participante->evento_perfil_id)
			->join('evento_perfis as ep', function($join) {
				$join->on('ep.evento_id', '=', 'eventos.id');
			})
			->leftJoin('arquivos as logo', function($join) {
				$join->on('logo.id', '=', 'eventos.logo_arquivo_id');
			})
			->first();

		$perfil = EventoPerfis::find($participante->evento_perfil_id);
		$grupos = EventoPerfilGrupos::where('evento_perfil_grupos.evento_perfil_id', $perfil->id)
			->whereExists(function($query) {
				$query->select(DB::raw(1))
					->from('campos as c')
					->where('c.campo_tipo_id', '<>', CampoTipos::PARAGRAFO)
					->whereRaw('c.evento_perfil_grupo_id = evento_perfil_grupos.id');
			})->get()->toArray();

		foreach ($grupos as &$grupo) {
			$campos = ParticipanteCampos::select(
					'participante_campos.id',
					'participante_campos.valor',
					'participante_campos.campo_id'
				)
				->join('campos as c', function($join) {
					$join->on('c.id', '=', 'participante_campos.campo_id');
				})
				->where('c.evento_perfil_grupo_id', $grupo['id'])
				->where('participante_id', $participante->id)
				->get()
				->toArray();

			$grupo['campos'] = [];
			foreach ($campos as $resposta) {
				$campo = Campos::find($resposta['campo_id']);
				$respostaValor = $resposta['valor'];

				if ($campo->campo_tipo_id == CampoTipos::ALTERNATIVA) {
					$alternativas = ParticipanteCampoAlternativas::select('ca.alternativa')
						->join('campo_alternativas as ca', function($join) {
							$join->on('ca.id', '=', 'participante_campo_alternativas.campo_alternativa_id');
						})
						->where('participante_campo_id', $resposta['id'])
						->get()
						->toArray();

					foreach ($alternativas as &$a) {
						$a = $a['alternativa'];
					}
					$respostaValor = implode(', ', $alternativas);
				}

				if ($campo->campo_tipo_id == CampoTipos::CAIXA_SELECAO) {
					$alternativa = CampoAlternativas::select('campo_alternativas.alternativa')
						->where('id', $resposta['valor'])
						->get()
						->first();

					$respostaValor = $alternativa['alternativa'];
				}
				$grupo['campos'][] = [
					'valor' => $campo->campo,
					'resposta' => $respostaValor
				];
			}
		}

		$usuario = User::where('contato_id', $participante->contato_id)->get()->first();
		$view = View::make('site.comprovante', [
			'evento' => $evento,
			'usuario' => $usuario,
			'perfil' => $perfil,
			'grupos' => $grupos,
			'participante' => $participante
		]);

		return $view->render();
	}

	private function validateForm(Participantes $participante)
	{
		return true;
	}

	private function storeFields(array $input)
	{
		if (empty($input['id'])) {
			$contato = Contatos::create(
				['nome' => $_SERVER['REMOTE_ADDR']]
			);

			if (empty($contato->id)) {
				return false;
			}

			$participante = Participantes::create(
				[
					'contato_id' => $contato->id,
					'evento_perfil_id' => $input['field-perfil']
				]
			);

			if (empty($participante->id)) {
				return false;
			}

			if (!isset($input['field'])) {
				return $participante;
			}

			foreach ($input['field'] as $campo => $valor) {
				$campo_id = explode('-', $campo);
				$campo = ParticipanteCampos::create(
					[
						'campo_id' => $campo_id[1],
						'participante_id' => $participante->id,
						'valor' => is_array($valor) ? null : $valor
					]
				);

				if (is_array($valor) && !empty($campo->id)) {

					foreach ($valor as $k => $v) {
						ParticipanteCampoAlternativas::create(
							[
								'participante_campo_id' => $campo->id,
								'campo_alternativa_id' => $k
							]
						);
					}
				}
			}
		} else {
			$participante = Participantes::find($input['id']);

			if (!isset($input['field'])) {
				return $participante;
			}

			if ($participante->evento_perfil_id != $input['field-perfil']) {
				$participante->evento_perfil_id = $input['field-perfil'];
				Participantes::find($participante->id)
					->update([
						'evento_perfil_id' => $participante->evento_perfil_id
					]);
			}

			$participanteCampos = [];
			foreach ($input['field'] as $campo => $valor) {
				$campo_id = explode('-', $campo);
				$participanteCampo = ParticipanteCampos::where('participante_id', $participante->id)
					->where('campo_id', $campo_id[1])->get()->toArray();

				if (count($participanteCampo) > 0) {
					ParticipanteCampos::where('participante_id', $participante->id)
						->where('campo_id', $campo_id[1])
						->update([
							'campo_id' => $campo_id[1],
							'participante_id' => $participante->id,
							'valor' => is_array($valor) ? null : $valor
						]);
					$participanteCampo = $participanteCampo[0];
				} else {
					$participanteCampo = ParticipanteCampos::create(
						[
							'campo_id' => $campo_id[1],
							'participante_id' => $participante->id,
							'valor' => is_array($valor) ? null : $valor
						]
					)->toArray();
				}

				if (is_array($valor) && !empty($participanteCampo['id'])) {
					foreach ($valor as $k => $v) {
						$alternativa = ParticipanteCampoAlternativas::where(
							'participante_campo_id', $participanteCampo['id']
						)
							->where('campo_alternativa_id', $k)
							->get();

						if ($alternativa->count() == 0) {
							ParticipanteCampoAlternativas::create(
								[
									'participante_campo_id' => $participanteCampo['id'],
									'campo_alternativa_id' => $k
								]
							);
						}
						$alternativas[] = $k;
					}
					ParticipanteCampoAlternativas::whereNotIn('campo_alternativa_id', $alternativas)
						->where('participante_campo_id', $participanteCampo['id'])
						->delete();
				};
				$participanteCampos[] = $participanteCampo['id'];
			}
			ParticipanteCampoAlternativas::whereExists(function($query) use ($input, $participante)
			{
				$query->select(DB::raw(1))
					->from('evento_perfil_grupos as pg')
					->join('campos as c', function($join) {
						$join->on('c.evento_perfil_grupo_id', '=', 'pg.id');
					})
					->join('participante_campos as pc', function($join) {
						$join->on('pc.campo_id', '=', 'c.id');
					})
					->where('pc.participante_id', $participante->id)
					->where('pg.id', $input['grupo_id'])
					->whereRaw('pc.id = participante_campo_alternativas.participante_campo_id');
			})
				->whereNotIn('participante_campo_id', $participanteCampos)
				->delete();
		}

		return $participante;
	}

	public function logoutParticipant($slug)
	{
		Auth::logout();
		return redirect(route('site.evento', ['slug' => $slug]));
	}
}
