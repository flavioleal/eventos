@extends('app')

@section('content')

        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<div class="row">
    <div class="col-md-2">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <div class="col-md-6">
        <select class="form-control">
            @foreach($eventos as $e)
            <option value="{{ $e->id }}">{{ $e->titulo }}</option>
            @endforeach
        </select>
    </div>
</div>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-desktop"></i></div>
            <div class="stats-info">
                <h4>TOTAL DE PARTICIPANTES</h4>
                <p>922</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon"><i class="fa fa-chain-broken"></i></div>
            <div class="stats-info">
                <h4>INSCRIÇÕES PAGAS</h4>
                <p>579</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-red">
            <div class="stats-icon"><i class="fa fa-clock-o"></i></div>
            <div class="stats-info">
                <h4>ÚLTIMA INSCRIÇÃO</h4>
                <p>18:12:23</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
    <!-- begin col-3 -->
    <div class="col-md-3 col-sm-6">
        <div class="widget widget-stats bg-purple">
            <div class="stats-icon"><i class="fa fa-users"></i></div>
            <div class="stats-info">
                <h4>CERTIFICADOS EMITIDOS</h4>
                <p>81</p>
            </div>
            <div class="stats-link">
                <a href="javascript:;">Ver detalhes <i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->
</div>
<!-- end row -->
<!-- begin row -->
<div class="row">
    <!-- begin col-8 -->
    <div class="col-md-8">
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Acompanhamento das inscrições (Últimos 7 dias)</h4>
            </div>
            <div class="panel-body">
                <div id="interactive-chart" class="height-sm"></div>
            </div>
        </div>
    </div>
    <!-- end col-8 -->
    <!-- begin col-4 -->
    <div class="col-md-4">
        <div class="panel panel-inverse" data-sortable-id="index-6">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Estátisticas</h4>
            </div>
            <div class="panel-body p-t-0">
                <table class="table table-valign-middle m-b-0">
                    <thead>
                    <tr>
                        <th>Source</th>
                        <th>Total</th>
                        <th>Trend</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><label class="label label-danger">Total de participantes</label></td>
                        <td>922 <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
                        <td><div id="sparkline-unique-visitor"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-warning">Inscrições pagas</label></td>
                        <td>579</td>
                        <td><div id="sparkline-bounce-rate"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-success">Total de acessos</label></td>
                        <td>3.030</td>
                        <td><div id="sparkline-total-page-views"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-primary">Tempo médio de inscrição</label></td>
                        <td>00:03:45</td>
                        <td><div id="sparkline-avg-time-on-site"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-default">% Novas inscrições</label></td>
                        <td>40.5%</td>
                        <td><div id="sparkline-new-visits"></div></td>
                    </tr>
                    <tr>
                        <td><label class="label label-inverse">Retorno de participantes</label></td>
                        <td>73.4%</td>
                        <td><div id="sparkline-return-visitors"></div></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-inverse" data-sortable-id="index-7">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Perfil dos participantes</h4>
            </div>
            <div class="panel-body">
                <div id="donut-chart" class="height-sm"></div>
            </div>
        </div>

        <div class="panel panel-inverse" data-sortable-id="index-10">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Calendário</h4>
            </div>
            <div class="panel-body">
                <div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
            </div>
        </div>
    </div>
    <!-- end col-4 -->
</div>
<!-- end row -->
@endsection