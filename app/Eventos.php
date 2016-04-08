<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model {
	
	//
	protected $fillable = [
		'id',
		'titulo',
		'evento_categoria_id',
		'evento_tipo_id',
		'descricao',
		'data_inicio',
		'data_fim',
		'cep',
		'local',
		'logradouro',
		'numero',
		'complemento',
		'bairro',
		'municipio',
		'uf',
		'gllpLatitude',
		'gllpLongitude',
		'gllpZoom',
		'dia_inteiro',
		'logo_arquivo_id',
		'banner_arquivo_id',
		'background_arquivo_id',
		'cor_texto',
		'cor_predominante',
		'cor_fundo',
		'facebook',
		'twitter',
		'youtube',
		'slug',
		'credencial_html'
	];

	public function addHttp($url)
	{
		if (strpos($url, 'http://') === false) {
			return "http://" . $url;
		}
		return $url;
	}

	public function getFacebook()
	{
		$this->facebook = $this->addHttp($this->facebook);
		return $this->facebook;
	}

	public function getYoutube()
	{
		$this->youtube = $this->addHttp($this->youtube);
		return $this->youtube;
	}

	public function getTwitter()
	{
		$this->twitter = $this->addHttp($this->twitter);
		return $this->twitter;
	}


	public function getDataInicio()
	{
		return $this->dateFromString($this->data_inicio);
	}

	public function getDateFim()
	{
		return $this->dateFromString($this->data_fim);
	}

	private function dateFromString($string, $format = 'd/m/Y H:i:s')
	{
		$dateFormat = false;
		if (!empty($string)) {
			$date = \DateTime::createFromFormat('Y-m-d H:i:s',  $string);

			if (!$date instanceof \DateTimeInterface) {
				return false;
			}
			$dateFormat = $date->format($format);
		}

		return $dateFormat;
	}
}
