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