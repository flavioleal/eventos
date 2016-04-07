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
            campo2 = $('select[name="campo2"]').val();

        $credencialHtml.find('select[name="campo1"]').replaceWith('%campo_' +campo1+ '%');
        $credencialHtml.find('select[name="campo2"]').replaceWith('%campo_' +campo2+ '%');

        $.ajax({
            url: ENDERECO + '/'
        }).done(function(data) {
            if (data.status == 1) {
                Notificar.sucesso(data.message);
            } else {
                Notificar.erro(data.message);
            }
        });
    });
});