@extends('site/site')
@section('content')

<style type="">
	h1{
	    line-height: 90px;
	    text-align: right;
	    font-family: 'Source Sans Pro' !important;
	    font-weight: 100;
	    color: {{ $evento->cor_texto }} !important;
	}

	.wizard-card.ct-wizard-orange .nav-pills > li.active a{
		background-color: {{ $evento->cor_predominante }} !important;
	}

	.panel-primary > .panel-heading {
		background-color: {{ $evento->cor_predominante }};
		border-color: {{ $evento->cor_predominante }} !important;
	}

	.panel-primary {
		border-color: {{ $evento->cor_predominante }} !important;
	}

	.compumake-btn-orange:hover{
		background-color: {{ $evento->cor_predominante }};
	}

	.compumake-btn-orange.active{
		background-color: {{ $evento->cor_predominante }};
	}

	.compumake-btn-orange {
		border-color: {{ $evento->cor_predominante }};
		color: {{ $evento->cor_predominante }};
	}

	.pagina-interna-topo .container:after {
    	border-color: {{ $evento->cor_predominante }};
	}

	.pagina-interna-conteudo > h3{
		color: {{ $evento->cor_predominante }};
	}

	.pagina-interna-conteudo .conteudo-entrada > p,
	.pagina-interna-conteudo .conteudo-entrada > span{
		font-family: 'Source Sans Pro' !important;
		line-height: 18px !important;
		color: {{ $evento->cor_texto }} !important;
	}

	.pagina-interna-topo .container:after {
	    top: 302px;
	}

	.rodape{
		margin-top: 0px;
	}

	.compumake-btn{
		padding: 15px 30px;
		border-radius: 10px;
		font-size: 18px;	
	}


    .tooltip-inner {
        background-color: {{ $evento->cor_predominante }} !important;
        color: #FFF !important;
    }


    .tooltip.top .tooltip-inner:after {
        border-top: 11px solid {{ $evento->cor_predominante }} !important;
    }
    .tooltip.bottom .tooltip-inner:after {
        border-bottom: 11px solid {{ $evento->cor_predominante }} !important;
    }
    .tooltip.left .tooltip-inner:after {
        border-left: 11px solid {{ $evento->cor_predominante }} !important;
    }
    .tooltip.right .tooltip-inner:after {
        border-right: 11px solid {{ $evento->cor_predominante }} !important;
    }

	label.error {
		position: absolute;
		right: 0px;
		bottom: -20px;
	}

	.sk-circle {
		min-width: 20px;
		min-height: 20px;
		position: relative;
	}
	.sk-circle .sk-child {
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0;
		top: 0;
	}

	.sk-circle .sk-child:before {
		content: '';
		display: block;
		margin: 0 auto;
		width: 15%;
		height: 15%;
		background-color: #333;
		border-radius: 100%;
		-webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
		animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
	}
		.btn-primary .sk-circle .sk-child:before {
			background-color: #fff;
		}
	.sk-circle .sk-circle2 {
		-webkit-transform: rotate(30deg);
		-ms-transform: rotate(30deg);
		transform: rotate(30deg); }
	.sk-circle .sk-circle3 {
		-webkit-transform: rotate(60deg);
		-ms-transform: rotate(60deg);
		transform: rotate(60deg); }
	.sk-circle .sk-circle4 {
		-webkit-transform: rotate(90deg);
		-ms-transform: rotate(90deg);
		transform: rotate(90deg); }
	.sk-circle .sk-circle5 {
		-webkit-transform: rotate(120deg);
		-ms-transform: rotate(120deg);
		transform: rotate(120deg); }
	.sk-circle .sk-circle6 {
		-webkit-transform: rotate(150deg);
		-ms-transform: rotate(150deg);
		transform: rotate(150deg); }
	.sk-circle .sk-circle7 {
		-webkit-transform: rotate(180deg);
		-ms-transform: rotate(180deg);
		transform: rotate(180deg); }
	.sk-circle .sk-circle8 {
		-webkit-transform: rotate(210deg);
		-ms-transform: rotate(210deg);
		transform: rotate(210deg); }
	.sk-circle .sk-circle9 {
		-webkit-transform: rotate(240deg);
		-ms-transform: rotate(240deg);
		transform: rotate(240deg); }
	.sk-circle .sk-circle10 {
		-webkit-transform: rotate(270deg);
		-ms-transform: rotate(270deg);
		transform: rotate(270deg); }
	.sk-circle .sk-circle11 {
		-webkit-transform: rotate(300deg);
		-ms-transform: rotate(300deg);
		transform: rotate(300deg); }
	.sk-circle .sk-circle12 {
		-webkit-transform: rotate(330deg);
		-ms-transform: rotate(330deg);
		transform: rotate(330deg); }
	.sk-circle .sk-circle2:before {
		-webkit-animation-delay: -1.1s;
		animation-delay: -1.1s; }
	.sk-circle .sk-circle3:before {
		-webkit-animation-delay: -1s;
		animation-delay: -1s; }
	.sk-circle .sk-circle4:before {
		-webkit-animation-delay: -0.9s;
		animation-delay: -0.9s; }
	.sk-circle .sk-circle5:before {
		-webkit-animation-delay: -0.8s;
		animation-delay: -0.8s; }
	.sk-circle .sk-circle6:before {
		-webkit-animation-delay: -0.7s;
		animation-delay: -0.7s; }
	.sk-circle .sk-circle7:before {
		-webkit-animation-delay: -0.6s;
		animation-delay: -0.6s; }
	.sk-circle .sk-circle8:before {
		-webkit-animation-delay: -0.5s;
		animation-delay: -0.5s; }
	.sk-circle .sk-circle9:before {
		-webkit-animation-delay: -0.4s;
		animation-delay: -0.4s; }
	.sk-circle .sk-circle10:before {
		-webkit-animation-delay: -0.3s;
		animation-delay: -0.3s; }
	.sk-circle .sk-circle11:before {
		-webkit-animation-delay: -0.2s;
		animation-delay: -0.2s; }
	.sk-circle .sk-circle12:before {
		-webkit-animation-delay: -0.1s;
		animation-delay: -0.1s; }

	@-webkit-keyframes sk-circleBounceDelay {
		0%, 80%, 100% {
			-webkit-transform: scale(0);
			transform: scale(0);
		} 40% {
			  -webkit-transform: scale(1);
			  transform: scale(1);
		  }
	}

	@keyframes sk-circleBounceDelay {
		0%, 80%, 100% {
			-webkit-transform: scale(0);
			transform: scale(0);
		} 40% {
			  -webkit-transform: scale(1);
			  transform: scale(1);
		  }
	}
