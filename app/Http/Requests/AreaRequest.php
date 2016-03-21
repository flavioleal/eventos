<?php namespace Talentos\Http\Requests;

use Talentos\Http\Requests\Request;

class AreaRequest extends Request {

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

		return [
			'area'					=> 'required|min:2',
			'ativo'					=> 'required'
		];
	}

}
