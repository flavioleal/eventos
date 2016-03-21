<?php namespace Talentos\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Talentos\Http\Requests;
use Illuminate\Http\Request;
use Talentos\Eventos;
use Talentos\EventoPerfilGrupos;
use Talentos\Arquivos;
use Goutte\Client;
use Cpf;
use Cnpj;

use DB;

class HomeController extends Controller {

	/**
	 * Show the application dashboard to the userbv.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('site.index');
	}

	public function inscricao(Request $request, $id)
	{
		$perfis = $this->getEventoById($id);
		$grupos = $this->getGruposByEventoId($id);
		$campos = $this->getCamposByEventoId($id);
		$alternativas = $this->getAlternativasByEventoId($id);
        $condicoes = $this->getCondicoesByEventoId($id);

		$tamanho = [1 => 'col-md-12', 2 => 'col-md-6', 3 => 'col-md-4'];

		return view('site.inscricao',
			[
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
		return view('site.evento')->with('evento', $evento[0]);
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
			"evento_perfis.titulo"
		)
			->join('evento_perfis', function($join){
				$join->on('evento_perfis.evento_id', '=', 'eventos.id');
			})
			->where('eventos.id', '=', $id)
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

}
