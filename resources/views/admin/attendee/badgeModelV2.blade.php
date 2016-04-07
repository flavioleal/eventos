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
    <div class="col-md-4">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Listagem de campos</h4>
            </div>
            <div class="panel-body">
                <ul class="connectedSortable" id="sortable1">
                    @foreach ($campos as $campo)
                        <li><a class="btn btn-default">{{ $campo->campo }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
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
                <div class="front-badge">
                    <img class="logo-badge" src="{{ route('evento.fileShow', ['id' => $evento->logo_arquivo_id,'tipo' => 'logo','ext' => $evento->logo_extensao]) }}" />
                    <div class="content-badge">
                        <i class="fa fa-barcode"></i>
                    </div>
                </div>
                <div class="back-badge">
                    <div class="col-md-6">
                        <ul class="connectedSortable">
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="connectedSortable">
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <ul class="connectedSortable">
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #sortable1 {
        list-style: none;
    }
    #sortable1 li {
        margin-top:10px;
    }
    .back-badge ul.connectedSortable{
        background: #ddd;
        list-style: none;
        margin: 10px;
    }

    .back-badge ul.connectedSortable li {
        padding: 10px;
    }
    .front-badge img {
        display: block;
        margin: 15px auto;
    }
    .front-badge .content-badge {
        width: 100%;
        background: #fff;
    }
    .front-badge {
        background-color: {{ $evento->cor_predominante }};
    }

    .front-badge .fa-barcode{
        font-size: 100px;
        text-align: center;
        display: block;
        margin-top: 40px;
    }
    .front-badge {
        width: 100%;
        height: 300px;
        border: 1px solid #ddd;
    }

    .back-badge {
        margin-top: 15px;
        width: 100%;
        height: 300px;
        border: 1px solid #dddddd;
    }
</style>
@endsection