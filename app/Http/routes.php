<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...

Route::get('', 'HomeController@index');
Route::get('site','HomeController@index');
Route::get(
	'evento/{slug?}',
	[
		'as'=>'site.evento',
		'uses'=>'HomeController@evento'
	]
);
Route::get(
	'inscricao/{slug}',
	[
		'as'=>'site.inscricao',
		'uses'=>'HomeController@inscricao'
	]
);
Route::any(
	'acesso/{slug?}',
	[
		'as'=>'site.access',
		'uses'=>'HomeController@access'
	]
);

Route::get(
	'participante/{slug?}',
	[
		'as'=>'site.participant',
		'uses'=>'HomeController@participant'
	]
);

Route::get(
	'participante/logout/{slug?}',
	[
		'as'=>'participant.logout',
		'uses'=>'HomeController@logoutParticipant'
	]
);

Route::post(
	'cnpj',
	[
		'as'=>'site.cnpj',
		'uses'=>'HomeController@cnpj'
	]
);

Route::post(
	'evento/store',
	[
		'as'=>'site.eventoStore',
		'uses'=>'HomeController@store'
	]
);

Route::post(
	'cpf',
	[
		'as'=>'site.cpf',
		'uses'=>'HomeController@cpf'
	]
);

Route::get(
	'cep',
	[
		'as'=>'site.cep',
		'uses'=>'HomeController@cep'
	]
);

Route::group(['prefix'=>''],function(){
	Route::get('index',['as'=>'site.index','uses'=>'HomeController@index']);
});

Route::group(['prefix'=>'admin'],function(){
	Route::get('home',['as'=>'admin.home','uses'=>'HomeController@index']);
	Route::get('participante',['as'=>'admin.participante','uses'=>'ParticipanteController@index']);
	Route::get('financeiro',['as'=>'admin.financeiro','uses'=>'FinanceiroController@index']);
	Route::get('divulgacao',['as'=>'admin.divulgacao','uses'=>'DivulgacaoController@index']);
	Route::get('certificacao',['as'=>'admin.certificacao','uses'=>'CertificacaoController@counseling']);
	Route::get('usuario',['as'=>'admin.usuario','uses'=>'UsuarioController@counseling']);
});

Route::get('auth/redireciona', 'Auth\AuthController@redireciona');

Route::get('auth/register', [
	'middleware' => ['auth', 'roles'],
	'as'	=> 'auth.register',
	'uses' => 'Auth\AuthController@getRegister',
	'roles' => ['Master','Administrador','Gerência']
]);
Route::post('auth/register', [
	'middleware' => ['auth', 'roles'],
	'as'	=> 'auth.register',
	'uses' => 'Auth\AuthController@postRegister',
	'roles' => ['Master','Administrador','Gerência']
]);

Route::controllers([
   'password' => 'Auth\PasswordController',
]);

