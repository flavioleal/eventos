<?php namespace Talentos\Http\Controllers\Admin;

use Talentos\Eventos;
use Talentos\Http\Controllers\Controller;
use Talentos\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
	}

	public function index()
	{
		$eventos = Eventos::select('id', 'titulo')->get();
		return view('admin.index', ['eventos' => $eventos]);
	}
}