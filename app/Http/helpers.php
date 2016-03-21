<?php #namespace Talentos\Http;

use Talentos\Area;
use Talentos\ProfissionalArea;
use Talentos\Profissional;
use Talentos\VFaixaEtariaProfissional;
use Talentos\VFaixaSalarialProfissional;

class Charts {

	public $countChartsColor = 0;

	protected $chartsColor = [
		['color'=>"#F7464A",'highlight'=>"#FF5A5E"],
		['color'=>"#46BFBD",'highlight'=>"#5AD3D1"],
		['color'=>"#FDB45C",'highlight'=>"#FFC870"],
		['color'=>"#949FB1",'highlight'=>"#A8B3C5"],
		['color'=>"#4D5360",'highlight'=>"#616774"]
	];

	public static function areas(){
		$areas = Area::all();
		$retorno = [];

		foreach($areas as $k => $area){
			$totalProfissionais = ProfissionalArea::where('area_id',$area['id'])->count();
			if($totalProfissionais > 0){
				$retorno[] = [
					'value'=> $totalProfissionais,
					'label'=> $area['area'],
					'color'=> $this->chartsColor[$this->countChartsColor]['color'],
					'highlight'=> $this->chartsColor[$this->countChartsColor]['highlight']
				];
			}

			$this->countChartsColor = (count($this->chartsColor)-1) === $this->countChartsColor ? 0 : $this->countChartsColor+1;
		}

		return json_encode($retorno);
	}

	public static function faixa_salarial(){
		$faixa_salarials = VFaixaSalarialProfissional::all();
		$retorno = [];
		
		foreach($faixa_salarials as $k => $faixa_salarial){
			$retorno[]] = [
				'value'=> $faixa_salarial['total'],
				'label'=> $faixa_salarial['faixa_salarial'],
				'color'=> $this->chartsColor[$this->countChartsColor]['color'],
				'highlight'=> $this->chartsColor[$this->countChartsColor]['highlight']
			];

			$this->countChartsColor = count($this->chartsColor)-1 === $this->countChartsColor ? 0 : $this->countChartsColor+1;
		}
		
		return json_encode($retorno);
	}

	public static function faixa_etaria(){
		$faixa_etarias = VFaixaEtariaProfissional::all();
		$retorno = [];

		foreach($faixa_etarias as $k => $faixa_etaria){
			$view['charts']['faixa_etaria'][] = [
				'value'=> $faixa_etaria['total'],
				'label'=> $faixa_etaria['faixa_etaria'],
				'color'=> $this->chartsColor[$this->countChartsColor]['color'],
				'highlight'=> $this->chartsColor[$this->countChartsColor]['highlight']
			];

			$this->countChartsColor = count($this->chartsColor)-1 === $this->countChartsColor ? 0 : $this->countChartsColor+1;
		}

		return json_encode($retorno);
	}

}
