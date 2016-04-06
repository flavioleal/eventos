@extends('app')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li><a href="#">Participantes</a></li>
    <li class="active">Modelo da Credencial</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Modelo de credencial <small>Criação de modelo para a credencial do evento</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Credencial</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="front-badge">
                            <div class="point point-left"></div>
                            <div class="point point-right"></div>
                            <div class="logo-badge">
                                <img
                                     src="{{ route('evento.fileShow', [
                                                'id' => $evento->logo_arquivo_id,
                                                'tipo' => 'logo',
                                                'ext' => $evento->logo_extensao
                                            ]) }}" />
                            </div>
                            <h3>{{ $evento->titulo }}</h3>
                            <div class="content-badge">
                                <div class="codigo-barra">
                                </div>
                                <img src="/img/compumake-logo.png"
                                     style="position:absolute;
                                            bottom: 10px;
                                            right: 10px;
                                            width: 80px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .point {
        width: 20px;
        height: 20px;
        border-radius: 20px;
        position: absolute;
        background-color: white;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, .2) inset;
        top: 20px;
    }
    .point-left {
        left: 60px;
    }
    .point-right {
        right: 60px;
    }

    .front-badge .codigo-barra {
        width: 160px;
        height: 30px;
        overflow: hidden;
        margin: auto;
        background: url('/img/codigo-barras.png');
        background-position: center -6px;
        background-repeat: no-repeat;
        background-size: 160px;
        position: absolute;
        bottom: 20px;
        left: 50%;
        margin-left: -80px;
    }

    .front-badge .logo-badge {
        width: 200px;
        height: 200px;
        border-radius: 200px;
        display: block;
        background: #fff;
        content: "fdasf";
        position: absolute;
        top: 80px;
        left: 50%;
        margin-left: -100px;
    }
    .front-badge .logo-badge img {
        display: block;
        margin: 60px auto;
        width: 160px;
    }
    .front-badge h3 {
        color: {{ $evento->cor_fundo }};
        text-align: center;
        position: relative;
        top: 300px;
    }
    .front-badge .content-badge {
        width: 100%;
        height: 140px;
        background: #fff;
        position: absolute;
        bottom: 40px;
    }
    .front-badge {
        background-image: url('/img/texturas/textura-3.png');
        background-color: {{ $evento->cor_predominante }};
        border-radius: 10px;
        position: relative;
    }

    .front-badge .fa-barcode{
        font-size: 100px;
        text-align: center;
        display: block;
        margin-top: 40px;
    }
    .front-badge {
        width: 100%;
        height: 550px;
        border: 1px solid #ddd;
    }
</style>
@endsection