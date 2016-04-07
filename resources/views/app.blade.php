<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Compumake | Dashboard</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<link rel="icon" type="image/png" href="/img/icon/favicon.ico">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<link href="/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />

	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.min.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/orange.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN FORM WIZARD STYLE ================== -->
	<link href="/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END FORM WIZARD STYLE ================== -->

	<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

	<link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="/assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
    <link href="/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

	<link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />

	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="index.html" class="navbar-brand"><span class="navbar-logo"></span></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Busca" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							<span class="label hide">5</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header">Notificação <span class="hide">(5)</span></li>
                            <li class="media">
                                <a href="javascript:;">
                                    <div class="media-left"><i class="fa fa-info media-object bg-red"></i></div>
                                    <div class="media-body">
                                        <h6 class="media-heading">Nenhuma existem notificações</h6>
                                        <div class="text-muted f-s-11">Verificado há 1 minuto atrás</div>
                                    </div>
                                </a>
                            </li>

                            <li class="hide dropdown-footer text-center">
                                <a href="javascript:;">View more</a>
                            </li>
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a style="padding: 6px 20px;" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<!--<img src="/assets/img/user-13.jpg" alt="" />-->
							<i style="background: #eee; padding: 12px; border-radius: 32px; font-size: 16px;" class="glyphicon glyphicon-user"></i>
							<span class="hidden-xs">{{ Auth::user()->name }}</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;">Editar Perfil</a></li>
							<li class="divider"></li>
							<li><a href="/auth/logout">Sair</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="info">
							Sistema <small>de Eventos</small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Menus</li>
					<li class="has-sub active">
						<a href="{{ route('admin.home') }}">
						    <i class="fa fa-laptop"></i>
						    <span>Home</span>
					    </a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<span class="badge pull-right">7</span>
							<i class="fa fa-calendar"></i> 
							<span>Eventos</span>
						</a>
						<ul class="sub-menu">
						    <li><a href="{{ route('evento.showAll') }}">Lista de Eventos</a></li>
						    <li><a href="{{ route('admin.evento') }}">Novo Evento</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="#">
							<b class="caret pull-right"></b>
							<span class="badge pull-right">189</span>
							<i class="fa fa-users"></i> 
							<span>Participantes</span>
						</a>
						<ul class="sub-menu">
						    <li><a href="{{ route('attendee.showAll') }}">Lista de Participantes</a></li>
						    <li><a href="{{ route('admin.participante') }}">Novo Participante</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="{{ route('admin.financeiro') }}">
							<i class="glyphicon glyphicon-usd"></i> 
							<span>Financeiro</span>
						</a>
					</li>

					<li class="has-sub">
						<a href="{{ route('admin.divulgacao') }}">
							<i class="glyphicon glyphicon-bullhorn"></i> 
							<span>Divulgação</span>
						</a>
					</li>

					<li class="has-sub">
						<a href="{{ route('admin.certificacao') }}">
							<i class="glyphicon glyphicon-education"></i> 
							<span>Certificação</span>
						</a>
					</li>
					
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="glyphicon glyphicon-cog"></i> 
							<span>Administração</span>
						</a>
						<ul class="sub-menu">
						    <li><a href="{{ route('admin.usuario') }}">Operadores</a></li>
						    <li><a href="{{ route('admin.usuario') }}">Perfis</a></li>
						    <li><a href="{{ route('admin.usuario') }}">Configuração</a></li>
						</ul>
					</li>

			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			@yield('content')
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>

	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN FORM WIZARD JS ================== -->
	<script src="/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="/assets/js/form-wizards-validation.js"></script>
	<script type="text/javascript" src="/assets/plugins/tinymce/tinymce.min.js"></script>
	<!-- ================== END FORM WIZARD JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="/assets/plugins/sparkline/jquery.sparkline.js"></script>
	
	<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

	@if (Route::current()->getName() == 'admin.evento')
	<script>
		var marker,map, infowindow;
		function initMap() {

			var cssID = '.gllpLatlonPicker';

			var lat = $(cssID).find('[name="gllpLatitude"]').val(),
				lng = $(cssID).find('[name="gllpLongitude"]').val(),
				zoom = $(cssID).find('[name="gllpZoom"]').val();

			lat = lat != '' ? lat : -19.9196218;
			lng = lng != '' ? lng : -43.9484353;
			zoom = parseInt(zoom) > 0 ? parseInt(zoom) : 12;

			var myLatLng = new google.maps.LatLng(lat,lng),
				myOptions = {
		            center: myLatLng,
		            mapTypeId: google.maps.MapTypeId.ROADMAP,
					zoom: zoom,
					scrollwheel: false,
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

			var input = document.getElementById('pac-input');
			var autocomplete = new google.maps.places.Autocomplete(input);

			autocomplete.bindTo('bounds', map);
			//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			marker.addListener('click', toggleBounce);

			autocomplete.addListener('place_changed', function() {
			    infowindow.close();
			    var place = autocomplete.getPlace();
			    if (!place.geometry) {
			      return;
			    }

			    if (place.geometry.viewport) {
			      map.fitBounds(place.geometry.viewport);
			    } else {
			      map.setCenter(place.geometry.location);
			      map.setZoom(17);
			    }

			    marker.setPosition(place.geometry.location);
			    setAddress(place.address_components,place.geometry.location);
			    /*infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
			        'Place ID: ' + place.place_id + '<br>' +
			        place.formatted_address);
			    infowindow.open(map, marker);*/
		  	});

			google.maps.event.addListener(marker,'dragend', function(event) {
				var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

				geocoder.geocode({'latLng': latlng}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK && results[1]) {
						setAddress(results[0].address_components,marker.position);
					}
				});
			});
		}

		function setAddress(address,position){
			var cssID = '.gllpLatlonPicker';

			$(cssID).find('[name="numero"],[name="complemento"],[name="bairro"],[name="uf"],[name="municipio"],[name="cep"]').val( '' );

			$(cssID).find('[name="gllpLatitude"]').val(position.lat());
			$(cssID).find('[name="gllpLongitude"]').val(position.lng());
			$(cssID).find('[name="gllpZoom"]').val(map.zoom);
			
			$.each(address,function(k, t){
				switch(t.types[0]){
					case 'route'://rua
						$(cssID).find('[name="logradouro"]').val( t.long_name  );
					break;
					case 'street_number':
						$(cssID).find('[name="numero"]').val( t.long_name );
					break;
					case 'sublocality_level_1'://bairro
						$(cssID).find('[name="bairro"]').val( t.long_name );
					break;
					case 'administrative_area_level_2'://municipio
						$(cssID).find('[name="municipio"]').val( t.long_name );
					break;
					case 'administrative_area_level_1':
						$(cssID).find('[name="uf"]').val( t.short_name );
					break;
					case 'postal_code'://cep
						$(cssID).find('[name="cep"]').val( t.long_name );
					break;
				}
			});
		}

		function toggleBounce() {
		  if (marker.getAnimation() !== null) {
		    marker.setAnimation(null);
		  } else {
		    marker.setAnimation(google.maps.Animation.BOUNCE);
		  }

		  infowindow.open(map, marker);
		}
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAsJG9VU0Mc4M_J3xFTrNzHx5Yt3gedl9I&libraries=places&callback=initMap"></script>
	@endif

	<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="/assets/plugins/dropzone/dropzone.js"></script>
	<script src="/assets/plugins/switchery/switchery.min.js"></script>
	<script src="/assets/js/form-slider-switcher.demo.min.js"></script>
	<script src="/assets/js/form.js"></script>

	<script src="/assets/js/dashboard.min.js"></script>

	<script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>

	<script src="/assets/js/custom.js"></script>
	<script src="/assets/js/configurar-perfil.js"></script>
	<script src="/assets/js/gerenciar-campos.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<link href="/js/jquery-bootgrid/jquery.bootgrid.css" rel="stylesheet" />
	<script src="/js/jquery-bootgrid/jquery.bootgrid.js"></script>
	<script src="/js/jquery-bootgrid/jquery.bootgrid.fa.js"></script>
	
	<script type="text/javascript">
		var PAGINAATUAL = '{{ Request::url() }}',
			ENDERECO = '{{ url() }}',
			URL = {
				Evento: {
					create: "{{ action('EventoController@create') }}"
				}
			},
			CSRFTOKEN = '{!! csrf_token() !!}';

		$(document).ready(function() {
			$.ajaxSetup({
			    headers:{
			        'X-CSRF-TOKEN':'{!! csrf_token() !!}'
			    }
			});
			//initialize aplication
			App.init();

			@if (Route::current()->getName() == 'evento.showAll')
			$(".bootgrid").bootgrid().on("loaded.rs.jquery.bootgrid", function (e) {
				$('.bootgrid tbody tr').each(function(){
					var /*$td = $(this).find('td[data-column-id="id"]'),
						slug = $(this).find('td[data-column-id="slug"]').text();*/
						$td = $(this).find('td').first().hide(),
						slug = $(this).find('td').last().hide().text(),
						$acoes = $(this).find('td').last().prev();

					if ($td.hasClass('no-results')) {
						return false;
					}
					var id = $td.text();
					//acessar
					$acoes.append(
						$('<a></a>')
							.attr({
								'href': ENDERECO + '/evento/' + slug,
								'target': '_blank'
							})
							.css({
								'margin-right': '10px'
							})
							.addClass('btn btn-default btn-sm')
							.html(
								$('<i></i>').addClass('glyphicon glyphicon-edit')
							).tooltip({
								'title': 'Acessar evento'
							})
					);
					//editar
					$acoes.find('td:visible:last').append(
						$('<a></a>')
							.attr({
								'href': ENDERECO + '/admin/evento/' + id
							})
							.css({
								'margin-right': '10px'
							})
							.addClass('btn btn-default btn-sm')
							.html(
								$('<i></i>').addClass('fa fa-cog')
							).tooltip({
								'title': 'Editar evento'
							})
					);
					//excluir
					$acoes.append(
						$('<a></a>')
							.attr({
								'href': ENDERECO + '/admin/evento/destroy/' + id
							})
							.addClass('btn btn-default btn-sm')
							.html(
									$('<i></i>').addClass('glyphicon glyphicon-trash')
							).tooltip({
								'title': 'Excluir evento'
							}).on('click', function(){
								if (!confirm('Tem certeza que deseja excluir o evento')) {
									return false;
								}
							})
					);
				});
			});
			@endif

			@if (Route::current()->getName() == 'admin.dashboard')
			Dashboard.init();
			@endif

			@if (Route::current()->getName() == 'admin.evento')
			FormWizardValidation.init();
			FormPlugins.init();
			FormSliderSwitcher.init();
			@endif
		});

		var Notificar = {
			sucesso: function(msg, tempo){
				$.gritter.add({
	                text: msg,
	                sticky: false,
	                time: 1000,
	                class_name: "gritter-light msg-success"
	            });
			},
			erro: function(msg){
				$.gritter.add({
	                text: msg,
	                sticky: false,
	                time: 1000,
	                class_name: "gritter-light msg-error"
	            });
			},
			informacao: function(msg,tempo){
				$.gritter.add({
	                text: msg,
	                sticky: false,
	                time: 1000,
	                class_name: "gritter-light msg-information"
	            });
			}
		}

		@if (count($errors) > 0)     
            @foreach ($errors->all() as $error)

            Notificar.erro('{{ $error }}');

            @endforeach
        @endif

        @if(Session::has('sucesso'))
            Notificar.sucesso('{!! Session::get("sucesso") !!}');
        @endif

        @if(Session::has('informacao'))
            Notificar.informacao('{!! Session::get("informacao") !!}');
        @endif

        @if(Session::has('erro'))
            Notificar.erro('{!! Session::get("erro") !!}');
        @endif
	</script>

	@if (Route::current()->getName() == 'attendee.showAll')
	{!! Html::script('js/attendee/show.all.js') !!}
	@endif

	@if (Route::current()->getName() == 'attendee.badgeModel' || Route::current()->getName() == 'attendee.badgeModelV2')
		{!! Html::script('js/attendee/badge.model.js') !!}
	@endif

	@if (Route::current()->getName() == 'attendee.credential')
		{!! Html::script('js/attendee/credential.all.js') !!}
	@endif
</body>
</html>
