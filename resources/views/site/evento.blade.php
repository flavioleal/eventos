@extends('site/site')
@section('content')
@include('site/configuracao/style')
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
							<a href="{{ url() }}/evento/{{ $evento->slug }}">
								<img style="max-height: 80px; margin: 20px 0;" class="img-responsive pull-left"
									 @if (!empty($evento->logo_arquivo_id))
									 src="{{ route('evento.fileShow',
									 			[	'id' => $evento->logo_arquivo_id,
													'tipo' => 'logo',
													'ext' => $evento->logo_extensao
												]
											)
										}}"
									 @else
									 src="/img/compumake-logo.png"
									 @endif
								/>
							</a>
							<h1 style="line-height: 90px; text-align: right;">{{ $evento->titulo }}</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</header>
<section class="pagina-interna-topo">
	<div class="container">
		<h2></h2>
	</div>
</section>
<section class="pagina-interna-conteudo formulario">
	<div class="container">
		@yield('page')
	</div>
</section>
<div id="map" style="margin: 20px 0 0 0; width: 100%; height:300px">Google Maps</div>
<footer class="rodape">
	<div class="container">
		<div class="row">
			<div class="col-md-6 compumake-footer-contato col-sm-6">
				<a href="{{ url() }}" class="compumake-footer-logo"></a>
				<address class="compumake-footer-endereco">
					Rua Rio Grande do Sul, 1040 <br>
					Lourdes<br>
					30170-111 - Belo Horizonte - MG
				</address>
				<div class="compumake-footer-telefone">
					(31) 3335-3000
				</div>
			</div>
			<div class="col-md-6 compumake-footer-social col-sm-6">
				<div class="pull-right text-right">
					<div class="compumake-social">
						<a href="{{ $evento->getFacebook() }}"
						   target="_blank" class="compumake-facebook"></a>
						<a href="{{ $evento->getYoutube() }}" target="_blank" class="compumake-youtube"></a>
						<a href="{{ $evento->getTwitter() }}" target="_blank" class="compumake-twitter"></a>
					</div>
					<p class="direitos-reservados">
						<span>© 2015 / Compumake Locação de Computadores</span><br>
						<span>todos os direitos reservados</span>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
@include('site/configuracao/script')
@endsection