#Eventos
##Listar todas as áreas
##Metódo de inserção
Route::get(
	'admin/evento/{id?}',
	[
		'as'=>'admin.evento',
		'where'=>['id'=>'[0-9]+'],
		'uses'=>'Admin\EventoController@create',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/store',
	[
		'as'=>'evento.store',
		'uses'=>'Admin\EventoController@store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/design-store',
	[
		'as'=>'evento.designStore',
		'uses'=>'Admin\EventoController@designStore',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);


Route::post(
	'admin/evento/perfil-store',
	[
		'as'=>'evento.perfil_store',
		'uses'=>'Admin\EventoController@perfil_store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-campos-store',
	[
		'as'=>'evento.perfil_campos_store',
		'uses'=>'Admin\EventoController@storePerfilFields',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-grupos-store',
	[
		'as'=>'evento.perfil_grupos_store',
		'uses'=>'Admin\EventoController@perfil_grupos_store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/grupo-campos-destroy',
	[
		'as'=>'evento.grupo_campos_destroy',
		'uses'=>'Admin\EventoController@grupoCamposDestroy',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/grupo-campos-store',
	[
		'as'=>'evento.grupo_campos_store',
		'uses'=>'Admin\EventoController@grupoCamposStore',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/grupo-campos-order',
	[
		'as'=>'evento.grupo_campos_order',
		'uses'=>'Admin\EventoController@grupoCamposOrder',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-desconto-store',
	[
		'as'=>'evento.perfil_desconto_store',
		'uses'=>'Admin\EventoController@perfil_desconto_store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);


Route::post(
	'admin/evento/perfil-desconto-destroy/{id}',
	[
		'as'=>'evento.perfil_desconto_destroy',
		'where'=>['id'=>'[0-9]+'],
		'uses'=>'Admin\EventoController@perfil_desconto_destroy',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-cupom-store',
	[
		'as'=>'evento.perfil_cupom_store',
		'uses'=>'Admin\EventoController@perfil_cupom_store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/campo-condicoes-store',
	[
		'as'=>'evento.campo_condicoes_store',
		'uses'=>'Admin\EventoController@campo_condicoes_store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/campo-condicoes-destroy/{id}',
	[
		'as'=>'evento.campo_condicoes_destroy',
		'where'=>['id'=>'[0-9]+'],
		'uses'=>'Admin\EventoController@campo_condicoes_destroy',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-edit/{id}',
	[
		'as'=>'evento.perfil_edit',
		'uses'=>'Admin\EventoController@perfil_edit',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-campo-edit/{id}',
	[
		'as'=>'evento.perfil_campo_edit',
		'uses'=>'Admin\EventoController@perfil_campo_edit',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-campos-list/{id}',
	[
		'as'=>'evento.perfil_campos_list',
		'uses'=>'Admin\EventoController@perfil_campos_list',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-campo-destroy/{id}',
	[
		'as'=>'evento.perfil_campo_destroy',
		'uses'=>'Admin\EventoController@perfil_campo_destroy',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-campos-select/{id}',
	[
		'as'=>'evento.perfil_campos_select',
		'uses'=>'Admin\EventoController@perfil_campos_select',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/campos-modelos-select',
	[
		'as'=>'evento.campos_modelos_select',
		'uses'=>'Admin\EventoController@campos_modelos_select',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/campos-modelos-store',
	[
		'as'=>'evento.campos_modelos_sotre',
		'uses'=>'Admin\EventoController@campos_modelos_store',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/perfil-destroy/{id}',
	[
		'as'=>'evento.perfil_destroy',
		'where'=>['id'=>'[0-9]+'],
		'uses'=>'Admin\EventoController@perfil_destroy',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/upload',
	[
		'as'=>'evento.fileUpload',
		'uses'=>'Admin\EventoController@fileUpload',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/remover-arquivo',
	[
		'as'=>'evento.fileDestroy',
		'uses'=>'Admin\EventoController@fileDestroy',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::get(
	'evento/arquivo/{tipo}/{id}/{ext}',
	[
		'as'=>'evento.fileShow',
		'uses'=>'HomeController@fileShow'
	]
);

Route::post(
	'admin/evento/ordenar-campos',
	[
		'as'=>'evento.ordenar_campos',
		'uses'=>'Admin\EventoController@ordenar_campos',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::post(
	'admin/evento/ordenar-campo-alternativas',
	[
		'as'=>'evento.ordenar_campo_alternativas',
		'uses'=>'Admin\EventoController@ordenar_campo_alternativas',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::get(
	'admin/dashboard',
	[
		'as'=>'admin.dashboard',
		'uses'=>'Admin\DashboardController@index',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::get(
	'admin/home',
	[
		'as'=>'admin.dashboard',
		'uses'=>'Admin\DashboardController@index',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::any(
	'admin/lista-de-eventos',
	[
		'as'=>'evento.showAll',
		'uses'=>'Admin\EventoController@showAll',
		'middleware' => ['auth', 'roles'],
		'roles' => ['Master','Administrador','Gerência']
	]
);

Route::group(['prefix'=>'admin/participante'],function() {
	Route::any(
		'listagem/{evento?}',
		[
			'as'=>'attendee.showAll',
			'uses'=>'Admin\AttendeeController@showAll',
			'middleware' => ['auth', 'roles'],
			'roles' => ['Master','Administrador','Gerência']
		]
	);
	Route::any(
		'credencial/{participante}',
		[
			'as'=>'attendee.badge',
			'uses'=>'Admin\AttendeeController@credential',
			'middleware' => ['auth', 'roles'],
			'roles' => ['Master','Administrador','Gerência']
		]
	);
	Route::any(
		'credenciar/{participante}',
		[
			'as'=>'attendee.validate',
			'uses'=>'Admin\AttendeeController@validate',
			'middleware' => ['auth', 'roles'],
			'roles' => ['Master','Administrador','Gerência']
		]
	);
	Route::any(
		'modelo-credencial-v2/{evento}',
		[
			'as'=>'attendee.badgeModelV2',
			'uses'=>'Admin\AttendeeController@badgeModelV2',
			'middleware' => ['auth', 'roles'],
			'roles' => ['Master','Administrador','Gerência']
		]
	);
	Route::any(
		'modelo-credencial/{evento}',
		[
			'as'=>'attendee.badgeModel',
			'uses'=>'Admin\AttendeeController@badgeModel',
			'middleware' => ['auth', 'roles'],
			'roles' => ['Master','Administrador','Gerência']
		]
	);
	Route::any(
		'armazenar-modelo-credencial',
		[
			'as'=>'attendee.storeCredential',
			'uses'=>'Admin\AttendeeController@storeCredential',
			'middleware' => ['auth', 'roles'],
			'roles' => ['Master','Administrador','Gerência']
		]
	);
});