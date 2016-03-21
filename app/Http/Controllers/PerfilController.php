<?php namespace Talentos\Http\Controllers;

use Talentos\Http\Requests;
use Talentos\Http\Controllers\Controller;

use Talentos\Http\Requests\UserRequest;
use Talentos\VEmpresaSolicitacao;
use Talentos\Empresa;
use Talentos\User;

use Response;
use Session;
use Hash;

use Illuminate\Http\Request;
use Auth;

class PerfilController extends Controller {

	public function edit(){
		$id = Auth::user()->id;

		if(Auth::user()->role_id == 4){
			$empresa = VEmpresaSolicitacao::where('user_id','=',$id)->get()->toArray();
			$empresa = $empresa[0];
			$view = ['empresa' => $empresa];
			return view('empresa.edit',$view);
		}else{
			$operador = User::find($id)->toArray();
			$view = ['operador' => $operador];
			return view('operador.edit',$view);
		}
	}

	public function update(UserRequest $request){
		$id = Auth::user()->id;

		$input = $request->all();
		if(empty($input['password']))
			unset($input['password']);
		else
			$input['password'] = Hash::make($input['password']);

		$user = User::find($input['user_id'])->update($input);

		if(Auth::user()->role_id == 4){
			$empresa = Empresa::find($input['id']);
			$empresa->empresa = $input['empresa'];
	        $empresa->telefone = $input['telefone'];
	        $empresa->update();
	    }

		$response = array(
            'status'	=> '1',
            'mensagem'	=> 'Perfil atualizado com sucesso.',
        );

        return Response::json( $response );
	}

}
