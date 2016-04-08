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
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
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