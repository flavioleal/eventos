@extends('app')
@section('content')


        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li><a href="#">Eventos</a></li>
    <li class="active">Listagem</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Lista de Eventos <small>Listagem de todos os eventos</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Listagem de Eventos</h4>
            </div>
            <div class="panel-body">
                <table id="grid-data-api" class="table table-condensed table-hover table-striped bootgrid"
                       data-ajax="true" data-url="{{ route('evento.showAll') }}">
                    <thead>
                    <tr>
                        <th data-column-visible="false" data-column-id="id">ID</th>
                        <th data-column-id="titulo">Título</th>
                        <th data-column-id="local">Local</th>
                        <th data-column-id="data_inicio" data-order="desc">Início</th>
                        <th data-column-id="data_fim" data-order="desc">Término</th>
                        <th data-column-id="participantes" data-order="desc">Participantes</th>
                        <th data-column-id="actions" data-order="desc">Ações</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection