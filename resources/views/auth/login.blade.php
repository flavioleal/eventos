<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Compumake | Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

    <link rel="icon" type="image/png" href="/img/icon/favicon.ico">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

    <link href="/assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />

	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.min.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/orange.css" rel="stylesheet" id="theme" />

    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image"><img src="/assets/img/login-bg/bg-6.jpg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span>
                    <small>Sistema de Eventos</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form method="POST" action="/auth/login" class="margin-bottom-0" autocomplete="off">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                    <div class="form-group m-b-20">
                        <input  name="email" class="hide" />
                        <input type="email" name="email" autocomplete="off" class="form-control input-lg" placeholder="E-mail" value="{{ old('email') }}"/>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="password" autocomplete="off" class="form-control input-lg" placeholder="Senha" />
                    </div>
                    <div class="checkbox m-b-20">
                        <label>
                            <input type="checkbox" name="remember"/> Mantenha-me conectado
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Entrar</button>
                    </div>
                    <div class="m-t-20">
                        Esqueceu sua senha? Clique <a href="login_v2.html#">aqui</a>.
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
        
        <ul class="login-bg-list">
            <li class="active"><a href="#" data-click="change-bg"><img src="/assets/img/login-bg/bg-6.jpg" alt="" /></a></li>
        
            <li><a href="#" data-click="change-bg"><img src="/assets/img/login-bg/bg-1.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/assets/img/login-bg/bg-2.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/assets/img/login-bg/bg-3.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/assets/img/login-bg/bg-4.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/assets/img/login-bg/bg-5.jpg" alt="" /></a></li>
        </ul>
        
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
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/js/login-v2.demo.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>

    <script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	<script>

        @if (count($errors) > 0)     
            @foreach ($errors->all() as $error)

            $.gritter.add({
                text: "{{ $error }}",
                sticky: true,
                time: "",
                class_name: "gritter-light msg-error"
            });

            @endforeach
        @endif

        @if(Session::has('sucesso'))
            $.gritter.add({
                text: '{!! Session::get("sucesso") !!}',
                sticky: true,
                time: "",
                class_name: "gritter-light msg-success"
            });
        @endif

        @if(Session::has('informacao'))
            $.gritter.add({
                text: '{!! Session::get("informacao") !!}',
                sticky: true,
                time: "",
                class_name: "gritter-light msg-information"
            });
        @endif

        @if(Session::has('erro'))
            $.gritter.add({
                text: '{!! Session::get("erro") !!}',
                sticky: true,
                time: "",
                class_name: "gritter-light msg-error"
            });
        @endif

    </script>
</body>
</html>
