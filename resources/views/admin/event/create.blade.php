@extends('app')
@section('content')
{!! Html::style('/admin/event/create.css') !!}
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="#">Home</a></li>
    <li><a href="#">Eventos</a></li>
    <li class="active">Novo</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Eventos <small>Crie e personalize novos eventos</small></h1>
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
                <h4 class="panel-title">Edição de Eventos</h4>
            </div>
            <div class="panel-body">

                <div id="wizard">
                    <ol>
                        <li>
                            Detalhes do Evento
                            <small>Informe os principais dados, localização e a data do seu evento</small>
                        </li>
                        <li>
                            Perfis
                            <small>Selecione os perfis oferecido pelo evento</small>
                        </li>
                        <li>
                            Design
                            <small>Personalize a interface da página do evento</small>
                        </li>
                    </ol>
                    <!-- begin wizard step-1 -->
                    <div class="wizard-step-1">
                        @include('admin.event.create.main')
                    </div>
                    <!-- end wizard step-1 -->
                    <!-- begin wizard step-2 -->
                    <div class="wizard-step-2">
                        @include('admin.event.create.profiles')
                    </div>
                    <!-- end wizard step-2 -->
                    <!-- begin wizard step-3 -->
                    <div class="wizard-step-3">
                        @include('admin.event.create.design')
                    </div>
                    <!-- end wizard step-3 -->
                    <!-- begin wizard step-4 -->
                    <div>
                        <div class="jumbotron m-b-0 text-center">
                            <h1>Concluído!</h1>
                            <p>Parabéns! Um novo evento foi criado com sucesso.<br> Click no link abaixo para visualizá-lo na sua página de inscrição. </p>
                            <p><a class="btn-acessar-evento btn btn-success btn-lg" target="_blank"
                                  @if (isset($form['slug']))
                                  href="{{ route('site.evento', ['slug' => $form['slug']]) }}"
                                        @endif
                                >Acessar evento</a></p>
                        </div>
                    </div>
                    <!-- end wizard step-4 -->
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-success"
                       id="btn-reload-preview"
                       onclick="var iframe = document.getElementById('preview-event'); iframe.src = iframe.src;"
                       data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Edição de Eventos</h4>
            </div>
            <div class="panel-body">
                <iframe id="preview-event" style="border: 0; width:100%; min-height: 400px;"
                        src="{{ route('site.evento', ['slug' => $form['slug']]) }}"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection