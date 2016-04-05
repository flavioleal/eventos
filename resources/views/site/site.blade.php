<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Compumake</title>

	<link href="/css/app.css" rel="stylesheet">
	{!! Html::style('fonts/awesome/css/font-awesome.css') !!}
	{!! Html::style('css/animate.css') !!}
	{!! Html::style('css/word-rotate.css') !!}
	{!! Html::style('css/custom.css') !!}
	{!! Html::style('js/owl-carousel-2/assets/owl.carousel.css') !!}
	{!! Html::style('css/site.css') !!}
	{!! Html::style('css/pagina-interna.css') !!}

	<!-- Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- Important Owl stylesheet -->
	<!--<link rel="stylesheet" href="/js/owl-carousel/owl.carousel.css">-->
	 
	<!-- Default Theme -->
	<!--<link rel="stylesheet" href="js/owl-carousel/owl.theme.css">-->
	
	<link rel="icon" type="image/png" href="/img/favicon.old.png?v=2">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<!--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
	{!! Html::script('assets/plugins/jquery/jquery-1.9.1.min.js') !!}
	{!! Html::script('assets/plugins/bootstrap/js/bootstrap.min.js') !!}
	{!! Html::script('js/jquery.mask.js') !!}
	{!! Html::script('js/datepicker/js/bootstrap-datepicker.js') !!}
	{!! Html::script('js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js') !!}
	{!! Html::script('js/multiselect/js/bootstrap-multiselect.js') !!}
	{!! Html::script('js/wow.js') !!}

	{!! Html::script('js/notificar.js') !!}
</head>
<body data-pagina="{{ Route::current()->getName() }}">
	<section>
		@yield('content')
	</section>

	<!-- Scripts -->
	<script type="text/javascript">
		var ENDERECO = "{{ url() }}";
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$.ajaxSetup({
			    headers:{'X-CSRF-TOKEN':'{!! csrf_token() !!}'}
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
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAsJG9VU0Mc4M_J3xFTrNzHx5Yt3gedl9I&libraries=places&callback=initMap"></script>
</body>
</html>
