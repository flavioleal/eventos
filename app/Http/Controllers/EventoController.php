<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CampoCondicoesRequest;
use Illuminate\Http\Request;
use App\Eventos;
use App\Organizadores;
use App\Contatos;
use App\EventoOrganizadores;

use App\EventoPerfis;
use App\EventoPerfilGrupos;
use App\CupomDescontos;

use App\Campos;
use App\CampoAlternativas;
use App\CampoCondicoes;
use App\CampoTipos;

use App\CamposModelos;
use App\CampoAlternativasModelos;

use App\Arquivos;

use Response;
use Session;
use App\Participantes;
use View;
use DB;
use Jenssegers\Date\Date;

class EventoController extends Controller
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
		return view('evento.showAll');
	}

	public function create($id = NULL)
    {
		$evento_perfil = [];

		if (!is_null($id)) {
			$evento = Eventos::select(
						"eventos.id",
						"eventos.evento_status_id",
						"eventos.titulo",
						"eventos.data_inicio",
						"eventos.data_fim",
						"eventos.cep",
						"eventos.local",
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
			    ->find($id)
				->toArray();

			$evento['data_inicio'] = [
				$this->date_convert($evento['data_inicio'],'Y-m-d H:i:s','d/m/Y'),
				$this->date_convert($evento['data_inicio'],'Y-m-d H:i:s','H:i')
			];
			$evento['data_fim'] = [
				$this->date_convert($evento['data_fim'],'Y-m-d H:i:s','d/m/Y'),
				$this->date_convert($evento['data_fim'],'Y-m-d H:i:s','H:i')
			];

			$evento_organizador = EventoOrganizadores::where('evento_id','=',$id)->get();

			if ($evento_organizador->count() > 0) {

				$evento_organizador = $evento_organizador->toArray();
				$organizador = Organizadores::find($evento_organizador[0]['organizador_id'])->toArray();

				$contato = Contatos::find($organizador['contato_id'])->toArray();

				$evento['organizador_nome'] = $contato['nome'];
				$evento['organizador_descricao'] = $organizador['descricao'];
			}

			//perfis do evento
			$evento_perfil = EventoPerfis::where('evento_id',$id)->get()->toArray();
		}else {
            $evento = [];
        }


		$view = [
			'form' => $evento,
			'evento_perfil' => $evento_perfil
		];

		return view('evento.create',$view);
	}

	public function store(Request $request)
    {
		$input = $request->all();

		/*Converte formato das datas*/
		$input['data_inicio'] = $this->date_convert($input['data_inicio'][0].' '.$input['data_inicio'][1],'d/m/Y H:i','Y-m-d H:i:s');
		$input['data_fim'] = $this->date_convert($input['data_fim'][0].' '.$input['data_fim'][1],'d/m/Y H:i','Y-m-d H:i:s');

		$input['slug'] = str_slug($input['titulo']);
		if (!empty($input['id'])) {
			Eventos::find($input['id'])->update($input);
			$id = $input['id'];
			$mensagem = 'Evento alterado com sucesso.';
		} else {
			$evento = Eventos::create($input);
			$id = $evento->id;
			$mensagem = 'Evento adicionado com sucesso.';

			if (!empty($input['organizador_nome'])) {
				$contato = Contatos::create(
					['nome'=>$input['organizador_nome']]
				);

				$organizador = Organizadores::create(
					[
						'contato_id'	=> $contato->id,
						'descricao'		=> $input['organizador_descricao']
					]
				);

				EventoOrganizadores::create(
					[
						'evento_id'		=> $evento->id,
						'organizador_id'=> $organizador->id
					]
				);
			}
		}

		$response = [
            'status'	=> '1',
            'mensagem'	=> $mensagem,
            'id'		=> $id
        ];
 
        return Response::json( $response );
	}

	public function perfil_store(Request $request)
    {

		$input = $request->all();

		$input['data_inicio'] = !empty($input['data_inicio']) ? $this->date_convert($input['data_inicio'],'d/m/Y','Y-m-d H:i:s') : '';
		$input['data_fim'] = !empty($input['data_fim']) ? $this->date_convert($input['data_fim'],'d/m/Y','Y-m-d H:i:s') : '';

		if (!empty($input['id'])) {
			$evento = EventoPerfis::find($input['id'])->update($input);
			$id = $input['id'];
			$mensagem = 'Evento alterado com sucesso.';
		} else {
			$evento = EventoPerfis::create($input);
			$id = $evento->id;

			EventoPerfilGrupos::create([
				'titulo' => 'Dados pessoais',
				'evento_perfil_id' => $id,
				'ordem' => 1
			]);

			$mensagem = 'Evento adicionado com sucesso.';
		}

		$response = array(
            'status'	=> '1',
            'mensagem'	=> $mensagem,
            'id'		=> $id
        );
 
        return Response::json( $response );
	}

    public function grupoCamposStore(Request $request)
    {
        $input = $request->all();

        $eventoPerfilGrupo = EventoPerfilGrupos::create([
            'titulo' => $input['titulo'],
            'evento_perfil_id' => $input['evento_perfil_id'],
            'ordem' => $input['ordem']
        ]);

        $mensagem = 'Grupo adicionado com sucesso.';

        $response = array(
            'status'	=> '1',
            'mensagem'	=> $mensagem,
            'id'		=> $eventoPerfilGrupo->id
        );

        return Response::json( $response );
    }

    public function grupoCamposDestroy(Request $request)
    {
        $input = $request->all();

        Campos::where('evento_perfil_grupo_id', '=', $input['id'])->get()->each(function($campo) {
            $campo->delete();
        });
        EventoPerfilGrupos::where('id', $input['id'])->delete();

        $mensagem = 'Grupo removido com sucesso.';
        $response = array(
            'status'	=> '1',
            'mensagem'	=> $mensagem,
            'id' => $input['id']
        );

        return Response::json( $response );
    }

	public function perfil_grupos_store(Request $request)
    {
		$input = $request->all();

		$input['antecipado_inicio'] = !empty($input['antecipado_inicio']) ? $this->date_convert($input['antecipado_inicio'],'d/m/Y','Y-m-d H:i:s') : '';
		$input['antecipado_fim'] = !empty($input['antecipado_fim']) ? $this->date_convert($input['antecipado_fim'],'d/m/Y','Y-m-d H:i:s') : '';

        $mensagem = 'Não foi possível registrar o desconto! Tente novamente mais tarde.';
        $response = array(
            'status'	=> '0',
            'mensagem'	=> $mensagem
        );

		if(!empty($input['id'])){
			$evento = EventoPerfis::find($input['id'])->update($input);
			$id = $input['id'];
			$mensagem = 'Desconto registrado com sucesso.';
            $response = array(
                'status'	=> '1',
                'mensagem'	=> $mensagem,
                'id'		=> $id
            );
		}

        return Response::json( $response );
	}

	public function perfil_desconto_store(Request $request)
    {
		$input = $request->all();


		$input['data_inicio'] = !empty($input['data_inicio']) ? $this->date_convert($input['data_inicio'],'d/m/Y','Y-m-d H:i:s') : '';
		$input['data_fim'] = !empty($input['data_fim']) ? $this->date_convert($input['data_fim'],'d/m/Y','Y-m-d H:i:s') : '';

		$mensagem = '';
		if (!empty($input['evento_perfil_id'])) {
			$input['codigo'] = DB::raw("UPPER(UUID())");
			$evento = CupomDescontos::create($input);
			$id = $evento->id;

			$mensagem = 'Cupom de desconto adicionado com sucesso.';
		}

		$response = array(
            'status'	=> '1',
            'mensagem'	=> $mensagem,
            'id'		=> $id,
            'codigo'	=> CupomDescontos::find($id)->codigo
        );
 
        return Response::json( $response );
	}

	public function campo_condicoes_store(CampoCondicoesRequest $request)
    {
		$input = $request->all();
		$mensagem = 'Não foi possível adicionar a condição.';

		try {
			if (!empty($input['campo_id'])) {
				$condicao = CampoCondicoes::create($input);
				$id = $condicao->id;

				$mensagem = 'Condição adicionada com sucesso.';
			}

			$response = array(
	            'status'	=> '1',
	            'mensagem'	=> $mensagem,
	            'id'		=> $id
	        );
		} catch (Exception $e) {

			$response = array(
	            'status'	=> '0',
	            'mensagem'	=> $mensagem.': '.$e->getMessage()
	        );
		}
 
        return Response::json( $response );
	}

	public function perfil_campos_store(Request $request)
    {
		$input = $request->all();

		if (!empty($input['id'])) {
			Campos::find($input['id'])->update($input);
			$id = $input['id'];
			$mensagem = 'Campo alterado com sucesso.';
		} else {
            unset($input['id']);
			$evento = Campos::create($input);
			$id = $evento->id;
			$mensagem = 'Campo adicionado com sucesso.';
		}

		CampoAlternativas::where('campo_id',$id)->delete();
		
		if (isset($input['campo_alternativa'])) {
			foreach($input['campo_alternativa'] as $k => $alt){
				$alternativa = array('campo_id' => $id, 'alternativa' => $alt, 'ordem' => $k);
				CampoAlternativas::create($alternativa);
			}
		}

		$response = array(
            'status'	=> '1',
            'mensagem'	=> $mensagem,
            'id'		=> $id
        );
 
        return Response::json( $response );
	}

	public function perfil_campo_destroy(Request $request, $id)
    {
		$campo = Campos::find($id);
		$campo->campoAlternativas()->delete();
		$campo->campoCondicoes()->delete();

		if ($campo->delete()) {
			$response = [
							'status'	=> 1,
							'mensagem'	=> "Campo excluído com sucesso."
						];
		} else {
			$response = [
							'status'	=> 0,
							'mensagem'	=> "Não foi possível remover o Campo."
						];
		}

		return Response::json( $response );
	}

	public function perfil_desconto_destroy(Request $request, $id)
    {
		if (CupomDescontos::find($id)->delete()) {
			$response = [
							'status'	=> 1,
							'mensagem'	=> "Cupom de desconto excluído com sucesso."
						];
		} else {
			$response = [
							'status'	=> 0,
							'mensagem'	=> "Não foi possível remover o Cupom de desconto."
						];
		}

		return Response::json( $response );
	}

	public function campo_condicoes_destroy(Request $request, $id)
    {
		if (CampoCondicoes::find($id)->delete()) {
			$response = [
							'status'	=> 1,
							'mensagem'	=> "Condição excluída com sucesso."
						];
		} else {
			$response = [
							'status'	=> 0,
							'mensagem'	=> "Não foi possível remover a Condição."
						];
		}

		return Response::json( $response );
	}

	public function perfil_edit(Request $request, $id)
    {
		//dados do perfil
		$evento_perfil = EventoPerfis::find($id)->toArray();
		$evento_perfil['data_inicio'] = !empty($evento_perfil['data_inicio']) ? $this->date_convert($evento_perfil['data_inicio'],'Y-m-d H:i:s','d/m/Y') : '';
		$evento_perfil['data_fim'] = !empty($evento_perfil['data_fim']) ? $this->date_convert($evento_perfil['data_fim'],'Y-m-d H:i:s','d/m/Y') : '';

		$evento_perfil['antecipado_inicio'] = !empty($evento_perfil['antecipado_inicio']) ? $this->date_convert($evento_perfil['antecipado_inicio'],'Y-m-d H:i:s','d/m/Y') : '';
		$evento_perfil['antecipado_fim'] = !empty($evento_perfil['antecipado_fim']) ? $this->date_convert($evento_perfil['antecipado_fim'],'Y-m-d H:i:s','d/m/Y') : '';

		//cupons de desconto
		$cupons_desconto = CupomDescontos::where('evento_perfil_id',$id)->get()->toArray();
		foreach ($cupons_desconto as $k => $c) {
			$cupons_desconto[$k]['data_inicio'] = !empty($c['data_inicio']) ? $this->date_convert($c['data_inicio'],'Y-m-d H:i:s','d/m/Y') : '';
			$cupons_desconto[$k]['data_fim'] = !empty($c['data_fim']) ? $this->date_convert($c['data_fim'],'Y-m-d H:i:s','d/m/Y') : '';
		}

		$response = [
						'status'	=> 1,
						'evento_perfil' => $evento_perfil,
						'cupons_desconto' => $cupons_desconto
					];

		return Response::json( $response );
	}

	public function perfil_campos_list(Request $request, $id)
    {
		$campos = Campos::select(
                "campos.id", "campos.evento_perfil_grupo_id", "campos.campo", "campos.obrigatorio", "campo_tipos.tipo"
            )
            ->join('campo_tipos', function($join) {
                $join->on('campo_tipos.id', '=', 'campos.campo_tipo_id');
            })
            ->where('evento_perfil_id',$id)
            ->orderBy('ordem')->get()->toArray();
        $grupos = EventoPerfilGrupos::where('evento_perfil_id',$id)->orderBy('ordem')->get()->toArray();
		$response = [
						'status'	=> 1,
						'campos' => $campos,
                        'grupos' => $grupos
					];

		return Response::json( $response );
	}

	public function perfil_campo_edit(Request $request, $id)
    {
		$campo = Campos::find($id);
		$alternativas = CampoAlternativas::where('campo_id',$id)->orderBy('ordem')->get()->toArray();

		//die(var_dump($alternativas));
		$condicoes = CampoCondicoes::where('campo_id',$id)->get()->toArray();

		$response = [
						'status'	=> 1,
						'campo' => $campo->toArray(),
						'alternativas' => $alternativas,
						'condicoes' => $condicoes
					];

		return Response::json( $response );
	}

	public function perfil_campos_select(Request $request, $id)
    {
		$campos = Campos::where('evento_perfil_id',$id)->get()->toArray();
		$response = [
						'status'	=> 1,
						'campos' => $campos
					];

		return Response::json( $response );
	}

	public function campos_modelos_select(Request $request)
    {
		DB::enableQueryLog();

		$input = $request->all();
		$campos = CamposModelos::select(
						"campos_modelos.id",
						"campos.id AS campo_id",
						"campos_modelos.campo_tipo_id",
						"campos_modelos.campo",
						"campo_tipos.tipo",
						"campos_modelos.obrigatorio",
						"campos_modelos.duplicado",
						"campos_modelos.descricao",
						"campos_modelos.classe",
						"campos_modelos.autocomplete",
						"campos_modelos.mascara")
					->leftJoin('campo_tipos', function($join) {
				    	$join->on('campo_tipos.id', '=', 'campos_modelos.campo_tipo_id');
				    })
					->leftJoin('campos', function($join) use($input) {
				    	$join->on('campos.campo_modelo_id', '=', 'campos_modelos.id')
				    		->where('campos.evento_perfil_id', '=', $input['evento_perfil_id']);
				    })
					->get()->toArray();

		$response = [
						'query'	=> DB::getQueryLog(),
						'status'	=> 1,
						'campos' => $campos
					];

		return Response::json( $response );
	}

	public function campos_modelos_store(Request $request)
    {
		$input = $request->all();
		$campo = Campos::create($input);
		$id = $campo->id;
		$mensagem = 'Campo adicionado com sucesso.';
		
		$alternativas = CampoAlternativasModelos::where('campo_modelo_id',$input['campo_modelo_id'])->get()->toArray();
		CampoAlternativas::where('campo_id',$id)->delete();
		
		if (isset($alternativas)) {
			foreach($alternativas as $k => $alt){
				$alternativa = array('campo_id' => $id, 'alternativa' => $alt['alternativa'], 'ordem' => $k);
				CampoAlternativas::create($alternativa);
			}
		}

		$response = [
						'status'	=> 1,
						'id' => $id,
						'mensagem' => $mensagem
					];

		return Response::json( $response );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function perfil_destroy(Request $request, $id)
    {
		Campos::where('evento_perfil_id', '=', $id)->get()->each(function($campo) {
		    $campo->delete();
		});

		CupomDescontos::where('evento_perfil_id', '=', $id)->delete();
        EventoPerfilGrupos::where('evento_perfil_id', '=', $id)->delete();

		if (EventoPerfis::find($id)->delete()) {
			$response = [
							'status'	=> 1,
							'mensagem'	=> "Perfil do evento excluído com sucesso."
						];
		} else {
			$response = [
							'status'	=> 0,
							'mensagem'	=> "Não foi possível remover o Perfil do evento."
						];
		}

		return Response::json( $response );
	}

	public function fileDestroy(Request $request)
    {
		$input = $request->all();

		$path = [
			'logo' => '/img/logos/',
			'banner' => '/img/banners/',
			'background' => '/img/backgrounds/'
		];

		$dir = public_path().$path[$input['tipo']];

		Eventos::find($input['evento'])
			->update([$input['tipo'].'_arquivo_id' => NULL]);

	    if (Arquivos::find($input['id'])->delete()) {

	    	\File::delete($dir.'/'.$input['id'].'.'.$input['extensao']);
	    	
	    	return Response::json(['status' => 1, 'mensagem' => 'Imagem removida com sucesso.'], 200);
	    } else {
	    	return Response::json('error', 400);
	    }
	}

	public function designStore(Request $request)
    {
		$input = $request->all();

		$Eventos = Eventos::find($input['id'])
			->update($input);

	    if ($Eventos) {
	    	return Response::json(['status' => 1, 'mensagem' => 'Evento alterado com sucesso.'], 200);
	    } else {
	    	return Response::json('error', 400);
	    }
	}

	public function fileUpload(Request $request)
    {
		// Temporarily increase memory limit to 256MB
    	//ini_set('memory_limit','256M');
		//ini_set('memory_limit', '50M' );
		ini_set('memory_limit', '64M');

		$input = $request->all();
		$f = $input['file'];
		/*$rules = array(
		    'file' => 'image|max:3000',
		);

		$validation = \Validator::make($input, $rules);

		if ($validation->fails())
		{
			return Response::make($validation->errors->first(), 400);
		}*/

		$path = [
			'logo' => '/img/logos/',
			'banner' => '/img/banners/',
			'background' => '/img/backgrounds/'
		];

        $extension = strtolower($f->getClientOriginalExtension());
        $directory = public_path().$path[$input['tipo']];

        //$filename = sha1(time().time()).".{$extension}";

        DB::disableQueryLog();
        DB::connection()->disableQueryLog();

        /*$att = new Arquivos;
		$att->name = $f->getClientOriginalName();
		$att->file = base64_encode(file_get_contents($f->getRealPath()));
		$att->mime = $f->getMimeType();
		$att->size = $f->getSize();
		$id = $att->save();

		$id = $att->id;*/

		$data = [
        			'name' => $f->getClientOriginalName(),
					'mime' => $f->getMimeType(),
					//'file' => base64_encode(file_get_contents($f->getRealPath())),
					'extensao' => $extension,
					'size' => $f->getSize()
        		];

		$att = DB::table('arquivos')->insert($data);
		$id = DB::getPdo()->lastInsertId();

		$retorno = $data;
		$retorno['id'] = $id;

		$filename = $id.'.'.$extension;
		$upload_success = $f->move($directory, $filename);

		Eventos::find($input['evento'])->update([
			$input['tipo'].'_arquivo_id' => $id
		]);

        if( $upload_success ) {
        	return Response::json($retorno, 200);
        } else {
        	return Response::json('error', 400);
        }
	}

    public function grupoCamposOrder(Request $request)
    {
        $input = $request->all();

        foreach($input['tab-grupo-id'] as $k => $v){
            EventoPerfilGrupos::find($v)->update(['ordem' => $k]);
        }

        return Response::json( ['status' => 1, 'mensagem' => 'Grupos reordenados com sucesso.'] );
    }

	public function ordenar_campos(Request $request)
    {
		$input = $request->all();

		foreach($input['grid-campo-id'] as $k => $v){
			Campos::find($v)->update(['ordem' => $k]);
		}

		return Response::json( ['status' => 1, 'mensagem' => 'Campos reordenados com sucesso.'] );	
	}

	/**
	 * @param $input
	 * @param $in
	 * @param $out
	 * @return string
	 */
	private function date_convert($input,$in,$out)
    {
		$data = \DateTime::createFromFormat($in, $input);

		if ($data instanceof \DateTimeInterface) {
			$input = $data->format($out);
		}

		return $input;
	}
}