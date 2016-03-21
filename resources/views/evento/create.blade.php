@extends('app')

@section('content')

<style type="text/css" scoped>
    .gllpMap    { width: 100%; height: 270px; }

    .hero-widget { text-align: center; padding-top: 20px; padding-bottom: 20px; }
    .hero-widget .icon { display: block; font-size: 96px; line-height: 96px; margin-bottom: 10px; text-align: center; }
    .hero-widget var { display: block; height: 64px; font-size: 64px; line-height: 64px; font-style: normal; }
    .hero-widget label { font-size: 17px; }
    .hero-widget .options { margin-top: 10px; }
    .hero-widget.well{
        margin: 0 0 20px 0 !important;
        background-color: #f5f5f5 !important;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05) !important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.05) !important;
    }
    .hero-width .btn-lg{
        padding:10px;
    }

    th.move-line{
        width:42px;
    }
    td.move-line{
        cursor:move;
    }

    .modal .modal-header{
        border-bottom-color: transparent;
    }

    .modal .modal-footer,.modal .modal-header h4{
        display: none;
    }

    .modal .modal-dialog{
        overflow: hidden;
    }
    .modal .modal-body .modal-in{
        width: 80% !important;
        margin: auto !important;
        position: relative !important;
    }

    @media (min-width:992px){
        .modal .modal-dialog{
            width:60%;
        }
    }

    /*.modal,.modal-dialog,.modal-body{
        -webkit-transition: all 1s ease-in-out;
        -moz-transition: all 1s ease-in-out;
        -o-transition: all 1s ease-in-out;
        transition: all 1s ease-in-out;
    }*/

    button.close {
        font-weight: 100;
        font-size: 30px;
        position: relative;
        z-index: 1;
        outline: none;
    }

    #modal-perguntas .modal-body,
    #modal-perfil .modal-body{
        padding-bottom:40px;

    }
    form#perfil-principal,
    #perfil-pagamento,
    fieldset#adicionar-pergunta,
    fieldset#adicionar-condicao,
    fieldset#listagem-perguntas,
    fieldset#selecionar-perguntas{
        width: 100%;
        position:absolute;
    }

    .btn-modal-in,.btn-modal-out{
        margin-top: -110px;
    }

    .ui-sortable-helper {
        display: table;
    }

    .input-group.bootstrap-timepicker,.btn-inline{
        margin-top:22px;
    }

    table.grid-perfil th.grid-acoes{
        width: 145px;
    }

    table.grid-perguntas th.grid-acoes{
        width: 104px;
    }

    table.grid-perguntas-alternativas th.grid-acoes,
    table.grid-perguntas-condicoes th.grid-acoes,
    table.grid-perguntas-definidas th.grid-acoes,
    table.grid-perguntas th.grid-perfil-desconto{
        width: 65px;
    }

    .dropzone,.dropzone.dz-drag-hover{
        position: relative;
        border: none;
        padding: 0;
    }

    .dropzone:not(.dz-max-files-reached):after{
        border: 2px dashed #dedede;
        border-radius: 4px;
        margin: 15px;
        padding: 70px 0;
        content: attr(data-text);
        text-transform: uppercase;
        text-align: center;
        color: #00a1ee;
        font-size: 20px;
        position: relative;
        background: #fff;
        display: block;
        top: -15px;
        height: 170px;
        visibility: visible;
    }

    .dropzone:not(.dz-max-files-reached):not(.dz-drag-hover):hover:after{
        border-color: #00a1ee;
    }

    .dropzone:not(.dz-max-files-reached):before{
        font-size: 14px;
        color: #999;
        content: attr(data-msg);
        border: 1px solid #dedede;
        border-radius: 4px;
        width: 100%;
        height: 200px;
        padding: 120px 40px 0 40px;
        display: block;
        position: absolute;
        text-align: center;
        visibility: visible;
        bottom: 0px;
        z-index: 1;
    }


    .dropzone.dz-drag-hover:after{
        border-color:#fff;
        color:#fff;
        content: "Solte o arquivo aqui";
        z-index: 1;
        background-color: transparent;
    }

    .dropzone.dz-drag-hover:before{
        content: "";
        background-color: #00a1ee;
    }
    
    .dropzone.dz-drag-hover:hover:before{
        background-color:#337AB7;
    }

    .dropzone [type="file"]{
        display: none;
    }

    .dropzone .dz-preview .dz-remove:before,.dropzone .dz-default:before{
        text-align: center;
        width: 100%;
        left: 0;
        position: absolute;
        z-index: 1;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        font-size: 40px;
    }

    .dropzone:not(.dz-drag-hover) .dz-default:before{
        content: "\e046";
        color: #00a1ee;
    }

    .dropzone-logo:not(.dz-drag-hover) .dz-default:before{
        content: "\e046";
        color: #00a1ee;
    }

    .dropzone.dz-drag-hover .dz-default{
        position: relative;
        z-index: 1;
        opacity: 1;
    }
    .dropzone.dz-drag-hover .dz-default:before{
        content: "\e025";
        color:#fff;
    }

    .dz-preview .dz-image{
        width:auto !important;
    }
    .dz-preview .dz-image img{
        max-width: 100%;
        height: auto;
    }

    .dropzone .dz-preview{
        margin:0 0 15px 0;
    }

    .dropzone .dz-preview .dz-image{
        border-radius:0;
    }

    input[type="color"]{
        border:none;
        padding:0;
    }

    /*.dz-max-files-reached {
        pointer-events: none;
        cursor: default;
    }*/

    .dropzone .dz-preview .dz-remove{
        display: inline;
        float:right;
    }

    .dropzone .dz-preview .dz-remove:active,
    .dropzone .dz-preview .dz-remove:hover,
    .dropzone .dz-preview .dz-remove:visited,
    .dropzone .dz-preview .dz-remove:focus{
        text-decoration: none;
    }

    .dropzone > .dz-preview > .dz-remove:before {
        content: "\e020";
        font-size: 14px;
        width: auto;
        position: relative;
        margin: 5px;
    }

    .input-group-addon .fa{
        font-size:20px;
    }
