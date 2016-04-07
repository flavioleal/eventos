<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UserRequest extends Request {

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
				'name' => 'required|max:255'
	        ];

		if (Request::isMethod('put') && $this->user_id && Auth::check()){
			$rules['password'] = 'confirmed|min:6';
			$rules['email']	= "required|email|max:255|unique:users,email,{$this->user_id},id";
		}else{
			$rules['password'] = 'required|confirmed|min:6';
			
			$rules['email']	= 'required|email|max:255|unique:users';
		}

		return $rules;
	}

}
