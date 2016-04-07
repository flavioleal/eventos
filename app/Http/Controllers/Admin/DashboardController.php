<?php namespace App\Http\Controllers\Admin;

use App\Eventos;
use App\Http\Controllers\Controller;
use App\Http\Requests;
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