</style>
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
                        <form class="form-xhr" id="form-evento" action="{{ route('evento.store') }}" method="POST" data-parsley-validate="true" name="form-wizard">
                            <input name="id" value="{{ array_key_exists('id',$form) ? $form['id'] : ''}}" type="hidden">
                            <!-- begin row -->
                            <div class="row">
                                <fieldset class="col-md-12">
                                    <legend class="pull-left width-full">Detalhes</legend>
                                    <div class="row">
                                        <div class="form-group block1 col-md-12">
                                            <label>Título do Evento</label>
                                            <input value="{{ array_key_exists('titulo',$form) ? $form['titulo'] : '' }}" type="text" name="titulo" placeholder="Atribua um nome curto que chame a atenção" class="form-control" data-parsley-group="wizard-step-1" required />
                                        </div>
                                        <div class="form-group block1 col-md-6">
                                            <label>Tipo</label>
                                            <select name="evento_tipo_id" class="form-control" data-value="{{ array_key_exists('evento_tipo_id',$form) ? $form['evento_tipo_id'] : '' }}">
                                                <option value="" selected="selected">Selecionar o tipo de evento</option>
                                                <option value="18">Acampamento, Viagem ou Retiro</option>
                                                <option value="17">Atração</option>
                                                <option value="9">Aula, Treinamento ou Workshop</option>
                                                <option value="19">Autógrafos ou Meet &amp; Greet</option>
                                                <option value="12">Comício ou Manifestação</option>
                                                <option value="6">Concerto ou Show</option>
                                                <option value="1">Conferência</option>
                                                <option value="4">Convenção</option>
                                                <option value="15">Corrida ou Prova de resistência</option>
                                                <option value="3">Feira Profissional ou Exposição</option>
                                                <option value="11">Festa ou Evento social</option>
                                                <option value="5">Festival ou Feira</option>
                                                <option value="8">Jantar ou Gala</option>
                                                <option value="14">Jogo ou Competição</option>
                                                <option value="100">Outro</option>
                                                <option value="7">Projeção de Filmes e Premiere</option>
                                                <option value="10">Reunião ou Evento de Networking</option>
                                                <option value="2">Seminário ou Palestra</option>
                                                <option value="13">Torneio</option>
                                                <option value="16">Visita Guiada</option>
                                            </select>
                                        </div>

                                        <div class="form-group block1 col-md-6">
                                            <label>Categoria</label>
                                            <select name="evento_categoria_id" class="form-control" data-value="{{ array_key_exists('evento_categoria_id',$form) ? $form['evento_categoria_id'] : '' }}">
                                                <option value="" selected="selected">Selecionar a categoria do evento</option>
                                                <option value="105">Artes Dramáticas e Visuais</option>
                                                <option value="118">Auto, Náutica e Aéreo</option>
                                                <option value="117">Casa e Estilo de Vida</option>
                                                <option value="111">Causas e Filantrópicos</option>
                                                <option value="102">Ciência e Tecnologia</option>
                                                <option value="110">Comida e Bebida</option>
                                                <option value="113">Comunidade e Cultura</option>
                                                <option value="108">Esportes e Fitness</option>
                                                <option value="115">Família e Educação</option>
                                                <option value="116">Feriados e Festas Tradicionais</option>
                                                <option value="104">Filmes, Mídia e Entretenimento</option>
                                                <option value="112">Governo e Política</option>
                                                <option value="119">Hobbies e Interesses especiais</option>
                                                <option value="106">Moda e Beleza</option>
                                                <option value="103">Música</option>
                                                <option value="101">Negócios e Profissional</option>
                                                <option value="199">Outro</option>
                                                <option value="114">Religião e Espiritualidade</option>
                                                <option value="107">Saúde e Bem-estar</option>
                                                <option value="109">Viagens e Outdoor</option>
                                            </select>
                                        </div>

                                        <div class="form-group block1 col-md-12">
                                            <label>Descrição</label>
                                            <textarea name="descricao" class="wysiwyg form-control wys">
                                                {{ array_key_exists('descricao',$form) ? $form['descricao'] : '' }}
                                            </textarea>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="col-md-12">
                                    <legend class="pull-left width-full">Organizador</legend>
                                    <div class="form-group block1">
                                        <label>Nome</label>
                                        <input value="{{ array_key_exists('organizador_nome',$form) ? $form['organizador_nome'] : '' }}" type="text" name="organizador_nome" placeholder="Quem está organizando este evento?" class="form-control" data-parsley-group="wizard-step-1" />
                                    </div>

                                    <div class="form-group block1">
                                        <label>Descrição</label>
                                        <textarea name="organizador_descricao" class="form-control wys">{{ array_key_exists('organizador_descricao',$form) ? $form['organizador_descricao'] : '' }}</textarea>
                                    </div>
                                </fieldset>

                                <fieldset class="col-md-12">
                                    <legend>Período</legend>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <label>Dia Inteiro</label>
                                                <select name="dia_inteiro" class="form-control" data-value="{{ array_key_exists('dia_inteiro',$form) ? $form['dia_inteiro'] : '' }}">
                                                    <option value="1">Sim</option>
                                                    <option value="0">Não</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Início</label>
                                                <div class="input-group date">
                                                    <input value="{{ array_key_exists('data_inicio',$form) ? $form['data_inicio'][0] : '' }}" name="data_inicio[0]" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group bootstrap-timepicker">
                                                    <input value="{{ array_key_exists('data_inicio',$form) ? $form['data_inicio'][1] : ''}}" name="data_inicio[1]" type="text" class="form-control" />
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Término</label>

                                                <div class="input-group date">
                                                    <input value="{{ array_key_exists('data_fim',$form) ? $form['data_fim'][0] : '' }}" name="data_fim[0]" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group bootstrap-timepicker">
                                                    <input value="{{ array_key_exists('data_fim',$form) ? $form['data_fim'][1] : '' }}" name="data_fim[1]" type="text" class="form-control" />
                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="row">
                                <fieldset  class="col-md-12 gllpLatlonPicker">
                                    <legend>Localização</legend>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Endereço</label>
                                                <div class="input-group">
                                                    <input type="text" name="endereco" placeholder="Avenida Augusto de Lima, 785 – Lourdes – Belo Horizonte – Minas Gerais" class="form-control gllpSearchField" id="pac-input" data-parsley-group="wizard-step-1" />
                                                    <div class="input-group-addon gllpSearchButton">
                                                        <i class="glyphicon glyphicon-map-marker"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="gllpMap" id="map">Google Maps</div>
                                                <input type="hidden" name="gllpLatitude" class="gllpLatitude" value="{{ array_key_exists('gllpLatitude',$form) ? $form['gllpLatitude'] : -19.9196218 }}"/>
                                                <input type="hidden" name="gllpLongitude" class="gllpLongitude" value="{{ array_key_exists('gllpLongitude',$form) ? $form['gllpLongitude'] : -43.9484353 }}"/>
                                                <input type="hidden" name="gllpZoom" class="gllpZoom" value="{{ array_key_exists('gllpZoom',$form) ? $form['gllpZoom'] : 12 }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Local</label>
                                                        <input type="text" class="form-control" name="local" value="{{ array_key_exists('local',$form) ? $form['local'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>CEP</label>
                                                        <input type="text" class="form-control" name="cep" value="{{ array_key_exists('cep',$form) ? $form['cep'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Logradouro</label>
                                                        <input type="text" class="form-control" name="logradouro" value="{{ array_key_exists('logradouro',$form) ? $form['logradouro'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Número</label>
                                                        <input type="text" class="form-control" name="numero" value="{{ array_key_exists('numero',$form) ? $form['numero'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Complemento</label>
                                                        <input type="text" class="form-control" name="complemento" value="{{ array_key_exists('complemento',$form) ? $form['complemento'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bairro</label>
                                                        <input type="text" class="form-control" name="bairro" value="{{ array_key_exists('bairro',$form) ? $form['bairro'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Município</label>
                                                        <input type="text" class="form-control" name="municipio" value="{{ array_key_exists('municipio',$form) ? $form['municipio'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>UF</label>
                                                        <input type="text" class="form-control" name="uf" value="{{ array_key_exists('uf',$form) ? $form['uf'] : '' }}">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                    <!-- end wizard step-1 -->
                    <!-- begin wizard step-2 -->
                    <div class="wizard-step-2">
                        <fieldset>
                            <legend class="pull-left width-full">Perfis Pré-definidos</legend>
                            <!-- begin row -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="hero-widget well well-sm">
                                        <div class="icon">
                                             <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="text">
                                            <label class="text-muted">Novo Perfil</label>
                                        </div>
                                        <div class="options">
                                            <a href="#" class="btn btn-primary btn-lg" data-target="#modal-perfil"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="hero-widget well well-sm">
                                        <div class="icon">
                                             <i class="fa fa-graduation-cap"></i>
                                        </div>
                                        <div class="text">
                                            <label class="text-muted">Estudante</label>
                                        </div>
                                        <div class="options">
                                            <a href="#" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i> Selecionar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="hero-widget well well-sm">
                                        <div class="icon">
                                             <i class="fa fa-briefcase"></i>
                                        </div>
                                        <div class="text">
                                            <label class="text-muted">Profissional</label>
                                        </div>
                                        <div class="options">
                                            <a href="#" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i> Selecionar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="hero-widget well well-sm">
                                        <div class="icon">
                                             <i class="fa fa-building-o"></i>
                                        </div>
                                        <div class="text">
                                            <label class="text-muted">Empresa</label>
                                        </div>
                                        <div class="options">
                                            <a href="#" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i> Selecionar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Perfis Selecionados</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover grid-table grid-perfil grid-evento-perfis">
                                            <thead>
                                                <tr>
                                                    <th>Perfil</th>
                                                    <th>Quantidade</th>
                                                    <th>Preço</th>
                                                    <th>Ativo</th>
                                                    <th class="grid-acoes">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($evento_perfil as $perfil)
                                                <tr data-id="{{ $perfil['id'] }}">
                                                    <td class="grid-campo-titulo">{{ $perfil['titulo'] }}</td>
                                                    <td class="grid-campo-quantidade">{{ $perfil['quantidade'] }}</td>
                                                    <td class="grid-campo-valor">R$ {{ $perfil['valor'] }}</td>
                                                    <td class="grid-campo-ativo">@if($perfil['ativo'] == 1) Sim @else Não @endif</td>
                                                    <td class="grid-acao">
                                                        <a href="#Configurar-Perfil" class="btn btn-default fa fa-cog" data-toggle="tooltip" data-placement="top" title="Configurar Perfil"></a>
                                                        <a href="#Gerenciar-Campos" data-target="#modal-perguntas" class="btn btn-default fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Gerenciar Campos"></a>
                                                        <a href="#Remover-Perfil" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="{{ url() }}/admin/evento/perfil-destroy/{{ $perfil['id'] }}" data-toggle="tooltip" data-placement="top" title="Remover Perfil"></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end col-6 -->
                            </div>
                            <!-- end row -->
                        </fieldset>
                    </div>
                    <!-- end wizard step-2 -->
                    <!-- begin wizard step-3 -->
                    <div class="wizard-step-3">
                        <fieldset>
                            <legend class="width-full">Design</legend>
                            <!-- begin row -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div    data-url="{{ array_key_exists('logo_arquivo_id', $form) && !empty($form['logo_arquivo_id']) ? route('evento.fileShow', ['tipo' => 'logo','ext' => $form['logo_extensao'],'id' => $form['logo_arquivo_id']]) : '' }}"
                                            data-mime="{{ array_key_exists('logo_mime', $form) ? $form['logo_mime'] : '' }}"
                                            data-size="{{ array_key_exists('logo_size', $form) ? $form['logo_size'] : '' }}" 
                                            data-name="{{ array_key_exists('logo_name', $form) ? $form['logo_name'] : '' }}"
                                            data-id="{{ array_key_exists('logo_arquivo_id', $form) ? $form['logo_arquivo_id'] : '' }}"
                                            class="form-group dropzone dropzone-logo" data-dropzone="logo" data-text='logo' data-msg='Escolha a logo do organizador.'>
                                        <input type="file" name="logo"/>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div    data-url="{{ array_key_exists('banner_arquivo_id', $form) && !empty($form['banner_arquivo_id']) ? route('evento.fileShow', ['tipo' => 'banner','ext' => $form['banner_extensao'],'id' => $form['banner_arquivo_id']]) : '' }}"
                                            data-mime="{{ array_key_exists('banner_mime', $form) ? $form['banner_mime'] : '' }}"
                                            data-size="{{ array_key_exists('banner_size', $form) ? $form['banner_size'] : '' }}" 
                                            data-name="{{ array_key_exists('banner_name', $form) ? $form['banner_name'] : '' }}"
                                            data-id="{{ array_key_exists('banner_arquivo_id', $form) ? $form['banner_arquivo_id'] : '' }}"
                                            class="form-group dropzone dropzone-banner" data-dropzone="banner" data-text='adicione uma imagem para o banner' data-msg='Escolha uma imagem que captura perfeitamente a ideia do seu evento.'>
                                        <input type="file" name="banner"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div    data-url="{{ array_key_exists('background_arquivo_id', $form) && !empty($form['background_arquivo_id']) ? route('evento.fileShow', ['tipo' => 'background','ext' => $form['bg_extensao'],'id' => $form['background_arquivo_id']]) : '' }}"
                                            data-mime="{{ array_key_exists('bg_mime', $form) ? $form['bg_mime'] : '' }}"
                                            data-size="{{ array_key_exists('bg_size', $form) ? $form['bg_size'] : '' }}" 
                                            data-name="{{ array_key_exists('bg_name', $form) ? $form['bg_name'] : '' }}"
                                            data-id="{{ array_key_exists('background_arquivo_id', $form) ? $form['background_arquivo_id'] : '' }}"
                                            class="form-group dropzone dropzone-background" data-dropzone="background" data-text='adicione uma imagem de fundo' data-msg='Escolha uma imagem para exibir no fundo da página.'>
                                        <input type="file" name="background"/>
                                    </div>
                                </div>

                                <form id="form-evento-design" action="{{ route('evento.designStore') }}" class="form-xhr" id="form-design" method="post" enctype="multipart/form-data" data-parsley-validate="true">
                                    <input name="id" value="{{ array_key_exists('id',$form) ? $form['id'] : ''}}" type="hidden">
                                    <div class="col-md-4">
                                        <div class="form-group block1">
                                            <label>Cor dos textos</label>
                                            <input  type="color" name="cor_texto" class="form-control"
                                                    value="{{ array_key_exists('cor_texto',$form) && !empty($form['cor_texto'])  ? $form['cor_texto'] : '#666666' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group block1">
                                            <label>Cor predominante</label>
                                            <input  type="color" name="cor_predominante" class="form-control"
                                                    value="{{ array_key_exists('cor_predominante',$form) && !empty($form['cor_predominante'])  ? $form['cor_predominante'] : '#ff9300' }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group block1">
                                            <label>Cor de fundo</label>
                                            <input  type="color" name="cor_fundo" class="form-control"
                                                    value="{{ array_key_exists('cor_fundo',$form) && !empty($form['cor_fundo'])  ? $form['cor_fundo'] : '#005493' }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group block1">
                                            <label>Facebook</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-facebook"></i>
                                                </div>
                                                <input  type="text" name="facebook" class="form-control"
                                                        value="{{ array_key_exists('facebook',$form) && !empty($form['facebook']) ? $form['facebook'] : '' }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group block1">
                                            <label>Twitter</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-twitter"></i>
                                                </div>
                                                <input  type="text" name="twitter" class="form-control" 
                                                        value="{{ array_key_exists('twitter',$form) && !empty($form['twitter']) ? $form['twitter'] : '' }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group block1">
                                            <label>Youtube</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-youtube"></i>
                                                </div>
                                                <input type="text" name="youtube" class="form-control"  value="{{ array_key_exists('youtube',$form) ? $form['youtube'] : '' }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-default pull-right">
                                            <i class="fa fa-file-text"></i> Pré-Visualizar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end row -->
                        </fieldset>
                    </div>
                    <!-- end wizard step-3 -->
                    <!-- begin wizard step-4 -->
                    <div>
                        <div class="jumbotron m-b-0 text-center">
                            <h1>Concluído!</h1>
                            <p>Parabéns! Um novo evento foi criado com sucesso.<br> Click no link abaixo para visualizá-lo na sua página de inscrição. </p>
                            <p><a class="btn btn-success btn-lg" role="button">Acessar evento</a></p>
                        </div>
                    </div>
                    <!-- end wizard step-4 -->
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->