</style>
<header>
	<div class="sk-circle loader-css" style="display: none;">
		<div class="sk-circle1 sk-child"></div>
		<div class="sk-circle2 sk-child"></div>
		<div class="sk-circle3 sk-child"></div>
		<div class="sk-circle4 sk-child"></div>
		<div class="sk-circle5 sk-child"></div>
		<div class="sk-circle6 sk-child"></div>
		<div class="sk-circle7 sk-child"></div>
		<div class="sk-circle8 sk-child"></div>
		<div class="sk-circle9 sk-child"></div>
		<div class="sk-circle10 sk-child"></div>
		<div class="sk-circle11 sk-child"></div>
		<div class="sk-circle12 sk-child"></div>
	</div>
	<section class="topo">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 compumake-contato">
					<div class="row">
						<div class="col-md-12">
							<img style="max-height: 80px; margin: 20px 0;" class="img-responsive pull-left" src="{{ route('evento.fileShow', ['id' => $evento->logo_arquivo_id,'tipo' => 'logo','ext' => $evento->logo_extensao]) }}"/>
							<h1 style="line-height: 90px; text-align: right;">
								{{ $evento->titulo }}
							</h1>
						</div>
						<div class="hide col-md-3 compumake-content-menu">
							<nav class="navbar navbar-default">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#compumake-menu" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand visible-sm visible-xs" href="{{ url() }}">
										<div class="compumake-logo"></div>
									</a>
								</div>
								<div class="collapse navbar-collapse" id="compumake-menu">
									<ul class="nav navbar-nav">
										<li><a href="#">Sobre o evento</a></li>
										<li><a href="#" class="contato">Inscrição</a></li>
										<li><a href="#" class="contato">Contato</a></li>
									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@if(is_null(Route::current()->getName()) || Route::current()->getName() == 'site.index')
	<section class="banners owl-carousel">
		<div class="banner-item item" data-banner="item-1">
			<div class="banner-content">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<h3 class="wow animated fadeInLeft" data-wow-iteration="1" data-wow-duration="1s" data-wow-delay="">Sistema de Eventos:</h3>
							<p class="wow animated fadeIn" data-wow-delay="1s">responsabilidade social e gestão da marca da empresa para o público interno e comunidade</p>
							<a data-wow-delay="2000ms" href="#" class="compumake-btn wow animated bounceIn">saiba +</a>
						</div>
						<div class="col-sm-6">
							<div class="banner-item-img hidden-xs">
									<div class="animated fadeInRight wow banner-item-pessoa" data-wow-duration="1s"></div>
									<div class="animated zoomIn wow banner-item-box-virtual" data-wow-delay="1s"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<div class="banner-item item" data-banner="item-2">
			<div class="banner-content">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<h3 class="wow animated fadeInUp" data-wow-iteration="1" data-wow-duration="1s" data-wow-delay="">Locação de equipamentos:</h3>
							<p class="wow animated fadeIn" data-wow-delay="1s">os melhores currículos de altos<br> executivos a custo zero</p>
							<a data-wow-delay="2000ms" href="#" class="compumake-btn wow animated fadeInUp">saiba +</a>
						</div>
						<div class="col-sm-6">
							<div class="banner-item-img hidden-xs">
								<div class="col-md-12">
									<div class="animated fadeInRight wow banner-item-pessoa" data-wow-duration="1s"></div>
									<div class="animated zoomIn wow banner-item-box-virtual" data-wow-delay="1s"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
</header>

