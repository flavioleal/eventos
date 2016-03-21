<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/png" href="/img/favicon_.png?v=2">
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Eventos</title>

	<link href="/css/app.css" rel="stylesheet">
	{!! Html::style('js/datepicker/css/bootstrap-datepicker.css') !!}
	{!! Html::style('js/multiselect/css/bootstrap-multiselect.css') !!}
	{!! Html::style('css/animate.css') !!}
	{!! Html::style('css/charts.css') !!}
	{!! Html::style('css/custom.css') !!}
	{!! Html::style('fonts/awesome/css/font-awesome.css') !!}

	{!! Html::style('js/jasny-bootstrap/css/jasny-bootstrap.css') !!}


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		
	</style>
</head>
<body>
	<header class="background-topo">
		<div class="container">
			<!--
			<nav class="navbar navbar-default hide">
				<div class="row">
					<div class="col-md-12">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle Navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand app-logo" href="{{ route('admin.home') }}">
								- Sistema de Eventos
							</a>
						</div>

						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								@if (!Auth::guest())
									<li><a href="{{ route('admin.home') }}">Home</a></li>
									<li><a href="{{ route('admin.evento') }}">Eventos</a></li>
									<li><a href="{{ route('admin.participante') }}">Participantes</a></li>
									<li><a href="{{ route('admin.financeiro') }}">Financeiro</a></li>
									<li><a href="{{ route('admin.divulgacao') }}">Divulgação</a></li>
									<li><a href="{{ route('admin.certificacao') }}">Certificação</a></li>
									<li><a href="{{ route('admin.usuario') }}">Usuários</a></li>
								@endif
							</ul>

							<ul class="nav navbar-nav navbar-right">
								@if (!Auth::guest())
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
											{{ Auth::user()->name }}
										<span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="#Perfil" class="btn-cadastrar" data-modal="modal-cadastrar-perfil" data-href="{{ route('perfil.edit') }}">
													<span class="glyphicon glyphicon-cog"></span> Perfil
												</a>
											</li>
											<li>
												<a href="/auth/logout">
													<span class="glyphicon glyphicon-log-out"></span> Sair
												</a>
											</li>
										</ul>
									</li>
								@endif
							</ul>
						</div>
					</div>
				</div>

			</nav>-->

		</div>
	</header>

	
	<style>
		body,html{
			height: 100%;
		}

		/* remove outer padding */
		.main .row{
			padding: 0px;
			margin: 0px;
		}

		/*Remove rounded coners*/

		nav.sidebar.navbar {
			border-radius: 0px;
			/*position: fixed;
			overflow: scroll;*/
		}

		nav.sidebar, .main{
			-webkit-transition: margin 200ms ease-out;
		    -moz-transition: margin 200ms ease-out;
		    -o-transition: margin 200ms ease-out;
		    transition: margin 200ms ease-out;
		}

		/* Add gap to nav and right windows.*/
		.main{
			padding: 10px 10px 0 10px;
		}

		/* .....NavBar: Icon only with coloring/layout.....*/

		/*small/medium side display*/
		@media (min-width: 768px) {

			/*Allow main to be next to Nav*/
			.main{
				position: absolute;
				width: calc(100% - 40px); /*keeps 100% minus nav size*/
				margin-left: 40px;
				float: right;
			}

			/*lets nav bar to be showed on mouseover*/
			nav.sidebar:hover + .main{
				margin-left: 200px;
			}

			/*Center Brand*/
			nav.sidebar.navbar.sidebar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {
				margin-left: 0px;
			}
			/*Center Brand*/
			nav.sidebar .navbar-brand, nav.sidebar .navbar-header{
				text-align: center;
				width: 100%;
				margin-left: 0px;
			}

			/*Center Icons*/
			nav.sidebar a{
				padding-right: 13px;
			}

			/*adds border top to first nav box */
			nav.sidebar .navbar-nav > li:first-child{
				border-top: 1px #333 solid;
			}

			/*adds border to bottom nav boxes*/
			nav.sidebar .navbar-nav > li{
				border-bottom: 1px #333 solid;
			}

			/* Colors/style dropdown box*/
			nav.sidebar .navbar-nav .open .dropdown-menu {
				position: static;
				float: none;
				width: auto;
				margin-top: 0;
				background-color: transparent;
				border: 0;
				-webkit-box-shadow: none;
				box-shadow: none;
			}

			/*allows nav box to use 100% width*/
			nav.sidebar .navbar-collapse, nav.sidebar .container-fluid{
				padding: 0 0px 0 0px;
			}

			/*colors dropdown box text */
			.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
				color: #777;
			}

			/*gives sidebar width/height*/
			nav.sidebar{
				width: 200px;
				height: 100%;
				margin-left: -160px;
				float: left;
				z-index: 8000;
				margin-bottom: 0px;
			}

			/*give sidebar 100% width;*/
			nav.sidebar li {
				width: 100%;
			}

			/* Move nav to full on mouse over*/
			nav.sidebar:hover{
				margin-left: 0px;
			}
			/*for hiden things when navbar hidden*/
			.forAnimate{
				opacity: 0;
			}
		}

		/* .....NavBar: Fully showing nav bar..... */

		@media (min-width: 1330px) {

			/*Allow main to be next to Nav*/
			.main{
				width: calc(100% - 200px); /*keeps 100% minus nav size*/
				margin-left: 200px;
			}

			/*Show all nav*/
			nav.sidebar{
				margin-left: 0px;
				float: left;
			}
			/*Show hidden items on nav*/
			nav.sidebar .forAnimate{
				opacity: 1;
			}
		}

		nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover, nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {
			color: #CCC;
			background-color: transparent;
		}

		nav:hover .forAnimate{
			opacity: 1;
		}
		section{
			padding-left: 15px;
		}

		.navbar-inverse.sidebar .app-logo{
			opacity:1;
		}

	</style>

	<nav class="navbar navbar-inverse sidebar" role="navigation">
	    <div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-canvas="body" data-target="#bs-sidebar-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand app-logo" href="#"></a>
			</div>
			<div class="" id="bs-sidebar-navbar-collapse-1">
				<ul class="nav navbar-nav">
					
					<li><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
					
					<li ><a href="#">Eventos<span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-calendar-check-o"></span></a></li>
					
					<li ><a href="#">Participantes<span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-users"></span></a></li>
					<li ><a href="#">Financeiro<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon glyphicon-usd"></span></a></li>
					<li ><a href="#">Divulgação<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon glyphicon-bullhorn"></span></a></li>
					<li ><a href="#">Certificação<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-education"></span></a></li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuários <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<section class="eventos-content main">
		@yield('content')
	</section>

	<!-- Modal Operador-->
	<div class="modal fade modal-cadastrar" id="modal-cadastrar-perfil" tabindex="-1" role="dialog" aria-labelledby="modal-cadastrar-operador-titulo">
		<div class="modal-dialog" role="document">
			<div class="modal-content formulario">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-cadastrar-operador-titulo">
						<span class="glyphicon glyphicon-user"></span> Perfil do Gestor/Operador
					</h4>
				</div>
				<div class="modal-body">
					<div class="loader"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button data-acao="atualizar" data-url="{{ route('perfil.update') }}" data-redirect="/{{ Route::getCurrentRoute()->getPath() }}" type="button" class="btn btn-primary btn-modal-save">
						<span class="glyphicon glyphicon-floppy-save"></span> Salvar
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade modal-cadastrar" id="modal-cadastrar-operador" tabindex="-1" role="dialog" aria-labelledby="modal-cadastrar-operador-titulo">
		<div class="modal-dialog" role="document">
			<div class="modal-content formulario">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal-cadastrar-operador-titulo">
						<span class="glyphicon glyphicon-user"></span> Cadastro do Gestor/Operador
					</h4>
				</div>
				<div class="modal-body">
					<div class="loader"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button data-acao="atualizar" type="button" data-redirect="/{{ Route::getCurrentRoute()->getPath() }}" class="btn btn-primary btn-modal-save">
						<span class="glyphicon glyphicon-floppy-save"></span> Salvar
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script type="text/javascript">
		var ENDERECO = '{{ Request::url() }}';
		var URL = {
		};

		var doughnutDataAreas = {};
		var doughnutDataFaixaEtaria = {};
		var doughnutDataFaixaSalarial = {};
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	{!! Html::script('js/jquery.mask.js') !!}
	{!! Html::script('js/datepicker/js/bootstrap-datepicker.js') !!}
	{!! Html::script('js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js') !!}
	{!! Html::script('js/multiselect/js/bootstrap-multiselect.js') !!}
	{!! Html::script('js/Chart.js') !!}
	{!! Html::script('js/app.js') !!}
	{!! Html::script('js/notificar.js') !!}
	{!! Html::script('js/jasny-bootstrap/js/jasny-bootstrap.js') !!}

	<script>
		function htmlbodyHeightUpdate(){
			var height3 = $( window ).height()
			var height1 = $('.nav').height()+50
			height2 = $('.main').height()
			if(height2 > height3){
				$('html').height(Math.max(height1,height3,height2)+10);
				$('body').height(Math.max(height1,height3,height2)+10);
			}
			else
			{
				$('html').height(Math.max(height1,height3,height2));
				$('body').height(Math.max(height1,height3,height2));
			}
			
		}
		$(document).ready(function () {
			htmlbodyHeightUpdate()
			$( window ).resize(function() {
				htmlbodyHeightUpdate()
			});
			$( window ).scroll(function() {
				height2 = $('.main').height()
	  			htmlbodyHeightUpdate()
			});
		});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajaxSetup({
			    headers:{
			        'X-CSRF-TOKEN':'{!! csrf_token() !!}'
			    }
			});

			@if(Session::has('sucesso'))
				Notificar.sucesso('{!! Session::get("sucesso") !!}');
			@endif

			@if(Session::has('informacao'))
				Notificar.informacao('{!! Session::get("informacao") !!}');
			@endif

			@if(Session::has('erro'))
				Notificar.erro('{!! Session::get("erro") !!}');
			@endif
		});
	</script>
	<div id="messages"></div>
</body>
</html>
