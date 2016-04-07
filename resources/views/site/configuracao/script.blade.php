<script type="text/javascript">
    var page = $("html, body");

    var marker,map, infowindow;
    function initMap() {

        var lat = '{{ $evento->gllpLatitude }}'; //$(cssID).find('[name="gllpLatitude"]').val(),
        lng = '{{ $evento->gllpLongitude }}'; //$(cssID).find('[name="gllpLongitude"]').val(),
        zoom = '{{ $evento->gllpZoom }}'; //$(cssID).find('[name="gllpZoom"]').val();

        lat = lat != '' ? lat : -19.9196218;
        lng = lng != '' ? lng : -43.9484353;
        zoom = parseInt(zoom) > 0 ? parseInt(zoom) : 12;

        var myLatLng = new google.maps.LatLng(lat,lng),
                myOptions = {
                    center: myLatLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    zoom: zoom,
                    scrollwheel: false,
                    mapTypeControl: false,
                    disableDoubleClickZoom: true,
                    zoomControlOptions: true,
                    streetViewControl: false
                };

        map = new google.maps.Map(document.getElementById('map'),myOptions),
                marker = new google.maps.Marker({
                    map:map,
                    position: myLatLng,
                    draggable: true,
                    animation: google.maps.Animation.DROP
                }),
                infowindow = new google.maps.InfoWindow(),
                geocoder = new google.maps.Geocoder();
    }

</script>

@if (Route::getCurrentRoute()->getName() == 'site.inscricao' || Route::getCurrentRoute()->getName() == 'site.participant')
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
            var request;
            $('form.form-evento-participante').on('submit', function(e){
                e.preventDefault();
                var $perfil = $('[name="field-perfil"]:checked').clone(),
                    $id = $('[name="id"]').clone();

                $finish = 0;
                if ($('li[data-perfil]:visible:last').hasClass('active')) {
                    if ($(this).find('[name="finish"]').length == 0) {
                        $finish = $('<input/>').attr("name", "finish").val(1);
                        $finish.appendTo($(this));
                    } else {
                        $(this).find('[name="finish"]').val(0);
                    }
                }
                $perfil.appendTo($(this));
                $id.appendTo($(this));
                request = $.ajax({
                    url: ENDERECO + '/evento/store',
                    dataType: 'json',
                    type: 'post',
                    data: $(this).serialize()
                }).done(function(data) {
                    $('[name="id"]').val(data.participante_id);

                    if ($finish) {
                        $('#confirmacao-step').html(data.finish);
                    }
                });
                return false;
            });

            $groupsSteps = $('ul.groups-steps').clone();
            $('#tipo-inscricao [type="radio"]').on('change', function(){
                var valor = $(this).val();
                $ul = $('ul.groups-steps');
                $ul.find('li').not('.fixed-step').remove();
                $ul.find('.confirmation-step').before($groupsSteps.find('li[data-perfil='+ valor +']').clone());

                var percent = 100 / $ul.find('li').length;
                $ul.find('li').css('width', percent + '%');
                $('.wizard-card').data('bootstrapWizard').resetWizard();
            });

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
                $('.form-evento-participante select.' + k).val(v);
                $('.form-evento-participante input.' + k).val(v);
                $('.form-evento-participante textarea.' + k).val(v);
                $('.form-evento-participante select.' + k + ' option').each(function(){
                    var opt  = $(this).text().toLowerCase().trim(), valor = v, valInt = $(this).attr('value');
                    if (opt == valor.toLowerCase().trim()) {
                        $('.form-evento-participante select.' + k).val(valInt);
                        $(this).prop('selected',true);
                        return true;
                    }
                });
            });
        }
    </script>
@endif

@if (Route::getCurrentRoute()->getName() == 'site.inscricao')
    <script type="text/javascript">
        function formWizard()
        {
            $('.wizard-card').bootstrapWizard({
                'tabClass': 'nav nav-pills',
                'nextSelector': '.btn-next',
                'previousSelector': '.btn-previous',
                onInit : function(tab, navigation, index){
                    //check number of tabs and fill the entire row
                    var $total = navigation.find('li').length;
                    console.log($total, 'tes');
                    $width = 100/$total;
                    $display_width = $(document).width();

                    if($display_width < 600 && $total > 3){
                        $width = 50;
                    }
                    navigation.find('li').css('width',$width + '%');

                },
                onNext: function(tab, navigation, index){
                    if (!tab.is('.payment-step, .profile-step, .confirmation-step')) {
                        var id = tab.find('a').attr('href');
                        $('.tab-pane' + id).find('form').trigger('submit');
                    }
                    //validateFirstStep();
                },
                onTabClick : function(tab, navigation, index){
                    // Disable the posibility to click on tabs
                    return false;
                },
                onTabShow: function(tab, navigation, index) {
                    /*var page = $("html, body");
                    page.animate({ scrollTop: 435 }, 600, function(){
                        page.off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove");
                    });*/

                    var $total = navigation.find('li').length;
                    var $current = index+1;

                    var wizard = navigation.closest('.wizard-card');

                    // If it's the last tab then hide the last button and show the finish instead
                    if($current >= $total) {
                        $(wizard).find('.btn-next').hide();
                        $(wizard).find('.btn-finish').show();
                    } else {
                        $(wizard).find('.btn-next').show();
                        $(wizard).find('.btn-finish').hide();
                    }
                }

            });
        }

        $(document).ready(function(){
            $('#tipo-inscricao [type="radio"]').first().prop('checked', true).trigger('change');
        });
    </script>
@endif

@if (Route::getCurrentRoute()->getName() == 'site.participant')
    <script type="text/javascript">
        function formWizard()
        {
            $('.wizard-card').bootstrapWizard({
                'tabClass': 'nav nav-pills',
                'nextSelector': '.btn-next',
                'previousSelector': '.btn-previous',
                onInit : function(tab, navigation, index){
                    //check number of tabs and fill the entire row
                    var $total = navigation.find('li').length;
                    console.log($total, 'tes');
                    $width = 100/$total;
                    $display_width = $(document).width();

                    if($display_width < 600 && $total > 3){
                        $width = 50;
                    }
                    navigation.find('li').css('width',$width + '%');

                },
                onNext: function(tab, navigation, index){
                    if (!tab.is('.payment-step, .profile-step, .confirmation-step')) {
                        var id = tab.find('a').attr('href');
                        $('.tab-pane' + id).find('form').trigger('submit');
                    }
                    //validateFirstStep();
                },
                onTabClick : function(tab, navigation, index){
                    // Disable the posibility to click on tabs
                    //return false;
                },
                onTabShow: function(tab, navigation, index) {
                    /*var page = $("html, body");
                     page.animate({ scrollTop: 435 }, 600, function(){
                     page.off("scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove");
                     });*/

                    var $total = navigation.find('li').length;
                    var $current = index+1;

                    var wizard = navigation.closest('.wizard-card');

                    // If it's the last tab then hide the last button and show the finish instead
                    if($current >= $total) {
                        $(wizard).find('.btn-next').hide();
                        $(wizard).find('.btn-finish').show();
                    } else {
                        $(wizard).find('.btn-next').show();
                        $(wizard).find('.btn-finish').hide();
                    }
                }

            });
        }

        $(document).ready(function(){
            $('#tipo-inscricao [type="radio"]:checked').trigger('change');
        });
    </script>
@endif