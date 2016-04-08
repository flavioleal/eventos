@extends('site/evento')
@section('page')
<div class="row">
    <div class="col-md-9">
        <h3 class="first-title">Área do participante</h3>
    </div>
    <div class="col-md-3" style="margin-top: 20px;">
        <p class="pull-right">Olá, seja bem-vindo {{ Auth::getUser()->email }}<br>
            <a href="{{ route('participant.logout', ['slug' => $evento->slug]) }}"
               class="btn btn-default btn-sm pull-right">
                <i class="glyphicon glyphicon-log-out"></i> Sair
            </a>
        </p>
    </div>
</div>
<div class="row conteudo-inscricao">
    <div class="formulario-inscricao">
        <div class="wizard-container">
            <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
                <ul class="groups-steps">
                    @if (count($perfis) > 1)
                        <li class="profile-step fixed-step">
                            <a href="#tipo-inscricao" data-toggle="tab">Tipo de Inscrição</a>
                        </li>
                    @endif
                    @foreach ($grupos as $grupo)
                        <li data-perfil="{{ $grupo->evento_perfil_id }}">
                            <a href="#tab-grupo-{{ $grupo['id']  }}" data-toggle="tab">{{ $grupo['titulo']  }}</a>
                        </li>
                    @endforeach

                    @foreach ($perfis as $perfil)
                        @if ($perfil->exigir_pagamento == 1 && $perfil->valor > 0)
                        <li data-perfil="{{ $perfil->id }}" class="payment-step">
                            <a href="#payment-step" data-toggle="tab">Forma de pagamento</a>
                        </li>
                        @endif
                    @endforeach
                    <li class="confirmation-step fixed-step active">
                        <a href="#confirmacao-step" data-toggle="tab">Confirmação</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="confirmacao-step">
                        {!! $confirmacao !!}
                    </div>
                    <div class="tab-pane" id="payment-step">
                        <h4 class="info-text"> Selecione a forma de pagamento abaixo</h4>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="well"> <h3 class="text-center">Valor a pagar: R$ 299.00</h3></div>
                            </div>
                            <div class="col-md-offset-2 col-md-4">
                                <div class="radio">
                                    <label for="billet-method">
                                        <input name="payment_method" id="billet-method" type="radio">
                                        <img class="img-responsive" src="/img/payment_method/billet.png">
                                    </label>
                                </div>
                                <h6>INFORMAÇÕES SOBRE BOLETOS:</h6>
                                <p class="text-justify"><small>Vencimento de boletos: 3 dias corridos, observado o limite máximo de 25/06/2016 para emissão.
                                        Após essa data, não será possível emitir ou pagar através de boleto.
                                        NÃO É POSSÍVEL PAGAR BOLETO VENCIDO.
                                        Comunicados sobre pagamentos, comprovantes, etc. serão enviados para seu e-mail.</small></p>
                            </div>
                            <div class="col-md-4">
                                <div class="radio">
                                    <label for="pagseguro-method">
                                        <input name="payment_method" id="pagseguro-method" type="radio">
                                        <img class="img-responsive" src="/img/payment_method/pagseguro.png">
                                    </label>
                                </div>
                                <h6>PAGAMENTOS COM CARTÃO DE CRÉDITO:</h6>
                                <p class="text-justify"><small>UOL PagSeguro são sites de pagamento com segurança certificada.
                                        Tenha em mãos o cartão, nome e endereço do titular.
                                        O cadastro é necessário para sua segurança e poderá utilizá-lo nas futuras compras</small></p>
                            </div>
                        </div>
                    </div>
                    @if (count($perfis) > 1)
                    <div class="tab-pane" id="tipo-inscricao">
                        <h4 class="info-text"> Selecione abaixo um dos perfis</h4>
                        <div class="row">
                        @foreach ($perfis as $perfil)
                            <div class="col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{ strtoupper($perfil->titulo) }}</h3>
                                    </div>
                                    <div class="panel-body">
                                        {{ $perfil->descricao }}
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="radio">
                                                    <label for="campo-perfil-{{ $perfil->id  }}">
                                                        <input  name="campo-perfil"
                                                                type="radio"
                                                                id="campo-perfil-{{ $perfil->id  }}"
                                                                value="{{ $perfil->id }}"
                                                        @if ($participante->evento_perfil_id == $perfil->id)
                                                            checked="checked"
                                                        @endif
                                                        >
                                                        Selecionar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pull-right text-right">
                                                    <small>@if ($perfil->exigir_pagamento == 0) <b>Gratuito</b>  @else Valor: R$ {{ $perfil->valor }} @endif</small><br>
                                                    <small>Quantidade disponível: {{ $perfil->quantidade }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endif
                    <input type="hidden" name="id" value="{{ $participante->id }}" />
                    @foreach ($grupos as $grupo)
                        <div data-perfil="{{ $grupo->evento_perfil_id }}" class="tab-pane" id="tab-grupo-{{ $grupo->id  }}">
                            <h4 class="info-text"> Preencha os campos do formulário abaixo</h4>
                            <form class="form-evento-participante" enctype="multipart/form-data" >
                            <input name="grupo_id" type="hidden" value="{{ $grupo->id }}" />
                            @foreach ($campos as $campo)
                                @if ($campo->evento_perfil_grupo_id == $grupo->id)

                                <div class="{{ $tamanho[$campo->tamanho]  }}">
                                    <div class="form-group"
                                        {{$temp = ''}}
                                        @foreach($condicoes as $condicao)
                                            @if ($condicao->campo_id == $campo->id)
                                                {{$temp[] = $condicao}}
                                            @endif
                                        @endforeach
                                        @if (is_array($temp)) data-condicao="1" @endif
                                    >
                                        @if (is_array($temp)) <span class="hide data-condicao">{!! json_encode($temp) !!}</span> @endif
                                        <label for="campo-{{ $campo->id  }}" class="@if ($campo->obrigatorio) requerido @endif">{{ $campo->campo }}</label>
                                        <!-- 1 - Campo aberto - texto -->
                                        @if ($campo->campo_tipo_id == 1)
                                            @if ($campo->autocomplete == 1)
                                            <div class="input-group">
                                            @endif
                                                <input
                                                    id = "campo-{{ $campo->id  }}"
                                                    data-campo="{{ $campo->id }}"
                                                    data-autocomplete="{{ $campo->autocomplete }}"
                                                    @if ($campo->obrigatorio == 1)
                                                    required="required"
                                                    data-required="required"
                                                    @endif
                                                    data-classe="{{ $campo->classe }}"
                                                    class="campo-text form-control {{ $campo->classe  }}"
                                                    name="campo[text-{{ $campo->id  }}]"
                                                    value="{{ $campo->resposta }}"
                                                    @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                                    type="text"
                                                />
                                            @if ($campo->autocomplete == 1)
                                                <span class="input-group-addon btn" data-placement="top"
                                                      data-tooltip="tooltip"
                                                      data-tooltip-title="Clique para buscar mais informações"
                                                      data-popover="popover"
                                                      data-popover-title="Popover title"
                                                >
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </span>
                                            </div>
                                            @endif
                                        @endif
                                        <!-- 2 - Campo aberto - número -->
                                        @if ($campo->campo_tipo_id == 2)
                                            <input
                                                id = "campo-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio) required @endif
                                                class="campo-number form-control {{ $campo->classe  }}"
                                                name="campo[number-{{ $campo->id  }}]"
                                                value="{{ $campo->resposta }}"
                                                @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                                type="number"
                                            />
                                        @endif
                                        <!-- 3 - Data -->
                                        @if ($campo->campo_tipo_id == 3)
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <input
                                                    id = "campo-{{ $campo->id  }}"
                                                    data-campo="{{ $campo->id }}"
                                                    data-autocomplete="{{ $campo->autocomplete }}"
                                                    @if ($campo->obrigatorio) required @endif
                                                    class="campo-datetime form-control {{ $campo->classe  }}"
                                                    name="campo[date-{{ $campo->id  }}]"
                                                    value="{{ $campo->resposta }}"
                                                    @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                                    type="text"
                                                />
                                            </div>
                                        @endif
                                        <!-- 4 - Monetário -->
                                        @if ($campo->campo_tipo_id == 4)
                                            <div class="input-group">
                                                <span class="input-group-addon">R$</span>
                                                <input
                                                    id = "campo-{{ $campo->id  }}"
                                                    data-campo="{{ $campo->id }}"
                                                    data-autocomplete="{{ $campo->autocomplete }}"
                                                    @if ($campo->obrigatorio) required @endif
                                                    class="campo-money form-control {{ $campo->classe  }}"
                                                    name="campo[money-{{ $campo->id  }}]"
                                                    value="{{ $campo->resposta }}"
                                                    @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                                    type="text"
                                                />
                                            </div>
                                        @endif
                                        <!-- 5 - Texto -->
                                        @if ($campo->campo_tipo_id == 5)
                                            <textarea
                                                id = "campo-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio) required @endif
                                                class="campo-longtext form-control {{ $campo->classe  }}"
                                                name="campo[textarea-{{ $campo->id  }}]"
                                                @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                            >{{ $campo->resposta }}</textarea>
                                        @endif

                                        <!-- 6 - Alternativa -->
                                        @if ($campo->campo_tipo_id == 6)
                                            @foreach ($alternativas as $alternativa)
                                                @if($alternativa->campo_id == $campo->id)
                                                    <div class="checkbox">
                                                        <label for="campo-{{ $campo->id  }}-{{ $alternativa->id }}">
                                                            <input
                                                                id = "campo-{{ $campo->id  }}"
                                                                data-campo="{{ $campo->id }}"
                                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                                id="campo-{{ $campo->id  }}-{{ $alternativa->id }}"
                                                                @if ($campo->obrigatorio) required @endif
                                                                class="campo-checkbox {{ $campo->classe  }}"
                                                                name="campo[checkbox-{{ $campo->id }}][{{ $alternativa->id  }}]"
                                                                type="checkbox"
                                                                data-type="{{ $alternativa->checked }}"
                                                                @if (!empty($alternativa->checked))
                                                                checked="checked"
                                                                @endif
                                                            />
                                                            {{ $alternativa->alternativa }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        <!-- 7 - Opções -->
                                        @if ($campo->campo_tipo_id == 7)
                                            @foreach ($alternativas as $alternativa)
                                                @if($alternativa->campo_id == $campo->id)
                                                <div class="radio">
                                                    <label for="campo-{{ $campo->id  }}-{{ $alternativa->id }}">
                                                        <input
                                                        id = "campo-{{ $campo->id  }}"
                                                        data-campo="{{ $campo->id }}"
                                                        data-autocomplete="{{ $campo->autocomplete }}"
                                                        id="campo-{{ $campo->id  }}-{{ $alternativa->id }}"
                                                        @if ($campo->obrigatorio) required @endif
                                                        class="campo-radio {{ $campo->classe  }}"
                                                        type="radio"
                                                        name="campo[radio-{{ $campo->id  }}]"
                                                        value="{{ $alternativa->alternativa }}"
                                                        @if ($alternativa->alternativa == $campo->resposta)
                                                        checked="checked"
                                                        @endif
                                                        />
                                                        {{ $alternativa->alternativa }}
                                                    </label>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        <!-- 8 - Caixa de seleção -->
                                        @if ($campo->campo_tipo_id == 8)
                                            <select
                                                id = "campo-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio) required @endif
                                                class="campo-select {{ $campo->classe  }} form-control"
                                                name="campo[select-{{ $campo->id  }}]">
                                                    <option value=""></option>
                                                @foreach ($alternativas as $alternativa)
                                                    @if($alternativa->campo_id == $campo->id)
                                                        <option value="{{ $alternativa->id }}"
                                                        @if ($campo->resposta == $alternativa->id) selected="selected"
                                                        @endif
                                                        >{{ $alternativa->alternativa }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        <!-- 9 - Arquivo -->
                                        @if ($campo->campo_tipo_id == 9)
                                            <input
                                                id = "campo-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio) required @endif
                                                class="campo-file form-control {{ $campo->classe  }}"
                                                name="campo[file-{{ $campo->id  }}]"
                                                type="file"
                                            />
                                        @endif
                                        <!-- 10 - Parágrafo -->
                                        @if ($campo->campo_tipo_id == 10)
                                            <p>{!! $campo->descricao !!}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <input type='button' class='btn-next btn-lg compumake-btn-orange compumake-btn' name='next' value='Próximo' />
                        <input type='submit' class='btn-finish btn-lg compumake-btn-orange compumake-btn hide' name='finish' value='Finalizar' />
                    </div>
                    <div class="pull-left">
                        <input type='button' class='btn-previous btn-lg compumake-btn-orange compumake-btn' name='previous' value='Anterior' />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row hide">
        <div class="col-md-12">
            <a id="btn-voltar" href="#"  class="btn-lg compumake-btn-orange compumake-btn btn-submit-xhr">Voltar</a>
        </div>
    </div>
</div>
@endsection