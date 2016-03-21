<?php namespace Talentos\Http\Controllers\Auth;

use Talentos\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

	protected $redirectPath = 'auth/redireciona';

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	
	public function getRegister(){
		if (!$this->auth->check()){
			Session::flash('erro','Área de acesso restrito.');
			return new RedirectResponse(url('index'));
		}
		else if ($this->auth->user()->role_id == 4){
			Session::flash('erro','O seu perfil não tem acesso a essa funcionalidade.');
			return new RedirectResponse(url('usuario/home'));
		}

		return view('auth.register');
	}

	/*
	public function postRegister(){

	}*/

	public function redireciona(){
		if ((int) $this->auth->user()->ativo !== 1){
			Session::flash('erro','O seu operador não está ativo.');
			Auth::logout();
			return new RedirectResponse(url('index'));
		}

		switch($this->auth->user()->role_id){
			case 1:
			case 2:
			case 3:
				$redirect = 'admin/home';
				break;
			case 4:
				$redirect = 'usuario/home/';
				break;
			default:
				$redirect = 'home';
				break;
		}
		
		$tempo = (date('H') < 12) ? 'Bom dia' : ((date('H') < 18) ? 'Boa tarde' : 'Boa noite');

		Session::flash('sucesso',$tempo.' '.$this->auth->user()->name."! Seja bem vindo(a).");
		return redirect($redirect);
	}

}
