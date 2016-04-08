
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