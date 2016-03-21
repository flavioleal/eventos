$(document).ready(function(){	
	$('form#perfil-campos').on('submit',function(e){
	    e.preventDefault();

	    var $form = $(this),
            grupoId = $('#modal-perguntas ul.tab-perfil-grupos li.active a[data-toggle="tab"]').attr('data-id'),
	        data = $form.serialize()+'&evento_perfil_grupo_id='+grupoId;

	    $('.grid-perguntas-alternativas tbody tr:not(.linha-add-alternativa)').each(function(){
	    	var alt = $(this).find('td:not(.move-line)').first().text();
			data += (alt != '') ? '&campo_alternativa[]='+alt : '';
	    });

	    $form.trigger('xhr',{fields:data});
	});

	//evento perfil - adiciona cupom de descontos
    $('form#perfil-campos').on('saved',function(event,data){

        var grupoId = $('#modal-perguntas ul.tab-perfil-grupos li.active a[data-toggle="tab"]').attr('data-id');

        if ($(this).attr('data-acao') == 'update') {
            var id = $(this).find('[name="id"]').val();

            var $linha = $('.tab-container #tab-'+grupoId+' .grid-perguntas tbody tr[data-id="'+id+'"]');

            $linha.find("td.grid-campo-campo").html($(this).find('[name="campo"]').val());
            $linha.find("td.grid-campo-tipo").html($(this).find('[name="campo_tipo_id"] option:selected').text());
            $linha.find("td.grid-campo-obrigatorio").html(($(this).find('[name="obrigatorio"]').val() == 1 ? 'Sim' : 'Não'));

        } else {
            var $linha = $('<tr></tr>').attr({'data-id':data.id,'id':'grid-campo-id-'+data.id}),
                url_destroy = ENDERECO+'/admin/evento/perfil-campo-destroy/'+data.id;

            $linha.append('<td class="move-line"><i class="fa fa-bars"></i></td>');
            $linha.append('<td class="grid-campo-campo">' + $(this).find('[name="campo"]').val() + '</td>');
            $linha.append('<td class="grid-campo-tipo">' + $(this).find('[name="campo_tipo_id"] option:selected').text() + '</td>');
            $linha.append('<td class="grid-campo-obrigatorio">' + ($(this).find('[name="obrigatorio"]').val() == 1 ? 'Sim' : 'Não') + '</td>');
            $linha.append('<td>' +
                '<a href="#Configurar-Campo" class="btn btn-default fa fa-cog" data-toggle="tooltip" data-placement="top" title="Configurar Campo"></a>' +
                '<a href="#Remover-Campo" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="' + url_destroy + '" data-toggle="tooltip" data-placement="top" title="Remover Campo"></a>' +
                '</td>');

            $('.tab-container #tab-' + grupoId + ' .grid-perguntas tbody td.nenhum-item').remove();
            $('.tab-container #tab-' + grupoId + ' .grid-perguntas tbody').append($linha);
        }

        $(this)[0].reset();
        $('[name="campo_tipo_id"]').trigger('change');
        $('button[data-in="#listagem-perguntas"]').trigger('click');
    });

	$(document).on('click', '.grid-evento-perfis a[href="#Gerenciar-Campos"]',function(){
		var $linha = $(this).closest('tr');

		$('form#perfil-campos [name="evento_perfil_id"]').val($linha.attr('data-id'));

		$.ajax({
            url: ENDERECO+'/admin/evento/perfil-campos-list/'+$linha.attr('data-id'),
            type:'POST',
            dataType:'json',
            data: {}
        }).done(function(retorno){
            
            if(retorno.status == 1){
                $('#modal-perguntas').attr('evento-perfil-id', $linha.attr('data-id')).modal();

                $('.grid-perguntas tbody tr').remove();
                $('ul.tab-perfil-grupos li[role="presentation"], #listagem-perguntas .tab-pane').remove();

                if (retorno.grupos.length) {
                    var $ul = $('<ul></ul>');
                    $.each(retorno.grupos, function(k, grupo){
                        var $a = $('<a></a>').attr({
                            'href': '#tab-'+grupo.id,
                            'aria-controls': 'home',
                            'role': 'tab',
                            'data-toggle': 'tab',
                            'data-id': grupo.id
                        }).html(grupo.titulo);

                        var $li = $('<li></li>')
                            .attr({'role': 'presentation', 'id': 'tab-grupo-id-'+grupo.id})
                            .html($a);

                        $ul.append($li);

                        $('ul.tab-perfil-grupos').closest('.tab-container').find('.tab-content').append(
                            '<div role="tabpanel" class="tab-pane" id="tab-'+grupo.id+'">'+
                                '<div class="col-xs-12">'+
                                    '<div class="table-responsive">'+
                                        '<table class="table table-hover table-sortable grid-perguntas">'+
                                            '<thead>'+
                                                '<tr>'+
                                                    '<th class="move-line"><i class="hide fa fa-arrows"></i></th>'+
                                                    '<th>Título</th>'+
                                                    '<th>Tipo</th>'+
                                                    '<th>Obrigatório</th>'+
                                                    '<th class="grid-acoes">Ações</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                            '<tbody>'+
                                                '<tr><td class="nenhum-item" colspan="5">Nenhum campo adicionado para o grupo '+grupo.titulo+'.</td></tr>'+
                                            '</tbody>'+
                                        '</table>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="clearfix"></div>'+
                            '</div>'
                        );

                        sortable($('ul.tab-perfil-grupos').closest('.tab-container').find('.tab-content .table-sortable'));
                    });

                    $('ul.tab-perfil-grupos').prepend($ul.find('li'));
                    $('ul.tab-perfil-grupos li').first().tab('show');
                    $('.tab-container #tab-'+$('ul.tab-perfil-grupos li.active a').attr('data-id')).addClass('active');
                }

                if(retorno.campos.length){

                    $.each(retorno.campos,function(k, campo){
                        var $linha = $('<tr></tr>').attr({'data-id':campo.id,'id':'grid-campo-id-'+campo.id}),
                            url_destroy = ENDERECO+'/admin/evento/perfil-campo-destroy/'+campo.id;

                        $linha.append('<td class="move-line"><i class="fa fa-bars"></i></td>');
                        $linha.append('<td class="grid-campo-campo">'+campo.campo+'</td>');
                        $linha.append('<td class="grid-campo-tipo">'+campo.tipo+'</td>');
                        $linha.append('<td class="grid-campo-obrigatorio">'+(campo.obrigatorio == 1 ? 'Sim' : 'Não')+'</td>');
                        $linha.append('<td>'+
                                        '<a href="#Configurar-Campo" class="btn btn-default fa fa-cog" data-toggle="tooltip" data-placement="top" title="Configurar Campo"></a>'+
                                        '<a href="#Remover-Campo" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Campo"></a>'+
                                    '</td>');

                        $('#tab-'+campo.evento_perfil_grupo_id+' .grid-perguntas tbody').append($linha);

                        //adiciona os campos da lista no formulario
                        $('form#campo-condicoes [name="dependente_campo_id"]').append(
                            $('<option></option>').val(campo.id).html(campo.campo)
                        );

                        $('#tab-'+campo.evento_perfil_grupo_id+' .grid-perguntas .nenhum-item').remove();
                    });
                }

            }
        }).fail(function(xhr){
            Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
        }).always(function(){
        });
	});

	$('button.btn-add-pergunta').on('click',function(){
		$('form#perfil-campos')[0].reset();
        $('form#perfil-campos [name="id"]').val("");
        $('form#perfil-campos [name="campo_tipo_id"]').trigger('change');
		$('.grid-perguntas-alternativas tbody tr:not(.linha-add-alternativa)').remove();
	});

	$(document).on('click','.grid-perguntas a[href="#Configurar-Campo"]',function(){
		var $linha = $(this).closest('tr');

		$.ajax({
            url: ENDERECO+'/admin/evento/perfil-campo-edit/'+$linha.attr('data-id'),
            type:'POST',
            dataType:'json',
            data: {}
        }).done(function(retorno){
            if(retorno.status == 1){
            	$('button.btn-add-pergunta').trigger('click');

            	$.each(retorno.campo,function(campo, valor){
                    $('form#perfil-campos').find('[name="'+campo+'"]').val(valor).trigger('change');
                });

                $('.grid-perguntas-condicoes tbody tr').remove();

            	if(retorno.alternativas.length){
                    var linhasAlternativas;
            		$.each(retorno.alternativas,function(k, alternativa){
            			linhasAlternativas +=
	            			'<tr>'+
								'<td class="move-line"><i class="fa fa-bars"></i></td>'+
				                '<td>'+alternativa.alternativa+'</td>'+
				                '<td>'+
				                    '<a href="#Remover-Alternativa" class="btn btn-default fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Remover Alternativa"></a>'+
				                '</td>'+
							'</tr>';
            		});

                    $('.grid-perguntas-alternativas').prepend(linhasAlternativas);
            	}

                if(retorno.condicoes.length){

                    var $formCondicao = $('form#campo-condicoes');

                    $.each(retorno.condicoes,function(k, condicao){
                       
                         var $linha = $('<tr></tr>').attr('data-id',condicao.id),
                            url_destroy = ENDERECO+'/admin/evento/campo-condicoes-destroy/'+condicao.id;

                        $linha.append('<td>'+$formCondicao.find('[name="dependente_campo_id"] option[value='+condicao.dependente_campo_id+']').text()+'</td>');
                        $linha.append('<td>'+$formCondicao.find('[name="condicao"] option[value="'+condicao.condicao+'"]').text()+'</td>');
                        $linha.append('<td>'+condicao.valor+'</td>');

                        $linha.append('<td>'+
                                        '<a href="#Remover-Condicao" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Condição"></a>'+
                                    '</td>');

                        $('.grid-perguntas-condicoes tbody td.nenhum-item').remove();
                        $('.grid-perguntas-condicoes tbody').append($linha);
                    });
                }else
                    $('.grid-perguntas-condicoes tbody').html(
                        $('<tr></tr>').addClass('nenhum-item').html('<td colspan="5">Nenhuma condição adicionada.</td>')
                    );


            }
        }).fail(function(xhr){
            Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
        }).always(function(){
        });
	});

	$('[name="campo_tipo_id"]').on('change',function(){
		var valor = parseInt($(this).val());
		if(valor == 6 || valor == 7 || valor == 8)
			$('.grid-perguntas-alternativas').parent().slideDown(300);
		else
			$('.grid-perguntas-alternativas').parent().slideUp(300);
	});

	$('.btn-add-pergunta-alternativa').on('click',function(){
		$(this).html('<input name="campo_alternativa" class="input-sm form-control" type="text" />');
		$(this).find('input').trigger('focus');
	});

	$(document).on('blur','[name="campo_alternativa"]',function(){
		var valor = $(this).val();

		if(valor != ''){
			$(this).closest('tr').before(
				'<tr>'+
					'<td class="move-line"><i class="fa fa-bars"></i></td>'+
	                '<td>'+valor+'</td>'+
	                '<td>'+
	                    '<a href="#Remover-Alternativa" class="btn btn-default fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Remover Alternativa"></a>'+
	                '</td>'+
				'</tr>'
			);
		}

		$(this).closest('td').html('<i class="glyphicon glyphicon-plus"></i> Adicionar alternativa');
	});

	$(document).on('click','.grid-perguntas-alternativas a[href="#Remover-Alternativa"]',function(e){
    	if(window.confirm('Tem certeza que deseja excluir a alternativa?')){
            var $linha = $(this).closest('tr');
            $linha.fadeOut(300,function(){
            	$linha.remove();
            });
        }
    });

    $('button.btn-add-pergunta-condicao').on('click',function(){
    	var campo = $('form#perfil-campos [name="campo"]').val(),
            id = $('form#perfil-campos [name="id"]').val();

        $('fieldset#adicionar-condicao legend').html('Condições: '+campo);
        $('form#campo-condicoes [name="campo_id"]').val(id);

    });

    //FORMULÁRIO
    $('form#campo-condicoes').on('submit',function(e){
        e.preventDefault();
        var $form = $(this),
            data = $form.serialize();

        $form.trigger('xhr',{fields:data});
    });
    
    $('form#campo-condicoes').on('saved',function(event,data){
        var $linha = $('<tr></tr>').attr('data-id',data.id),
            url_destroy = ENDERECO+'/admin/evento/campo-condicoes-destroy/'+data.id;

        $linha.append('<td>'+$(this).find('[name="dependente_campo_id"] option:selected').text()+'</td>');
        $linha.append('<td>'+$(this).find('[name="condicao"] option:selected').text()+'</td>');
        $linha.append('<td>'+$(this).find('[name="valor"]').val()+'</td>');

        $linha.append('<td>'+
                        '<a href="#Remover-Condicao" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Condição"></a>'+
                    '</td>');

        $('.grid-perguntas-condicoes tbody td.nenhum-item').remove();
        $('.grid-perguntas-condicoes tbody').append($linha);

        $(this)[0].reset();
    });


    
    //
    $(document).on('click','a[href="#Habilitar-Campo"]', function(){
        var $habilitarCampo = $(this);
        if (!$(this).hasClass('btn-success')) {
            var grupoId = $('#modal-perguntas ul.tab-perfil-grupos li.active a[data-toggle="tab"]').attr('data-id');
            $.ajax({
                url: ENDERECO+'/admin/evento/campos-modelos-store',
                type:'POST',
                dataType:'json',
                data: {
                    evento_perfil_grupo_id: grupoId,
                    campo_tipo_id: $habilitarCampo.attr('data-campo-tipo-id'),
                    campo: $habilitarCampo.attr('data-campo'),
                    classe: $habilitarCampo.attr('data-classe'),
                    autocomplete: $habilitarCampo.attr('data-autocomplete'),
                    mascara: $habilitarCampo.attr('data-mascara'),
                    obrigatorio: $habilitarCampo.attr('data-obrigatorio'),
                    campo_modelo_id: $habilitarCampo.attr('data-campo-modelo-id'),
                    evento_perfil_id: $('#modal-perguntas').attr('evento-perfil-id')
                }
            }).done(function(data){
                if(data.status == 1){
                    $habilitarCampo.attr('data-campo-id', data.id).addClass('btn-success');

                    var $linha = $('<tr></tr>').attr({'data-id':data.id,'id':'grid-campo-id-'+data.id}),
                        url_destroy = ENDERECO+'/admin/evento/perfil-campo-destroy/'+data.id;

                    $linha.append('<td class="move-line"><i class="fa fa-bars"></i></td>');
                    $linha.append('<td class="grid-campo-campo">'+$habilitarCampo.attr('data-campo')+'</td>');
                    $linha.append('<td class="grid-campo-tipo">'+$habilitarCampo.closest('tr').find('td.grid-modelo-tipo').text()+'</td>');
                    $linha.append('<td class="grid-campo-obrigatorio">'+($habilitarCampo.attr('data-obrigatorio') == 1 ? 'Sim' : 'Não')+'</td>');
                    $linha.append('<td>'+
                                    '<a href="#Configurar-Campo" class="btn btn-default fa fa-cog" data-toggle="tooltip" data-placement="top" title="Configurar Campo"></a>'+
                                    '<a href="#Remover-Campo" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Campo"></a>'+
                                '</td>');

                    $('#tab-'+grupoId+' .grid-perguntas tbody td.nenhum-item').remove();
                    $('#tab-'+grupoId+' .grid-perguntas tbody').append($linha);
                }
            });
        } else {
            var $linha = $('.grid-perguntas tr[data-id="'+$habilitarCampo.attr('data-campo-id')+'"]');

            $.ajax({
                url: $linha.find('a.grid-xhr-destroy').attr('data-url'),
                type:'POST',
                dataType:'json',
                data: {}
            }).done(function(retorno){
                if(retorno.status == 1){
                    Notificar.sucesso(retorno.mensagem);
                    $linha.fadeOut(300,function(){
                        if($linha.closest('tbody').find('tr').length == 1){
                            var colspan = $linha.closest('table').find('thead th').length;
                            $linha.closest('tbody').html(
                                $('<tr></tr>').addClass('nenhum-item').html('<td colspan="'+colspan+'">Nenhum registro adicionado.</td>')
                            );
                        }else
                            $linha.remove();
                    });

                    $habilitarCampo.removeClass('btn-success');
                }
            }).fail(function(xhr){
                Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
            }).always(function(){
            });
        }
    });

    //
    $('.btn-selecionar-perguntas').on('click', function(){
        $.ajax({
            url: ENDERECO+'/admin/evento/campos-modelos-select',
            type:'POST',
            dataType:'json',
            data: {
                evento_perfil_id: $('#modal-perguntas').attr('evento-perfil-id')
            }
        }).done(function(retorno){
            
            $('.grid-perguntas-definidas tbody tr').remove();

            if(retorno.campos.length){
                var linhas;
                $.each(retorno.campos,function(k, linha){
                    linhas +=
                        '<tr>'+
                            '<td class="grid-modelo-campo">'+linha.campo+'</td>'+
                            '<td class="grid-modelo-tipo">'+linha.tipo+'</td>'+
                            '<td>'+(linha.obrigatorio ? 'Sim' : 'Não')+'</td>'+
                            '<td>'+
                                '<a data-campo-id="'+linha.campo_id+'"'+
                                    'data-campo-modelo-id="'+linha.id+'" ' +
                                    'data-campo-tipo-id="'+linha.campo_tipo_id+'" '+
                                    'data-mascara="'+linha.mascara+'" ' +
                                    'data-autocomplete="'+linha.autocomplete+'" ' +
                                    'data-classe="'+linha.classe+'" ' +
                                    'data-obrigatorio="'+linha.obrigatorio+'" ' +
                                    'data-campo="'+linha.campo+'" ' +
                                    'href="#Habilitar-Campo" ' +
                                    'class="'+(linha.campo_id != '' && linha.campo_id != null ? 'btn-success' : '')+' btn btn-default fa fa-check-circle-o" ' +
                                    'data-toggle="tooltip" ' +
                                    'data-placement="top" ' +
                                    'title="'+linha.campo+'"></a>'+
                            '</td>'+
                        '</tr>';
                });

                $('.grid-perguntas-definidas tbody').append(linhas);
            }
        });
    });
});