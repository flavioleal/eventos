<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		#die(var_dump($this->auth->user()));
		if ($this->auth->check())
		{
			/*switch($this->auth->user()->role_id){
				case 1:
				case 2:
				case 3:
					$redirect = 'admin/home';
					break;
				case 4:
					$redirect = 'usuario/home';
					break;
				default:
					$redirect = 'home';
					break;
			}

			Session::flash('sucesso','Olá '.$this->auth->user()->name."! Seja bem vindo(a).");
			return new RedirectResponse(url($redirect));*/
			//return new RedirectResponse(url('/'));
		}


		return $next($request);
	}

}