<section class="pagina-interna-topo" style="background-size: cover; height: 300px; background-image: url('{{ route('evento.fileShow', ['id' => $evento->banner_arquivo_id,'tipo' => 'banner','ext' => $evento->banner_extensao]) }}'); background-color: {{ $evento->cor_predominante }} !important">
	<div class="container">
		<h2></h2>
	</div>
</section>
<iframe class="hide" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d59869.67864956769!2d-40.3234375!3d-20.3062716!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6833bf2137e349f8!2sAcroy+Consultoria+em+RH!5e0!3m2!1spt-BR!2sbr!4v1443410911266" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
<section class="pagina-interna-conteudo formulario">
	<div class="container">
		<div class="row conteudo-entrada">
			<div class="col-sm-12">
				<h3 class="first-title">Sobre o evento</h3>
				<p>
					{!! $evento->descricao !!}
				</p>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<a id="btn-inscricao" href="#"  class="btn-lg compumake-btn-orange compumake-btn btn-submit-xhr">Inscreva-se</a>
						<a id="btn-inscricao" href="#"  class="btn-lg compumake-btn-orange compumake-btn btn-submit-xhr">Já sou inscrito</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row conteudo-inscricao" style="display: none;">
			<h3 class="first-title">Formulário de Inscrição</h3>
			<div class="formulario-inscricao"></div>
			<hr>
			<div class="row hide">
				<div class="col-md-12">
					<a id="btn-voltar" href="#"  class="btn-lg compumake-btn-orange compumake-btn btn-submit-xhr">Voltar</a>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="map" style="margin: 20px 0 0 0; width: 100%; height:300px">Google Maps</div>

<footer class="rodape">
	<div class="container">
		<div class="row">
			<div class="col-md-6 compumake-footer-contato col-sm-6">
				<a href="{{ url() }}" class="compumake-footer-logo"></a>
				<address class="compumake-footer-endereco">
					Rua José Alexandre Buaiz, 300 <br>
					Salas 1117 e 1118.<br>
					Enseada do Suá<br>
					29050-545 - Vitória - ES
				</address>
				<div class="compumake-footer-telefone">
					(27) 3315-9039
				</div>
			</div>
			<div class="col-md-6 compumake-footer-social col-sm-6">
				<div class="pull-right text-right">
					<div class="compumake-social">
						<a href="https://www.facebook.com/Compumake-Consultoria-em-RH-178168332216922/" target="_blank" class="compumake-facebook"></a>
						<a href="https://www.youtube.com/user/Compumakeconsult" target="_blank" class="compumake-youtube"></a>
						<a href="https://twitter.com/compumake_consult" target="_blank" class="compumake-twitter"></a>
					</div>
					<p class="direitos-reservados">
						<span>© 2015 / Compumake Locação de Computadores</span><br>
						<span>todos os direitos reservados</span>
					</p>
					<a href="http://criacaox.com" class="criacao-x-logo pull-right" target="_blank">
						<span class="powered-by">powered By</span> criação X
					</a>
				</div>
			</div>
		</div>
	</div>
</footer>

<script>
	var page = $("html, body");

	$(document).ready(function() {

		page.on("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove", function(){
			page.stop();
		});

		$('#btn-inscricao').on('click',function(e){
			e.preventDefault();
			$.ajax({
				url: "{{ route('site.inscricao', ['id' => $evento->id]) }}",
				type: "GET",
				dataType: "html",
			}).done(function(retorno){
				$('.conteudo-entrada').hide();
				$('.formulario-inscricao').html(retorno);
				$('.conteudo-inscricao').fadeIn();
			});
		});

		$('#btn-voltar').on('click',function(e){
			e.preventDefault();
			$('.conteudo-inscricao').hide();
			$('.conteudo-entrada').fadeIn();
		});

		//$('#btn-inscricao').trigger('click');
	});
	var marker,map, infowindow;
	function initMap() {

		var lat = '{{ $evento->gllpLatitude }}'; //$(cssID).find('[name="gllpLatitude"]').val(),
			lng = '{{ $evento->gllpLongitude }}'; //$(cssID).find('[name="gllpLongitude"]').val(),
			zoom = '{{ $evento->gllpZoom }}'; //$(cssID).find('[name="gllpZoom"]').val();

		lat = lat != '' ? lat : -19.9196218;
		lng = lng != '' ? lng : -43.9484353;
		zoom = parseInt(zoom) > 0 ? parseInt(zoom) : 12;

		var myLatLng = new google.maps.LatLng(lat,lng),
			myOptions = {
				center: myLatLng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				zoom: zoom,
				scrollwheel: false,
				mapTypeControl: false,
				disableDoubleClickZoom: true,
				zoomControlOptions: true,
				streetViewControl: false
			};

		map = new google.maps.Map(document.getElementById('map'),myOptions),
		marker = new google.maps.Marker({
			map:map,
			position: myLatLng,
			draggable: true,
			animation: google.maps.Animation.DROP
		}),
		infowindow = new google.maps.InfoWindow(),
		geocoder = new google.maps.Geocoder();
	}

</script>
@endsection