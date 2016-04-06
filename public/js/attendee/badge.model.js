/**
 * Created by jorgeluciojr on 05/04/16.
 */
$(document).ready(function() {
    $( ".connectedSortable" ).sortable({
        connectWith: ".connectedSortable",
        dropOnEmpty: true
    }).disableSelection();
});