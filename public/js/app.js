var Graficos = function(){
	this.areas = function(){
		/*Gráfico de Áreas*/
		if($('#grafico-areas').length > 0){
			$('#grafico-areas').replaceWith('<canvas id="grafico-areas"></canvas>');

			var ctx = document.getElementById("grafico-areas").getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(doughnutDataAreas, {
				responsive : true,
				percentageInnerCutout: 60,
				maintainAspectRatio: true
			});

			var legend = window.myDoughnut.generateLegend();
            legend = $(legend);
            $(legend).find('li span').each(function(){                            
                $(this).css('border-color', $(this).css('background-color'));
            });
            $(".grafico-legenda-areas").html(legend);
    	}
	}
	this.faixa_salarial = function(){
		/*Gráfico de Faixa Salarial*/
		if($('#grafico-faixa-salarial').length > 0){
			$('#grafico-faixa-salarial').replaceWith('<canvas id="grafico-faixa-salarial"></canvas>');

			var ctx = document.getElementById("grafico-faixa-salarial").getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(doughnutDataFaixaSalarial,{
				responsive : true,
				percentageInnerCutout: 60
			});

			var legend = window.myDoughnut.generateLegend();
            legend = $(legend);
            $(legend).find('li span').each(function(){                            
                $(this).css('border-color', $(this).css('background-color'));
            });
            $(".grafico-legenda-faixa-salarial").html(legend);
		}
	}
	this.faixa_etaria = function(){	
		/*Gráfico de Faixa Etária*/
		if($('#grafico-faixa-etaria').length > 0){
			$('#grafico-faixa-etaria').replaceWith('<canvas id="grafico-faixa-etaria"></canvas>');

			var ctx = document.getElementById("grafico-faixa-etaria").getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(doughnutDataFaixaEtaria, {
				responsive : true,
				percentageInnerCutout: 60
			});

			var legend = window.myDoughnut.generateLegend();
            legend = $(legend);
            $(legend).find('li span').each(function(){                            
                $(this).css('border-color', $(this).css('background-color'));
            });
            $(".grafico-legenda-faixa-etaria").html(legend);
    	}
	}
};

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('[name="telefone"]').mask(SPMaskBehavior, spOptions);

	$(document).on('change','select#selecionar-area-grafico',function(){
		var area = $(this).val();

		if(area != '')
		{
			window.location.href = ENDERECO+'/usuario/profissional/area/'+area;
		}
	});

	$(document).on('click','.btn-visualizar-profissional',function(){
		var url = $(this).attr('data-href'),
			profissional = $(this).attr('data-profissional'),
			area = $(this).attr('data-area'),
			status = $(this).attr('data-status');

		if(status == ''){
			$('.btn-solicitar-profissional').show();
			$('.btn-solicitacao-enviada').hide();
			$('.btn-solicitar-profissional').attr({
				'data-profissional':profissional,
				'data-area':area
			});	
		}else{
			$('.btn-solicitar-profissional').hide();
			$('.btn-solicitacao-enviada').show();
		}

		$.ajax({
			url: url,
			type:'POST',
			dataType:'HTML',
			data:{
				profissional: profissional,
				area: area
			}
		}).done(function(retorno){
			$('#modal-visualizar-profissional').find('.modal-body').html(retorno);
		}).fail(function(){
			Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
		}).always(function(){

		});
		
		
		$('#modal-visualizar-profissional').modal();
	});

	$(document).on('click','.btn-solicitar-profissional',function(){
		var url = $(this).attr('data-href'),
			profissional = $(this).attr('data-profissional'),
			area = $(this).attr('data-area');

		if(window.confirm('Tem certeza que deseja enviar uma solicitação de contato a esse profissional?')){
			$.ajax({
				url: url,
				type:'POST',
				dataType:'json',
				data:{
					profissional_id: profissional,
					area: area
				}
			}).done(function(retorno){
				if(retorno.status == 1){
					$('#modal-visualizar-profissional').modal('hide');
					$('.btn-visualizar-profissional[data-profissional="'+profissional+'"]').attr('data-status','0');
					Notificar.sucesso(retorno.mensagem);
				}else
					Notificar.erro(retorno.mensagem);
			}).fail(function(){
				Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
			}).always(function(){

			});
		}
	});

	$(document).on('click','.btn-concluir-solicitacao',function(){

		var url = $(this).attr('data-href'),
			solicitacao = $(this).attr('data-solicitacao'),
			$table = $(this).closest('table');
			$trPendencia = $(this).closest('tr');

		if(window.confirm('Tem certeza que deseja concluir/dar baixa nessa solicitação ?')){
			$.ajax({
				url: url,
				type:'POST',
				dataType:'json',
				data:{
					solicitacao_id: solicitacao
				}
			}).done(function(retorno){
				if(retorno.status == 1){
					Notificar.sucesso(retorno.mensagem);

					$('.grid-solicitacao-baixada tbody tr').remove();
					/*
					$.each(retorno.solicitacaoBaixada,function(k,solicitacao){	
						$tr = $('<tr>');

						$('.grid-solicitacao-baixada thead th').each(function(){
							$tr.append(
								$('<td>').html(solicitacao[$(this).attr('data-campo')])
							);
						});

						$('.grid-solicitacao-baixada tbody').append($tr);
						
					});*/
					$trPendencia.remove();
					$('.grid-solicitacao-baixada tbody').append(retorno.grid);

					if($('.grid-solicitacao-baixada').hasClass('hide')){
						$('.nenhuma-solicitacao-concluida').remove();
						$('.grid-solicitacao-baixada').hide().removeClass('hide').fadeIn();
					}

					if($('.grid-solicitacao-pendente tbody tr').length == 0){
						$('.grid-solicitacao-pendente').remove();
						$('.nenhuma-solicitacao-pendente').hide()
							.removeClass('hide')
							.fadeIn();
					}
					
				}else
					Notificar.erro(retorno.mensagem);
			}).fail(function(){

			}).always(function(){

			});
		}
	});

	$('#selecionar-area-grafico').multiselect({
		enableFiltering: true,
		filterBehavior: 'text',
		buttonWidth: '100%',
	});

	window.onload = function(){
		if($('#home-charts').length > 0){
			var G = new Graficos();
			G.areas();
			G.faixa_salarial();
			G.faixa_etaria();
		}
	};

	/*Insere/Edita Profissionais*/
	$(document).on('click','.btn-cadastrar-profissional,.btn-editar-profissional,.link-cadastrar-profissional',function(){
		
		var url = $(this).hasClass('btn-editar-profissional') ||  $(this).hasClass('link-cadastrar-profissional') ? $(this).attr('data-href') : URL.Profissional.create;
		$.ajax({
			url: url,
			type:'POST',
			dataType:'HTML',
			data:{
				xhr:'create'
			}
		}).done(function(retorno){
			$('#modal-cadastrar-profissional').find('.modal-body').html(retorno);

			$('[data-toggle="tooltip"]').tooltip();
			$('input.datepicker')
				.datepicker({
					language: 'pt-BR',
					format: 'dd/mm/yyyy'
				})
				.mask('00/00/0000');
				
			$('#select-profissional-areas').multiselect({
				//enableFiltering: true,
				filterBehavior: 'text',
				buttonWidth: '100%',
				numberDisplayed:4,
				onChange: function(option, checked) {
		            // Get selected options.
		            var selectedOptions = $('#select-profissional-areas option:selected');

		            if (selectedOptions.length >= 4) {
		                // Disable all other checkboxes.
		                var nonSelectedOptions = $('#select-profissional-areas option')
		                	.filter(function() {
						
		                    return !$(this).is(':selected');
		                });

		                var dropdown = $('#select-profissional-areas').siblings('.multiselect-container');
		                nonSelectedOptions.each(function() {
		                    var input = $('input[value="' + $(this).val() + '"]');

		                    input.prop('disabled', true);
		                    input.parent('li').addClass('disabled');
		                });
		            }
		            else {
		                // Enable all checkboxes.
		                var dropdown = $('#select-profissional-areas').siblings('.multiselect-container');
		                $('#select-profissional-areas option').each(function() {
		                    var input = $('input[value="' + $(this).val() + '"]');
		                    input.prop('disabled', false);
		                    input.parent('li').addClass('disabled');
		                });
		            }
		        }
			});
		}).fail(function(){

		}).always(function(){

		});
		$('#modal-cadastrar-profissional').modal();
	});

	/*Insere/Edita Profissionais*/
	$(document).on('click','.btn-cadastrar,.btn-editar,.link-cadastrar',function(){
		var url = $(this).attr('data-href'),
			$modal = $('#'+$(this).attr('data-modal'));

		$modal.find('.btn-modal-save').prop('disabled', true);
		$.ajax({
			url: url,
			type:'POST',
			dataType:'HTML',
			data:{
				xhr:'create'
			}
		}).done(function(retorno){
			$modal.find('.modal-body').html(retorno);
			$modal.find('[data-toggle="tooltip"]').tooltip();
			$modal.find('.btn-modal-save').prop('disabled', false);
		}).fail(function(){

		}).always(function(){

		});

		$modal.modal();
	});

	$(document).on('click','.btn-modal-save, .btn-submit-xhr',function(){
		var $formulario = $(this).closest('.formulario'),
			$modal = $(this).closest('.modal'),
			$form = $(this).closest('.formulario').find('form'),
			$that = $(this),
			url = typeof $(this).attr('data-url') !== 'undefined' ? $(this).attr('data-url') : $form.attr('action');

		$that.prop('disabled', true);
		$that.after($('<span></span>').addClass('ajax-loader'));

		$.ajax({
			url: url,
			type:'POST',
			dataType:'json',
			data: $form.serialize()
		}).done(function(retorno){
			if(retorno.status == 1){
				if(typeof retorno.statistics !== 'undefined' && $('#home-charts').length > 0){
					Notificar.sucesso(retorno.mensagem);
					
					$modal.modal('hide');

					$('.chart-total-profissional').hide().
						html(retorno.statistics.totalProfissional)
						.fadeIn();

					$('.chart-profissional-expirando').hide()
						.html(retorno.statistics.totalProfissionalExpirando)
						.fadeIn();

					$('.chart-solicitacao-pendente').hide()
						.html(retorno.statistics.totalSolicitacaoPendente)
						.fadeIn();
					
					var charts = retorno.statistics.charts;
					doughnutDataAreas = $.parseJSON(charts.areas);
					doughnutDataFaixaEtaria = $.parseJSON(charts.faixa_etaria);
					doughnutDataFaixaSalarial = $.parseJSON(charts.faixa_salarial);

					var G = new Graficos();
					G.areas();
					G.faixa_salarial();
					G.faixa_etaria();
				}else
				if(typeof $that.attr('data-login') !== 'undefined' && $('.form-login').length > 0){

					Notificar.sucesso(retorno.mensagem);
					$('.form-login [name="email"]').val($form.find('[name="email"]').val());
					$('.form-login [name="password"]').val($form.find('[name="password"]').val());
					$('.form-login').submit();
				}else
				if ($formulario.hasClass('modal-content') && $form.find('[name="acao"]').val() != 'adicionar'){

					Notificar.sucesso(retorno.mensagem);
					if(typeof $that.attr('data-redirect') != 'undefined'){	
						$modal.on('hidden.bs.modal', function () {
							window.location.href = $that.attr('data-redirect'); 
						});
					}
					//$modal.modal('hide');
				}else
				if(typeof $that.attr('data-redirect'))
					window.location.href = $that.attr('data-redirect');
				
			}else{
				Notificar.erro(retorno.mensagem);
			}
			
		}).fail(function(xhr){
			if(xhr.status = 422){
				var errors = $.parseJSON(xhr.responseText);
				$form.find('.text-danger').remove();

				$.each(errors,function(campo,mensagem){
					var $msg = $('<small></small>').addClass('text-danger').html(mensagem);
					$form.find('[name^="'+campo+'"]')
						.closest('.form-group')
						.addClass('has-error');

					if($form.find('[name^="'+campo+'"]').closest('.input-group').length > 0)
						$form.find('[name^="'+campo+'"]').closest('.input-group').parent()
							.append($msg);
					else
						$form.find('[name^="'+campo+'"]').closest('.form-group')
							.append($msg);

				});

				Notificar.erro('Não foi possível prosseguir! Verifique os dados informados e tente novamente.');
			}else
				Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');

		}).always(function(){
			$that.prop('disabled', false);
			$($formulario,$modal).find('.ajax-loader').fadeOut(500,function(){$(this).remove();});
		});
	});

	$(document).on('change','.has-error input,.has-error select,.has-error textarea',function(){
		if($(this).val() != ''){
			$(this).closest('.form-group')
				.removeClass('has-error')
					.find('.text-danger')
					.fadeOut()
					.remove();
		}
	});

	$(document).on('click','.btn-excluir',function(){

		var id = $(this).attr('data-excluir'),
			url = $(this).attr('data-href'),
			mensagem = $(this).attr('data-mensagem'),
			acao = $(this).attr('data-acao'),
			$that = $(this);

		if(window.confirm(mensagem)){
			$.ajax({
				url: url,
				type:'POST',
				dataType:'json',
				data:{id: id, acao: acao}
			}).done(function(retorno){
				if(retorno.status == 1){
					if(typeof $that.attr('data-redirect'))
						window.location.href = $that.attr('data-redirect');
					else
						Notificar.sucesso(retorno.mensagem);

				}else
					Notificar.erro(retorno.mensagem);
			}).fail(function(){
				Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
			}).always(function(){

			});
		}
	});

	$(document).on('submit','.form-search-grid,.modal form',function(){
		return false;
	});

	$(document).on('change keypress','.search-grid',function(e){
		var code = e.keyCode || e.which;
		if($(this).attr('type') == 'text' && code != 13) return;

		var url = $(this).attr('data-url'),
			name = $(this).attr('name'),
			search = $(this).val(),
			$that = $(this),
			$form = $(this).closest('.form-search-grid');
			$grid = $('.'+$(this).attr('data-grid'));

		if($grid.length > 0){
			$that.after($('<span></span>').addClass('ajax-loader'));
			$.ajax({
				url: url,
				type:'POST',
				dataType:'json',
				data: $form.serialize()
			}).done(function(retorno){

				if(retorno.status == 1){

					$grid.find('tbody.grid-content tr').remove();
					$grid.find('tbody.grid-content').append(retorno.grid);

					$('[data-toggle="tooltip"]').tooltip();
				
				}else
					Notificar.erro(retorno.mensagem);
			}).fail(function(){
				Notificar.erro(retorno.mensagem);
			}).always(function(){
				$form.find('.ajax-loader').fadeOut(500,function(){$(this).remove();});
			});
		}else
			Notificar.erro('Grid não encontrado.');
	});
});