/**
 * Created by jorgeluciojr on 05/04/16.
 */
$(document).ready(function() {
    $('form [name="evento"]').on('change', function(){
        window.location.href = ENDERECO + "/admin/lista-de-participantes/" + $(this).val();
    });
    var eventoId = document.getElementById('evento-select').getAttribute('value');
    $('form [name="evento"] option[value="' + eventoId + '"]').prop('selected', true);

    $(".bootgrid").bootgrid().on("loaded.rs.jquery.bootgrid", function (e) {
        $('.bootgrid tbody tr').each(function(){
            var $td = $(this).find('td:first');
            if ($td.hasClass('no-results')) {
                return false;
            }
            var id = $td.text();
            $td.html('<input type="checkbox" />');
            //editar
            $(this).find('td:last').append(
                $('<a></a>')
                    .attr({
                        'href': ENDERECO + '/admin/participante/' + id
                    })
                    .css({
                        'margin-right': '10px'
                    })
                    .addClass('btn btn-default btn-sm')
                    .html(
                        $('<i></i>').addClass('fa fa-cog')
                    ).tooltip({
                    'title': 'Editar participante'
                })
            );
            //excluir
            $(this).find('td:last').append(
                $('<a></a>')
                    .attr({
                        'href': ENDERECO + '/admin/participante/destroy/' + id
                    })
                    .css({
                        'margin-right': '10px'
                    })
                    .addClass('btn btn-default btn-sm')
                    .html(
                        $('<i></i>').addClass('glyphicon glyphicon-trash')
                    ).tooltip({
                    'title': 'Excluir participante'
                }).on('click', function(){
                    if (!confirm('Tem certeza que deseja excluir o participante')) {
                        return false;
                    }
                })
            );
            //emitir crachá
            $(this).find('td:last').append(
                $('<a></a>')
                    .attr({
                        'href': ENDERECO + '/admin/participante/credencial/' + id
                    })
                    .css({
                        'margin-right': '10px'
                    })
                    .addClass('btn btn-default btn-sm')
                    .html(
                        $('<i></i>').addClass('fa fa-barcode')
                    ).tooltip({
                    'title': 'Emitir crachá'
                })
            );
            //validar crachá
            $(this).find('td:last').append(
                $('<a></a>')
                    .attr({
                        'href': ENDERECO + '/admin/participante/credenciar/' + id
                    })
                    .addClass('btn btn-default btn-sm')
                    .html(
                        $('<i></i>').addClass('fa fa-check-square-o')
                    ).tooltip({
                        'title': 'Credenciar'
                    })
            );
        });
    });
});