
<div class="wizard-container">

	<div class="card wizard-card ct-wizard-orange" id="wizardProfile">
        <form class="form-evento-participantes" id="form-evento" enctype="multipart/form-data" >
			<!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
			<div class="wizard-header hide">
				<h3>
					<b>BUILD</b> YOUR PROFILE <br>
					<small>This information will let us know more about you.</small>
				</h3>
			</div>
			<ul>
				@if (count($perfis) > 1)<li><a href="#tipo-inscricao" data-toggle="tab">Tipo de Inscrição</a></li>@endif
				@foreach ($grupos as $grupo)
				    <li><a href="#tab-grupo-{{ $grupo['id']  }}" data-toggle="tab">{{ $grupo['titulo']  }}</a></li>
				@endforeach
			</ul>

			<div class="tab-content">
				@if (count($perfis) > 1)
				<div class="tab-pane" id="tipo-inscricao">
					<h4 class="info-text"> Selecione abaixo um dos perfis</h4>
					@foreach ($perfis as $perfil)
						<div class="well col-md-2">
							<h3>{{ $perfil->titulo }}</h3>
						</div>
					@endforeach
				</div>
				@endif

                @foreach ($grupos as $grupo)
                    <div class="tab-pane" id="tab-grupo-{{ $grupo->id  }}">
                        <h4 class="info-text"> Preencha os campos do formulário abaixo</h4>

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
                                    <label for="field-{{ $campo->id  }}" class="@if ($campo->obrigatorio) requerido @endif">{{ $campo->campo }}</label>

                                    <!-- 1 - Campo aberto - texto -->
                                    @if ($campo->campo_tipo_id == 1)
                                        @if ($campo->autocomplete == 1)
                                        <div class="input-group">
                                        @endif
                                            <input
                                                id = "field-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio == 1)
                                                required="required"
                                                data-required="required"
                                                @endif
                                                data-classe="{{ $campo->classe }}"
                                                class="field-text form-control {{ $campo->classe  }}"
                                                name="text-{{ $campo->id  }}"
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
                                            id = "field-{{ $campo->id  }}"
                                            data-campo="{{ $campo->id }}"
                                            data-autocomplete="{{ $campo->autocomplete }}"
                                            @if ($campo->obrigatorio) required @endif
                                            class="field-number form-control {{ $campo->classe  }}"
                                            name="number-{{ $campo->id  }}"
                                            @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                            type="number"
                                        />
                                    @endif

                                    <!-- 3 - Data -->
                                    @if ($campo->campo_tipo_id == 3)
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <input
                                                id = "field-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio) required @endif
                                                class="field-datetime form-control {{ $campo->classe  }}"
                                                name="date-{{ $campo->id  }}"
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
                                                id = "field-{{ $campo->id  }}"
                                                data-campo="{{ $campo->id }}"
                                                data-autocomplete="{{ $campo->autocomplete }}"
                                                @if ($campo->obrigatorio) required @endif
                                                class="field-money form-control {{ $campo->classe  }}"
                                                name="money-{{ $campo->id  }}"
                                                @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                                type="text"
                                            />
                                        </div>
                                    @endif

                                    <!-- 5 - Texto -->
                                    @if ($campo->campo_tipo_id == 5)
                                        <textarea
                                            id = "field-{{ $campo->id  }}"
                                            data-campo="{{ $campo->id }}"
                                            data-autocomplete="{{ $campo->autocomplete }}"
                                            @if ($campo->obrigatorio) required @endif
                                            class="field-longtext form-control {{ $campo->classe  }}"
                                            name="textarea-{{ $campo->id  }}"
                                            @if (!empty($campo->mascara)) data-mascara="{{ $campo->mascara }}" @endif
                                        ></textarea>
                                    @endif

                                    <!-- 6 - Alternativa -->
                                    @if ($campo->campo_tipo_id == 6)
                                        @foreach ($alternativas as $alternativa)
                                            @if($alternativa->campo_id == $campo->id)
                                                <div class="checkbox">
                                                    <label for="field-{{ $campo->id  }}-{{ $alternativa->id }}">
                                                        <input
                                                            id = "field-{{ $campo->id  }}"
                                                            data-campo="{{ $campo->id }}"
                                                            data-autocomplete="{{ $campo->autocomplete }}"
                                                            id="field-{{ $campo->id  }}-{{ $alternativa->id }}"
                                                            @if ($campo->obrigatorio) required @endif
                                                            class="field-checkbox {{ $campo->classe  }}"
                                                            name="checkbox-{{ $campo->id  }}[]"
                                                            type="checkbox"
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
                                                <label for="field-{{ $campo->id  }}-{{ $alternativa->id }}">
                                                    <input
                                                    id = "field-{{ $campo->id  }}"
                                                    data-campo="{{ $campo->id }}"
                                                    data-autocomplete="{{ $campo->autocomplete }}"
                                                    id="field-{{ $campo->id  }}-{{ $alternativa->id }}"
                                                    @if ($campo->obrigatorio) required @endif
                                                    class="field-radio {{ $campo->classe  }}"
                                                    type="radio"
                                                    name="radio-{{ $campo->id  }}"
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
                                            id = "field-{{ $campo->id  }}"
                                            data-campo="{{ $campo->id }}"
                                            data-autocomplete="{{ $campo->autocomplete }}"
                                            @if ($campo->obrigatorio) required @endif
                                            class="field-select {{ $campo->classe  }} form-control"
                                            name="select-{{ $campo->id  }}">
                                                <option value=""></option>
                                            @foreach ($alternativas as $alternativa)
                                                @if($alternativa->campo_id == $campo->id)
                                                    <option value="{{ $alternativa->id }}">{{ $alternativa->alternativa }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif

                                    <!-- 9 - Arquivo -->
                                    @if ($campo->campo_tipo_id == 9)
                                        <input
                                            id = "field-{{ $campo->id  }}"
                                            data-campo="{{ $campo->id }}"
                                            data-autocomplete="{{ $campo->autocomplete }}"
                                            @if ($campo->obrigatorio) required @endif
                                            class="field-file form-control {{ $campo->classe  }}"
                                            name="file-{{ $campo->id  }}"
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
                    </div>
                @endforeach
			</div>

			<div class="wizard-footer">
				<div class="pull-right">
					<input type='button' class='btn-next btn-lg compumake-btn-orange compumake-btn' name='next' value='Próximo' />
					<input type='button' class='btn-finish btn-lg compumake-btn-orange compumake-btn' name='finish' value='Finalizar' />

				</div>

				<div class="pull-left">
					<input type='button' class='btn-previous btn-lg compumake-btn-orange compumake-btn' name='previous' value='Anterior' />
				</div>
				<div class="clearfix"></div>
			</div>
		</form>
	</div>
</div>


<link href="/js/x-bootstrap-wizard-v1.1/assets/css/gsdk-base.css" rel="stylesheet" />
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
<!--   plugins 	 -->
<script src="/js/x-bootstrap-wizard-v1.1/assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="/js/x-bootstrap-wizard-v1.1/assets/js/jquery.validate.min.js"></script>
<!--  methods for manipulating the wizard and the validation -->
<script src="/js/x-bootstrap-wizard-v1.1/assets/js/wizard.js"></script>

<script src="/js/jquery.mask.js"></script>

<script src="/js/datepicker/js/bootstrap-datepicker.js"></script>
<script src="/js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>

<link href="/js/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

<script type="text/javascript">

    function stringToDate(string)
    {
        var arr = string.split('/');
        var d = new Date();
        d.setDate(arr[0]);
        d.setMonth(arr[1]-1);
        d.setYear(arr[2]);
        return d;
    }
    var $loader = $('.loader-css').clone();

	$(document).ready(function(){

		$('.field-datetime').datepicker({
			language: "pt-BR",
			autoclose: true,
			format: "dd/mm/yyyy"
		});
		$('.field-datetime').mask('00/00/0000');
		$('.field-money').mask('000.000.000.000.000,00', {reverse: true});
		$('.field-cpf, .cpf').mask('000.000.000-00', {reverse: true});
		$('.field-cnpj, .cnpj').mask('00.000.000/0000-00', {reverse: true});
		$('.cep').mask('00000-000');

		var SPMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},
		spOptions = {
			onKeyPress: function(val, e, field, options) {
				field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
		};

		$('.telefone').mask(SPMaskBehavior, spOptions);

		$('[data-condicao]').hide();
		$('[data-condicao]').each(function(){
			var data = JSON.parse($(this).find('.data-condicao').text()),
				name = $(this).find('input,textarea,select').attr('name'),
                dependentes = [];

			$.each(data, function(k, v){
                var val = '$("[data-campo='+ v.dependente_campo_id +']").val()';

                v.valor = "'" + v.valor + "'";
				if ($('[data-campo='+ v.dependente_campo_id +']').hasClass('field-datetime')) {
                    val = '$("[data-campo='+ v.dependente_campo_id +']").datepicker("getDate")';
                    v.valor = "stringToDate("+ v.valor +")";
                }

                if ($('[data-campo='+ v.dependente_campo_id +']').hasClass('field-money')) {
                    val += ".replace(/\\./g, '').replace(/,/, '.')";
                    val = "parseFloat("+ val +")";
                }

				if (typeof dependentes[v.dependente_campo_id] === 'undefined') {
					dependentes[v.dependente_campo_id] = val + v.condicao + v.valor + " || ";
				} else {
					dependentes[v.dependente_campo_id] += val + v.condicao + v.valor + " || ";
				}
			});

			var condicao = '';
			for(id in dependentes){
				var c = dependentes[id];
				condicao += '('+c.substring(0, c.length -4)+') && ';
			}
			condicao = condicao.substring(0, condicao.length -4);

			for(id in dependentes){
				$('[data-campo="'+ id + '"]').change(function(){
					$ele =  $('[name="'+name+'"]');
					$ele.closest('[data-condicao]').hide();

					if (eval(condicao)) {
						$ele.closest('[data-condicao]').show();
					}
				});
			}
		});

        $('[data-tooltip="tooltip"]').tooltip({
            title: 'Clique para buscar mais informações',
            container: 'body'
        }).on('show.bs.tooltip shown.bs.tooltip', function (e) {
            var name = $(e.currentTarget).closest('.input-group').find('input').attr('name'),
                tooltip = $(e.currentTarget).attr('aria-describedby');

            $('#' + tooltip).attr('data-tooltip-campo', name);
            if ($('[data-popover-campo="' + name + '"]').is(':visible')) {
                return false;
            }
        });

		$('[data-popover="popover"]').popover({
			trigger: 'manual',
			title: 'Preencha o campo abaixo',
			content: '<div class="input-group">' +
			'<input class="form-control"><span class="input-group-addon btn btn-primary">Ok</span>' +
			'</div>',
			html: true,
			container: 'body'
		}).on('show.bs.popover shown.bs.popover', function (e) {
			var name = $(e.currentTarget).closest('.input-group').find('input').attr('name'),
					popover = $(e.currentTarget).attr('aria-describedby');

			$('#' + popover).attr('data-popover-campo', name);
		}).on('hide.bs.popover hidden.bs.popover', function(e){
            var $input = name = $(e.currentTarget).closest('.input-group').find('input');

            if ($input.attr('data-required') !== 'required') {
                $input.removeAttr('required');
            }
        });

		$('[data-popover="popover"]').on('click',function(e){
			var $popover = $(this),
				name = $(e.currentTarget).closest('.input-group').find('input').attr('name'),
				$input = $(this).closest('.input-group').find('input'),
                $form = $(this).closest('form'),
                validator = $form.validate(),
                required = $input.attr('required'),
				url;

            $input.attr({'required' : 'required'});

			if (!validator.element( '#' + $input.attr('id') )) {
                return false;
			}
			$('[data-tooltip-campo="' + name + '"]').hide();
			$(this).html($loader.show()).attr('disabled', true);

            if ($input.hasClass('cep')) {
                $.getJSON("//viacep.com.br/ws/"+$input.val().replace('-','').replace('.', '') +"/json/?callback=?", function(data) {
                    $popover.html('<i class="glyphicon glyphicon-search"></i>').attr('disabled', false);

                    if (typeof data.localidade !== undefined) {
                        data.cidade = data.localidade;
                    }
                    autocompleteEach(data);
                });

                return true;
            }

			$.ajax({
				url: ENDERECO + '/' + $input.attr('data-classe'),
				type: 'post',
				dataType: 'HTML'
			}).done(function(data){
                $popover.html('<i class="glyphicon glyphicon-search"></i>').attr('disabled', false);
				$popover.data('bs.popover').options.content = data;
				$popover.popover('show');

                if ($input.hasClass('cpf')) {
                    var dataNascimento = $input.closest('form#form-evento').find('input.nascimento').val();
                    $('.popover:visible').find('form input[name="dataNascimento"]').val(dataNascimento);
                }
                $('.popover:visible').find('form input[name="' +$input.attr('data-classe')+ '"]').val($input.val());
			});
		});
	});

    $(document).on('click', function(e) {
        var $popover = $(this);
        $('[data-popover=popover]').each(function() {
            // hide any open popovers when the anywhere else in the body is clicked
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });

    $(document).on('click', '.btn-autocomplete-submit', function(){
        $(this).html($loader.show()).attr('disabled', true);
        $.ajax({
            url: ENDERECO + '/' + $(this).attr('data-classe'),
            type: 'POST',
            data: $(this).closest('form').serialize(),
            dataType: 'json'
        }).done(function(data){
            autocompleteEach(data);
        }).always(function(){
            $('.popover').popover('hide');
        });
    });

    function autocompleteEach(data)
    {
        $.each(data, function(k, v){
            $('.form-evento-participantes select.' + k).val(v);
            $('.form-evento-participantes input.' + k).val(v);
            $('.form-evento-participantes textarea.' + k).val(v);
            $('.form-evento-participantes select.' + k + ' option').each(function(){
                var opt  = $(this).text().toLowerCase().trim(), valor = v, valInt = $(this).attr('value');
                if (opt == valor.toLowerCase().trim()) {
                    $('.form-evento-participantes select.' + k).val(valInt);
                    $(this).prop('selected',true);
                    return true;
                }
            });
        });
    }
</script>