<!-- Modal -->
<div class="modal fade" id="modal-perfil" tabindex="-1" role="dialog" aria-labelledby="modal-perfilLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-perfilLabel">Perfil</h4>
            </div>
            <div class="modal-body">
                <form id="perfil-principal" class="modal-in form-xhr" action="{{ route('evento.perfil_store') }}" method="POST">
                    <input name="id" type="hidden" value=""/>
                    <fieldset>
                        <legend>Dados do Perfil</legend>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="perfil-titulo">Título</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                    <input type="text" name="titulo" class="form-control" id="perfil-titulo" placeholder="Informe um título para o perfil do evento" required>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="perfil-descricao">Descrição</label>
                                <textarea name="descricao" class="form-control" id="perfil-descricao" placeholder="Descreva um breve resumo sobre o perfil"></textarea>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Definir período</label>
                                <select name="periodo" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Início</label>
                                <div class="input-group date">
                                    <input name="data_inicio" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Término</label>
                                <div class="input-group date">
                                    <input name="data_fim" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Restrito</label>
                                <select name="restrito" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Habilitar Captcha</label>
                                <select name="captcha" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Ativo</label>
                                <select name="ativo" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Participantes</legend>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Limite de participantes</label>
                                <select name="limite_participantes" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="perfil-quantidade">Quantidade</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-list-alt"></i>
                                    </div>
                                    <input name="quantidade" type="text" class="form-control" id="perfil-quantidade" placeholder="">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Pagamento</legend>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Exigir pagamento</label>
                                <select name="exigir_pagamento" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="perfil-valor">Valor</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        R$
                                    </div>
                                    <input name="valor" type="text" class="form-control" id="perfil-valor" placeholder="00,00">
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <button class="pull-right btn btn-default btn-inline btn-modal-in" data-in="#perfil-pagamento" data-out="#perfil-principal">
                                    <i class="fa fa-ticket"> Definir Descontos</i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <hr>
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <button class="btn btn-primary" type="submit">
                                <i class="glyphicon glyphicon-floppy-save"></i> Salvar Perfil</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="perfil-pagamento">
                    <form class="form-xhr" id="perfil-cupom-descontos" action="{{ route('evento.perfil_desconto_store') }}" method="POST">
                        <fieldset class="perfil-promocional">
                            <legend>Código Promocional</legend>
                            <div class="row">
                                <div class="col-xs-12  btn-first">
                                    <div class="pull-right">
                                        <button class="btn btn-default btn-modal-out" type="button" data-in="#perfil-principal" data-out="#perfil-pagamento">
                                        <i class="fa fa-chevron-left"></i> Voltar</button>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="">Desconto</label>
                                    <div class="input-group">
                                        <input name="valor" type="text" class="form-control" id="" placeholder="00,00">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">R$ <span class="caret"></span></button>
                                            <input name="valor_tipo" type="hidden">
                                            <ul class="dropdown-menu-btn dropdown-menu dropdown-menu-right">
                                                <li class="active"><a href="#">R$</a></li>
                                                <li><a href="#">%</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Início</label>
                                    <div class="input-group date">
                                        <input name="data_inicio" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label>Término</label>
                                    <div class="input-group date">
                                        <input name="data_fim" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-1">
                                    <button type="submit" class="pull-right btn btn-primary btn-inline" data-toggle="tooltip" data-placement="top" title="Adicionar Desconto">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover grid-table grid-perfil-desconto">
                                            <thead>
                                                <tr>
                                                    <th>Cupom de Desconto</th>
                                                    <th>Valor</th>
                                                    <th>Início</th>
                                                    <th>Término</th>
                                                    <th class="grid-acoes">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <form id="perfil-descontos" class="form-xhr" action="{{ route('evento.perfil_grupos_store') }}" method="POST">
                        <fieldset class="perfil-descontos">
                            <legend>Descontos</legend>
                            <div class="row">
                                
                                <div class="form-group col-sm-4">
                                    <label for="perfil-valor-antecipado">Valor Antecipado</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            R$
                                        </div>
                                        <input name="antecipado_valor" type="text" class="form-control" id="perfil-valor-antecipado" placeholder="00,00">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>De</label>
                                    <div class="input-group date">
                                        <input name="antecipado_inicio" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label>Até</label>
                                    <div class="input-group date">
                                        <input name="antecipado_fim" type="text" class="form-control datepicker-default" placeholder="DD/MM/AAAA" data-parsley-group="wizard-step-1"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label>Desconto para Grupos</label>
                                    <select name="desconto_grupos" class="form-control">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label>Indique o desconto</label>
                                    <div class="input-group">
                                        <input name="desconto_grupo_valor" type="text" class="form-control" id="" placeholder="">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">R$ <span class="caret"></span></button>
                                            <input name="desconto_grupo_tipo" type="hidden">
                                            <ul class="dropdown-menu-btn dropdown-menu dropdown-menu-right">
                                                <li class="active"><a href="#">R$</a></li>
                                                <li><a href="#">%</a></li>
                                            </ul>
                                        </div><!-- /btn-group -->
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label>Quantidade Mínima</label>
                                    <input name="desconto_grupo_min" type="text" class="form-control" id="" placeholder="">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="perfil-desconto-grupo-desc">Descrição para os grupos</label>
                                    <textarea name="desconto_grupo_descricao" class="form-control" id="perfil-desconto-grupo-desc" placeholder="Informe a regra para a inscrição em grupo"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <hr>
                                <div class="col-xs-12">
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="submit">
                                        <i class="glyphicon glyphicon-floppy-save"></i> Salvar Desconto</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-save"></i> Salvar
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-perguntas" tabindex="-1" role="dialog" aria-labelledby="modal-perguntasLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-perguntasLabel">Gerenciador de Campos</h4>
            </div>
            <div class="modal-body">
                <fieldset id="listagem-perguntas" class="modal-in">
                    <legend>Listagem de Campos</legend>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <button data-in="#adicionar-pergunta" data-out="#listagem-perguntas" class="btn-add-pergunta btn-modal-in btn btn-sm btn-default" type="button">
                                    <i class="glyphicon glyphicon-plus"></i> Adicionar Campo
                                </button>

                                <button data-in="#selecionar-perguntas" data-out="#listagem-perguntas" class="btn-selecionar-perguntas btn-modal-in btn btn-sm btn-default" type="button">
                                    <i class="glyphicon glyphicon-search"></i> Selecionar Campos
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="tab-container">
                            <style>
                                .nav-tabs li a{
                                    margin:2px 0 0 2px !important;
                                }

                                .tab-content {
                                    border: 2px solid #c1ccd1 !important;
                                    border-top: 0 !important;
                                }
                            </style>
                            <ul class="nav nav-tabs tab-perfil-grupos" role="tablist">

                                <li class="btn-add-grupo-perguntas">
                                    <a data-url="{{ route('evento.grupo_campos_store')  }}" contenteditable="true" href="#add-grupo-perguntas"><i class="glyphicon glyphicon-plus"></i></a>
                                </li>
                                <li class="btn-remove-grupo-perguntas">
                                    <a data-url="{{ route('evento.grupo_campos_destroy')  }}" href="#remover-grupo-perguntas"><i class="glyphicon glyphicon-trash"></i></a>
                                </li>
                            </ul>

                            <div class="tab-content" data-url-ordenacao="{{ route('evento.ordenar_campos') }}">

                            </div>
                        </div>
                        <!-- end col-6 -->
                        <div class="col-xs-12">
                            <div class="pull-right">
                                <button class="btn btn-primary" type="button">
                                <i class="glyphicon glyphicon-list-alt"></i> Pré Visualizar</button>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </fieldset>
                <fieldset class="animated" id="adicionar-pergunta">
                    <legend>Adicionar Campo</legend>

                    <form  class="form-xhr" id="perfil-campos" action="{{ route('evento.perfil_campos_store') }}" method="POST">
                        <input name="id" type="hidden"/>
                        <input name="evento_perfil_id" type="hidden"/>
                        <div class="row">
                            <div class="col-xs-12  btn-first">
                                <div class="pull-right">
                                    <button class="btn btn-default btn-modal-out" type="button" data-in="#listagem-perguntas" data-out="#adicionar-pergunta">
                                    <i class="fa fa-chevron-left"></i> Voltar</button>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="">Nome do campo</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-question-sign"></i>
                                    </div>
                                    <input type="text" name="campo" class="form-control" id="" placeholder="Informe o nome do campo que será exibido no formulário de inscrição">
                                </div>
                            </div>

                            <div class="form-group col-xs-12">
                                <label for="">Descrição</label>
                                <textarea name="descricao" class="form-control" id="" placeholder="Descreva um breve resumo sobre o perfil"></textarea>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Tipo</label>
                                <select name="campo_tipo_id" class="form-control">
                                    <option value="1">Campo aberto - texto</option>
                                    <option value="2">Campo aberto - número</option>
                                    <option value="3">Data</option>
                                    <option value="4">Monetário</option>
                                    <option value="5">Texto</option>
                                    <option value="6">Alternativa</option>
                                    <option value="7">Opções</option>
                                    <option value="8">Caixa de seleção</option>
                                    <option value="9">Arquivo</option>
                                    <option value="10">Parágrafo</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Obrigatório</label>
                                <select name="obrigatorio" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Permite valores duplicados</label>
                                <select name="duplicado" class="form-control">
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Máscara</label>
                                <input name="mascara" type="text" class="form-control" />
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Tamanho</label>
                                <select name="tamanho" class="form-control">
                                    <option value="1">Grande</option>
                                    <option value="2">Médio</option>
                                    <option value="3">Pequeno</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Definir como padrão</label>
                                <select name="campo_padrao" class="form-control">
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>

                            <div class="col-xs-12">
                                <div class="table-responsive"  style="display:none">
                                <table class="table table-hover table-sortable grid-perguntas-alternativas">
                                    <thead>
                                        <tr>
                                            <th class="move-line"><i class="hide fa fa-arrows"></i></th>
                                            <th>Alternativa</th>
                                            <th class="grid-acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="linha-add-alternativa">
                                            <td></td>
                                            <td class="btn-add-pergunta-alternativa" colspan="2"><i class="glyphicon glyphicon-plus"></i> Adicionar alternativa</td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="pull-right">
                                    <button style="margin:0" class="btn btn-default btn-modal-in btn-inline btn-add-pergunta-condicao" data-in="#adicionar-condicao" data-out="#adicionar-pergunta">
                                        <i class="glyphicon glyphicon-check"></i> Adicionar Condição
                                    </button>
                                    <button class="btn btn-primary" type="submit">
                                    <i class="glyphicon glyphicon-floppy-save"></i> Salvar Campo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>

                <fieldset id="adicionar-condicao">
                    <legend>Condições</legend>

                    <form  class="form-xhr" id="campo-condicoes" action="{{ route('evento.campo_condicoes_store') }}" method="POST">
                        <input name="campo_id" type="hidden"/>
                        <div class="row">
                            <div class="col-xs-12 btn-first">
                                <div class="pull-right">
                                    <button class="btn btn-default btn-modal-out" data-in="#adicionar-pergunta" data-out="#adicionar-condicao" type="button">
                                    <i class="fa fa-chevron-left"></i> Voltar</button>
                                </div>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>Dependente de</label>
                                <select name="dependente_campo_id" class="form-control">
                                    <option value="">Nenhum</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label>Condição</label>
                                <select name="condicao" class="form-control">
                                    <option value="==">Igual</option>
                                    <option value=">=">Maior Igual</option>
                                    <option value="<=">Menor Igual</option>
                                    <option value=">">Maior que</option>
                                    <option value="<">Menor que</option>
                                    <option value="!=">Diferente</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Valor</label>
                                <input type="text" name="valor" class="form-control" />
                            </div>
                            <div class="form-group col-sm-1">
                                <button type="submit" class="pull-right btn btn-primary btn-inline" data-toggle="tooltip" data-placement="top" title="Adicionar Condição">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </div>

                            <div class="col-xs-12">
                                <div class="table-responsive">
                                <table class="table table-hover grid-perguntas-condicoes">
                                    <thead>
                                        <tr>
                                            <th>Campo</th>
                                            <th>Condição</th>
                                            <th>Valor</th>
                                            <th class="grid-acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </fieldset>
                <fieldset id="selecionar-perguntas">
                    <legend>Selecionar Campos</legend>
                    <div class="row">
                        <div class="col-xs-12 btn-first">
                            <div class="pull-right">
                                <button class="btn btn-default btn-modal-out" data-in="#listagem-perguntas" data-out="#selecionar-perguntas" type="button">
                                <i class="fa fa-chevron-left"></i> Voltar</button>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table class="table table-hover grid-perguntas-definidas">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Tipo</th>
                                            <th>Obrigatório</th>
                                            <th class="grid-acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end col-6 -->
                    </div>
                    <!-- end row -->
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection