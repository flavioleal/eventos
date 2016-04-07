/**
 * Created by jorgeluciojr on 05/04/16.
 */
$(document).ready(function() {
    $( ".connectedSortable" ).sortable({
        connectWith: ".connectedSortable",
        dropOnEmpty: true
    }).disableSelection();


    $('.content-badge select').on('change', function(){
        var $credencialHtml = $('.content-badge').clone(),
            campo1 = $('select[name="campo1"]').val(),
            campo2 = $('select[name="campo2"]').val(),
            eventoId = $('[name="eventoId"]').val();

        var $h3 = $('<h3></h3>').html('%campo_' +campo1+ '%'),
            $h4 = $('<h4></h4>').html('%campo_' +campo2+ '%');

        $credencialHtml.find('select[name="campo1"]').replaceWith($h3);
        $credencialHtml.find('select[name="campo2"]').replaceWith($h4);
        $credencialHtml.find('img').remove();

        $.ajax({
            url: ENDERECO + '/admin/participante/armazenar-modelo-credencial',
            data: {
                evento: eventoId,
                //credencialHtml: $credencialHtml[0].outerHTML
                campos: [campo1, campo2]
            },
            dataType: 'json',
            type: 'post'
        }).done(function(data) {
            if (data.status == 1) {
                Notificar.sucesso(data.message);
            } else {
                Notificar.erro(data.message);
            }
        });
    });
});