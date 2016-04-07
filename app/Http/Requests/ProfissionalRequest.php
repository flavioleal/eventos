<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class ProfissionalRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */


	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{	

		$rules = [
				
				'data_inclusao'			=> 'required|date_format:d/m/Y',
				'data_expiracao'		=> 'required|date_format:d/m/Y|after:data_inclusao',
				'faixa_etarias_id'		=> 'required',
				'faixa_salarials_id'	=> 'required',
				'profissional_areas'	=> 'required',
				'sinopse'				=> 'required|min:2'
	        ];

		if (Request::isMethod('put') && $this->id && Auth::check()){
			$rules['cod_job'] = "required|unique:profissionals,cod_job,{$this->id},id";
		}else{
			$rules['cod_job'] = "required|unique:profissionals";
		}

		return $rules;
	}

}
