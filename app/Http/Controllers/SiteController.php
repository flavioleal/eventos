<?php namespace Talentos\Http\Controllers;

use Talentos\Http\Requests;

class SiteController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Show the application dashboard to the userbv.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('site.index');
	}

	public function counseling()
	{
		return view('site.counseling');
	}

	public function quem_somos()
	{
		return view('site.quem_somos');
	}

	public function banco_de_talentos()
	{
		return view('site.banco_de_talentos');
	}

}
