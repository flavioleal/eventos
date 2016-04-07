function sortable($elem){
    $elem.sortable({
        items: 'tbody tr:not(.linha-add-alternativa)',
        stop : function(event,ui){
            var $table = $(this).closest('table');
            if($table.attr('data-url-ordenacao') != ''){
                $.ajax({
                    url: $table.closest('.tab-content').attr('data-url-ordenacao'),
                    type:'POST',
                    dataType:'json',
                    data: $(this).sortable('serialize')
                }).done(function(retorno){
                    if(retorno.status == 1){
                        Notificar.sucesso(retorno.mensagem);
                    }
                }).fail(function(xhr){
                    Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
                }).always(function(){
                    //
                });
            }
        }
    });
}

$(document).ready(function(){
	$('[data-target="#modal-perfil"]').on('click',function(e){
		e.preventDefault();
		var modal = $(this).attr('data-target');

		$(modal).find('form').each(function(){
			$(this)[0].reset();
		});

		$(modal).find('table.grid-table tbody').html(
			$('<tr></tr>').attr('colspan',5).html('Nenhum registro adicionado.').addClass('nenhum-item')
		);

		$(modal).modal();
	});

	$('#perfil-pagamento,#adicionar-pergunta,#adicionar-condicao,#selecionar-perguntas').addClass('animated slideOutLeft');

	$('.btn-modal-in,.btn-modal-out').on('click',function(e){
		e.preventDefault();

		var dataIn = $(this).attr('data-in'),
			dataOut = $(this).attr('data-out'),
			$that = $(this);

		if($(this).hasClass('btn-modal-in')){
			$(dataOut).removeClass('slideInRight modal-in').addClass('animated slideOutRight').fadeOut();
			$(dataIn).fadeIn().removeClass('slideOutLeft').addClass('animated slideInLeft modal-in');
		}else{
			$(dataOut).removeClass('slideInLeft modal-in').addClass('animated slideOutLeft').fadeOut();
			$(dataIn).fadeIn().removeClass('slideOutRight').addClass('animated slideInRight modal-in');
		}

		return false;
	});

    sortable($('table.table-sortable tbody'));

    $(function () {
        $("ul.nav-tabs.tab-perfil-grupos").sortable({
            tolerance: 'pointer',
            //revert: 'invalid',
            placeholder: '',
            forceHelperSize: true,
            cancel: '[contenteditable=true], .btn-add-grupo-perguntas',
            stop : function(event,ui){
                $.ajax({
                    url: ENDERECO+'/admin/evento/grupo-campos-order',
                    type:'POST',
                    dataType:'json',
                    data: $(this).sortable('serialize')
                }).done(function(retorno){
                    if(retorno.status == 1){
                        Notificar.sucesso(retorno.mensagem);
                    }
                }).fail(function(xhr){
                    Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
                }).always(function(){
                    //
                });
            }
        });
    });

    $(document).on('click', '.btn-remove-grupo-perguntas a', function(e){
        e.preventDefault();

        if (confirm('Tem certeza que deseja remover o grupo? Os campos também serão removidos.')) {
            var id = $(this).closest('.tab-container').find('.nav-tabs li.active a').attr('data-id'),
                $btn = $(this);
            $.ajax({
                url: ENDERECO+'/admin/evento/grupo-campos-destroy',
                type:'POST',
                dataType:'json',
                data: {
                    id: id
                }
            }).done(function(retorno){
                if(retorno.status == 1){
                    Notificar.sucesso(retorno.mensagem);
                    if ($btn.closest('.tab-container').find('.nav-tabs li.active a').attr('href') != '#tab-dados-pessoais') {
                        $btn.closest('.tab-container').find('.nav-tabs li.active').remove();
                        $btn.closest('.tab-container').find('.nav-tabs li a[data-toggle="tab"]').last().trigger('click');
                    }
                }
            }).fail(function(xhr){
                Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
            }).always(function(){
                //
            });

        }

        $(this).closest('.tab-container').find('.nav-tabs li a').trigger('blur').attr('contenteditable', false);
    });

    $(document).on('click', '.btn-add-grupo-perguntas a', function(e){
        $(this).html('');
        $(this).attr('contenteditable', true).trigger('focus');
    });

    function addGrupoPerguntas($btn)
    {
        if ($btn.text() != '') {
            var aba = $btn.text();

            var url = $btn.attr('data-url');
            $.ajax({
                url: url,
                type:'POST',
                dataType:'json',
                data: {
                    evento_perfil_id: $('#modal-perguntas').attr('evento-perfil-id'),
                    titulo: aba,
                    ordem: $(this).closest('ul').find('a[data-toggle="tab"]').length
                }
            }).done(function(retorno){
                if(retorno.status == 1){
                    Notificar.sucesso(retorno.mensagem);
                    var id = retorno.id;

                    $btn.parent().before('<li role="presentation" id="tab-grupo-id-'+id+'"><a data-id="'+id+'" href="#tab-'+id+'" aria-controls="home" role="tab" data-toggle="tab">'+aba+'</a></li>');
                    $btn.closest('.tab-container').find('.tab-content').append(
                        '<div role="tabpanel" class="tab-pane" id="tab-'+id+'">'+
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
                                            '<tr><td class="nenhum-item" colspan="5">Nenhum campo adicionado para o grupo '+aba+'.</td></tr>'+
                                        '</tbody>'+
                                    '</table>'+
                                '</div>'+
                            '</div>'+
                            '<div class="clearfix"></div>'+
                        '</div>'
                    );

                    sortable($btn.closest('.tab-container').find('.tab-content table-sortable'));

                    $btn.closest('.tab-container').find('a[href="#tab-'+id+'"]').trigger('click');

                }
            }).fail(function(xhr){
                Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
            }).always(function(){
                //
            });
        }

        $btn.html('<i class="glyphicon glyphicon-plus"></i>').attr('contenteditable', false);
    }
    $(document).on('blur', '.btn-add-grupo-perguntas a', function(){
        addGrupoPerguntas($(this));
    });

    $(document).on('keypress', '.btn-add-grupo-perguntas a', function(event){
        if (event.which == 13 || event.keyCode == 13) {
            event.preventDefault();
            addGrupoPerguntas($(this));
        }
    });

    $(document).on('dblclick', 'a[data-toggle="tab"]', function(){
        $(this).closest('.tab-container').find('.nav-tabs li a').trigger('blur').attr('contenteditable', false);
        $(this).attr('contenteditable', true).trigger('focus');
    });

    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(){
        $(this).closest('.tab-container').find('.nav-tabs li a').trigger('blur').attr('contenteditable', false);
    });

    $(document).on('hidden.bs.tab', '.nav-tabs li a', function(){
        $(this).trigger('blur').attr('contenteditable', false);
    });

	//dropdown de botoes
	$('.dropdown-menu-btn li').on('click',function(e){
		e.preventDefault();
		var valor = $(this).text();

		$(this).closest('ul').find('li').removeClass('active');
		$(this).addClass('active');
		$(this).closest('.input-group-btn').find('input[type="hidden"]').val(valor);
		$(this).closest('.input-group-btn').find('button.dropdown-toggle').html(valor).append('&nbsp;<span class="caret"></span>');
	});

	//ajax submit fomrularios
	$('.form-xhr').on('xhr',function(event,data){
        var $form = $(this),
        	$btn_submit = $form.find('button[type="submit"]');

        //desabilita botão de envio do formulário
        $btn_submit.attr('disabled',true); 

        $.ajax({
            url: $form.attr('action'),
            type:'POST',
            dataType:'json',
            data: data.fields
        }).done(function(retorno){
            if(retorno.status == 1){
                Notificar.sucesso(retorno.mensagem);

                if($form.find('[name="id"]').val() == ''){
                    $form.attr('data-acao','insert');
                    $form.find('[name="id"]').val(retorno.id);
                }else
                    $form.attr('data-acao','update');

                $form.trigger('saved',retorno);
                //$('.form-login').submit();
            }
        }).fail(function(xhr){
            $btn_submit.attr('disabled',false);

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
        	$btn_submit.attr('disabled',false);
        });
    });

    $(document).on('click','.grid-xhr-destroy',function(e){
    	if(window.confirm('Tem certeza que deseja excluir o registro?')){
            var $linha = $(this).closest('tr');
            $.ajax({
                url: $(this).attr('data-url'),
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
								$('<tr></tr>').addClass('nenhum-item')
                                    .html('<td colspan="'+colspan+'">Nenhum registro adicionado.</td>')
							);
                        }else
                        	$linha.remove();
                    });
                }
            }).fail(function(xhr){
                Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
            }).always(function(){
            });
        }
    });
	//FORMULÁRIO DE DADOS PRINCIPAIS DO EVENTOS
	$('form#form-evento').on('submit',function(e){
        e.preventDefault();
        var $form = $(this),
            evento_id = $('form#form-evento [name="id"]').val();

        if (false === $form.parsley().validate("wizard-step-1"))
            return false;

        if($form.find('.wysiwyg').length){
            //salva o campo wysiwyg
            tinyMCE.triggerSave();
        }
        var data = $form.serialize();
        $form.trigger('xhr',{fields:data});
    });
    //FORMULÁRIO DE DADOS PRINCIPAIS DO EVENTOS
    $('form#form-evento-design').on('submit',function(e){
        e.preventDefault();
        var evento_id = $('form#form-evento [name="id"]').val(),
            $form = $(this);

        $form.find('[name="id"]').val(evento_id);

        if (false === $form.parsley().validate("wizard-step-3"))
            return false;

        $form.trigger('xhr',{fields: $form.serialize()});
    });
});