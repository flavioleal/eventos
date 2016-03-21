<?php

use Talentos\Area;
use Talentos\ProfissionalArea;
use Talentos\Profissional;
use Talentos\ProfissionalSolicitacao;
use Talentos\VFaixaEtariaProfissional;
use Talentos\VFaixaSalarialProfissional;

class Charts {
	
	protected static $chartsColor = [
		['color'=>"#F7464A",'highlight'=>"#FF5A5E"],
		['color'=>"#46BFBD",'highlight'=>"#5AD3D1"],
		['color'=>"#FDB45C",'highlight'=>"#FFC870"],
		['color'=>"#949FB1",'highlight'=>"#A8B3C5"],
		['color'=>"#4D5360",'highlight'=>"#616774"]
	];

    public static function areas() {
    	$areas = Area::all();
		$retorno = [];

		$countChartsColor = 0;
		foreach($areas as $k => $area){
			$totalProfissionais = ProfissionalArea::where('area_id',$area['id'])->count();
			if($totalProfissionais > 0){
				$retorno[] = [
					'value'=> $totalProfissionais,
					'label'=> $area['area'],
					'color'=> self::$chartsColor[$countChartsColor]['color'],
					'highlight'=> self::$chartsColor[$countChartsColor]['highlight']
				];
			}

			$countChartsColor = (count(self::$chartsColor)-1) === $countChartsColor ? 0 : $countChartsColor+1;
		}

		return json_encode($retorno);
    }

    public static function faixa_salarial(){
		$faixa_salarials = VFaixaSalarialProfissional::selectView()->get();
		$retorno = [];
		
		$countChartsColor = 0;
		foreach($faixa_salarials as $k => $faixa_salarial){
			$retorno[] = [
				'value'=> $faixa_salarial->total,
				'label'=> $faixa_salarial->faixa_salarial,
				'color'=> self::$chartsColor[$countChartsColor]['color'],
				'highlight'=> self::$chartsColor[$countChartsColor]['highlight']
			];

			$countChartsColor = (count(self::$chartsColor)-1) === $countChartsColor ? 0 : $countChartsColor+1;
		}
		
		return json_encode($retorno);
	}

	public static function faixa_etaria(){
		$faixa_etarias = VFaixaEtariaProfissional::selectView()->get();
		$retorno = [];

		$countChartsColor = 0;
		foreach($faixa_etarias as $k => $faixa_etaria){
			$retorno[] = [
				'value'=> $faixa_etaria->total,
				'label'=> $faixa_etaria->faixa_etaria,
				'color'=> self::$chartsColor[$countChartsColor]['color'],
				'highlight'=> self::$chartsColor[$countChartsColor]['highlight']
			];

			$countChartsColor = (count(self::$chartsColor)-1) === $countChartsColor ? 0 : $countChartsColor+1;
		}

		return json_encode($retorno);
	}

	public static function totalProfissional(){
		$profissionais = Profissional::whereRaw('data_expiracao > NOW()')->get();
		return $profissionais->count();
	}

	public static function totalProfissionalExpirando(){
		$profissionais = Profissional::whereRaw('NOW() >= DATE_SUB(data_expiracao, INTERVAL 15 DAY)')->get();
		return $profissionais->count();
	}

	public static function totalSolicitacaoPendente(){
		$profissionais = ProfissionalSolicitacao::whereRaw('status = 0')->get();
		return $profissionais->count();
	}
}

?>