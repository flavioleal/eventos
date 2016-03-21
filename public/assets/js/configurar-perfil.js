$(document).ready(function(){
    
    //FORMLÁRIO DE DADOS DOS PERFIS DO EVENTO
    $('form#perfil-principal').on('submit',function(e){
        e.preventDefault();

        var $form = $(this),
            evento_id = $('form#form-evento [name="id"]').val(),
            data = $form.serialize();

        data += (evento_id != '') ? '&evento_id='+evento_id : '';

        $form.trigger('xhr',{fields:data});
    });

    //FORMULÁRIO DESCONTOS E GRUPOS DO PERFIL
    $('form#perfil-descontos').on('submit',function(e){
        e.preventDefault();
        $(this).find('.dropdown-menu-btn li.active').trigger('click');
        
        var $form = $(this),
            evento_id = $('form#form-evento [name="id"]').val(),
            evento_perfil_id = $('form#perfil-principal [name="id"]').val(),
            data = $form.serialize();

        data += (evento_id != '') ? '&evento_id='+evento_id : '';
        data += (evento_perfil_id != '') ? '&id='+evento_perfil_id : '';

        $form.trigger('xhr',{fields:data});
    });
    
    
    //FORMULÁRIO DOS CUPONS DE DESCONTO DOS PERFIS
    $('form#perfil-cupom-descontos').on('submit',function(e){
        e.preventDefault();
        $(this).find('.dropdown-menu-btn li.active').trigger('click');
        
        var $form = $(this),
            evento_perfil_id = $('form#perfil-principal [name="id"]').val(),
            data = $form.serialize();

        data += (evento_perfil_id != '') ? '&evento_perfil_id='+evento_perfil_id : '';

        $form.trigger('xhr',{fields:data});
    });
    
    //evento perfil - adiciona cupom de descontos
    $('form#perfil-cupom-descontos').on('saved',function(event,data){
        var $linha = $('<tr></tr>').attr('data-id',data.id),
            tipo = $(this).find('[name="valor_tipo"]').val(),
            valor = $(this).find('[name="valor"]').val(),
            url_destroy = ENDERECO+'/admin/evento/perfil-desconto-destroy/'+data.id;

        valor = tipo == 'R$' ? tipo+valor : valor+tipo;

        $linha.append('<td>'+data.codigo+'</td>');
        $linha.append('<td>'+valor+'</td>');
        $linha.append('<td>'+$(this).find('[name="data_inicio"]').val()+'</td>');
        $linha.append('<td>'+$(this).find('[name="data_fim"]').val()+'</td>');
        $linha.append('<td>'+
                        '<a href="#Remover-Desconto" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Desconto"></a>'+
                    '</td>');

        $('.grid-perfil-desconto tbody tr.nenhum-item').remove();
        $('.grid-perfil-desconto tbody').append($linha);

        $(this)[0].reset();
    });

    //evento perfil - adiciona perfil
    $('form#perfil-principal').on('saved',function(event,data){

        if($('.grid-evento-perfis tbody tr[data-id="'+data.id+'"]').length){
            var $linha = $('.grid-evento-perfis tbody tr[data-id="'+data.id+'"]'),
                url_destroy = ENDERECO+'/admin/evento/perfil-destroy/'+data.id;

            
            $linha.find('td.grid-campo-titulo').html($(this).find('[name="titulo"]').val());
            $linha.find('td.grid-campo-quantidade').html($(this).find('[name="quantidade"]').val());
            $linha.find('td.grid-campo-valor').html($(this).find('[name="valor"]').val());
            $linha.find('td.grid-campo-ativo').html(($(this).find('[name="ativo"]').val() == 1 ? 'Sim' : 'Não'));

        }else{
            var $linha = $('<tr></tr>').attr('data-id',data.id);

            $linha.append('<td class="grid-campo-titulo">'+$(this).find('[name="titulo"]').val()+'</td>');
            $linha.append('<td class="grid-campo-quantidade">'+$(this).find('[name="quantidade"]').val()+'</td>');
            $linha.append('<td class="grid-campo-valor">'+$(this).find('[name="valor"]').val()+'</td>');
            $linha.append('<td class="grid-campo-ativo">'+($(this).find('[name="ativo"]').val() == 1 ? 'Sim' : 'Não')+'</td>');
            $linha.append('<td>'+
                            '<a href="#Configurar-Perfil" data-target="#modal-perfil" class="btn btn-default fa fa-cog" data-toggle="tooltip" data-placement="top" title="Configurar Perfil"></a>'+
                            '<a href="#Gerenciar-Campos" data-target="#modal-perguntas" class="btn btn-default fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Gerenciar Campos"></a>'+
                            '<a href="#Remover-Perfil" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Perfil"></a>'+
                        '</td>');

            $('.grid-evento-perfis tbody tr.nenhum-item').remove();
            $('.grid-evento-perfis tbody').append($linha);
        }
    });

    //evento perfil - ação para visualizar edição do perfil
    $(document).on('click', '.grid-evento-perfis a[href="#Configurar-Perfil"]',function(){
        var $linha = $(this).closest('tr');
        
        $.ajax({
            url: ENDERECO+'/admin/evento/perfil-edit/'+$linha.attr('data-id'),
            type:'POST',
            dataType:'json',
            data: {}
        }).done(function(retorno){
            
            if(retorno.status == 1){
                //limpa formulário de definir descontos
                $('form#perfil-cupom-descontos')[0].reset();

                $('#modal-perfil').modal();

                $.each(retorno.evento_perfil,function(campo, valor){
                    $('form#perfil-principal,form#perfil-descontos').find('[name="'+campo+'"]').val(valor);

                    $('form#perfil-principal,form#perfil-descontos')
                        .find('[name="'+campo+'"]')
                        .closest('.input-group')
                            .find('.dropdown-menu-btn li:contains("'+valor+'")')
                            .trigger('click');
                });

                $('.grid-perfil-desconto tbody tr').remove();

                if(retorno.cupons_desconto.length){
                    $.each(retorno.cupons_desconto,function(k, cupom){
                        var $linha = $('<tr></tr>').attr('data-id',cupom.id),
                            tipo = cupom.valor_tipo,
                            valor = cupom.valor,
                            url_destroy = ENDERECO+'/admin/evento/perfil-desconto-destroy/'+cupom.id;

                        valor = tipo == 'R$' ? tipo+valor : valor+tipo;



                        $linha.append('<td>'+cupom.codigo+'</td>');
                        $linha.append('<td>'+valor+'</td>');
                        $linha.append('<td>'+cupom.data_inicio+'</td>');
                        $linha.append('<td>'+cupom.data_fim+'</td>');
                        $linha.append('<td>'+
                                        '<a href="#Remover-Desconto" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="'+url_destroy+'" data-toggle="tooltip" data-placement="top" title="Remover Desconto"></a>'+
                                    '</td>');

                        $('.grid-perfil-desconto tbody').append($linha);
                    });
                }else
                    $('.grid-perfil-desconto tbody').append(
                        $('<tr></tr>').addClass('nenhum-item').html('<td colspan="5">Nenhum cupom de desconto adicionado.</td>')
                    );

            }
        }).fail(function(xhr){
            Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
        }).always(function(){
        });
    });
});