<?php namespace Talentos\Http\Controllers;

use Talentos\Http\Requests;
use Talentos\Http\Controllers\Controller;
use Talentos\Http\Requests\UserRequest;
use Talentos\User;

use Response;
use Session;
use Hash;

use Illuminate\Http\Request;

class UsuarioController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$operador = User::whereRaw('role_id = 3')->get();
		return view('operador.index',['operadores'=>$operador]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('operador.create');
	}

	public function store(UserRequest $request)
	{

		$input = $request->all();
		$input['role_id'] = 3;//Perfil Gestor
		$input['password'] = Hash::make($input['password']);
		$user = User::create($input);
		
		$response = array(
            'status'	=> '1',
            'mensagem'	=> 'Gestor/Usuario adicionado com sucesso.',
        );
        Session::flash('sucesso',"Gestor/Usuario adicionado com sucesso");

        return Response::json( $response );
	}

	
	public function edit($id){
		$operador = User::find($id)->toArray();
		$view = ['operador' => $operador];
		return view('operador.edit',$view);
	}

	public function update(UserRequest $request, $id){
		$input = $request->all();

		if(empty($input['password']) || is_null($input['password']))
			unset($input['password']);
		else
			$input['password'] = Hash::make($input['password']);

		$user = User::find($input['user_id'])->update($input);

		$response = array(
            'status'	=> '1',
            'mensagem'	=> 'Gestor/Usuario atualizado com sucesso.',
        );
        return Response::json( $response );
	}

	public function destroy(Request $request, $id){
		$input = $request->all();

		$mensagem = '';
		switch($input['acao']){
			case 'bloquear':
				$mensagem = 'bloqueado';
				$input['ativo'] = 0;
				break;
			case 'desbloquear':
				$mensagem = 'desbloqueado';
				$input['ativo'] = 1;
				break;
		}

		if($user = User::find($input['id'])->update($input)){
			$response = ['status'	=> '1'];
			Session::flash('sucesso',"Gestor/Usuario {$mensagem} com sucesso");
		}else{
			$response = [
							'status'	=> 0,
							'mensagem'	=> "Não foi possível ".$input['acao']." o Gestor/Usuario."
						];
		}

        return Response::json( $response );
	}

}
