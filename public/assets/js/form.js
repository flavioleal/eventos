/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 1.8.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.8/admin/
*/
var handleDatepicker = function() {
        $(".datepicker-default").datepicker({
            todayHighlight: !0,
            format:'dd/mm/yyyy',
        }), $("#datepicker-inline").datepicker({
            todayHighlight: !0,
            format:'dd/mm/yyyy',
        }), $(".input-daterange").datepicker({
            todayHighlight: !0,
            format:'dd/mm/yyyy',
        }), $("#datepicker-disabled-past").datepicker({
            todayHighlight: !0,
            format:'dd/mm/yyyy',
        }), $("#datepicker-autoClose").datepicker({
            todayHighlight: !0,
            format:'dd/mm/yyyy',
            autoclose: !0
        })
    }
    handleFormTimePicker = function() {
        "use strict";
        $(".bootstrap-timepicker input").timepicker({
            showMeridian: false,
            //defaultTime: false
        });
    },
    handleFormWysihtml5 = function() {
        "use strict";
        $(".wysihtml5").wysihtml5()
    },
    handleFormTinyMCE = function(){
        "use strict";
        tinymce.init({
            selector: ".wysiwyg"
        });
    },
    handleFormDropzone = function(){
        "use strict";

        Dropzone.autoDiscover = false;
        
        var dropzoneClick = [],   
            dropzoneOptions = {
                dictDefaultMessage: "",
                maxFiles:1,
                url: 'upload',
                thumbnailWidth: 1000,
                thumbnailHeight: 200,
                addRemoveLinks: true,
                dictRemoveFileConfirmation:"Tem certeza que deseja remover a imagem?",
                dictRemoveFile:"Remover",
                headers: {
                    'X-CSRF-Token': CSRFTOKEN
                },
                sending: function(file, xhr, formData) {
                    // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
                    formData.append("tipo", $(this.element).attr('data-dropzone'));
                    formData.append("evento", $('form#form-evento [name="id"]').val()); // Laravel expect the token post value to be named _token by default
                },
                init:function(){
                    dropzoneClick[$(this.element).attr('data-dropzone')] = (this.listeners[1].events.click);
                    
                    if ($(this.element).attr('data-url') != '' && typeof $(this.element).attr('data-url') !== undefined) {
                
                        var file = { name: $(this.element).attr('data-name'), size: $(this.element).attr('data-size'), type: $(this.element).attr('data-mime') };

                        this.emit('addedfile', file);
                        this.createThumbnailFromUrl(file, $(this.element).attr('data-url'));
                        this.emit('complete', file);

                        $(this.element).addClass('dz-max-files-reached');
                    }

                    this.on("success", function(file, result) {
                        $(this.element).attr({
                            'data-id': result.id,
                            'data-extensao': result.extensao
                        });
                    });
                },
                enable:function($that){
                    $that.addClass('dz-clickable');
                    $that[0].addEventListener('click', dropzoneClick[$that.attr('data-dropzone')]);

                    var id = $that.attr('data-id'),
                        tipo = $that.find('[type="file"]').attr('name');

                    $.ajax({
                        url: ENDERECO+'/admin/evento/remover-arquivo',
                        type:'POST',
                        dataType:'json',
                        data: {
                            id: id,
                            extensao: $that.attr('data-extensao'),
                            tipo: tipo,
                            evento: $('form#form-evento [name="id"]').val()
                        }
                    }).done(function(retorno){
                        if(retorno.status == 1){
                            $that.removeAttr('data-id');
                            Notificar.sucesso(retorno.mensagem);
                        }
                    }).fail(function(xhr){
                        Notificar.erro('Não foi possível prosseguir! Tente novamente mais tarde.');
                    }).always(function(){
                    });
                },
                disable:function($that){
                    $that.removeClass('dz-clickable'); // remove cursor
                    $that[0].removeEventListener('click', dropzoneClick[$that.attr('data-dropzone')]);

                }
                //autoProcessQueue: false,
                //clickable: false
            },
            
            dropzoneBackground = new Dropzone(".dropzone-background", dropzoneOptions),
            dropzoneBanner = new Dropzone(".dropzone-banner", dropzoneOptions),
            dropzoneLogo = new Dropzone(".dropzone-logo", dropzoneOptions);

        //background
        dropzoneBackground.on('maxfilesreached', function() {dropzoneOptions.disable($(this.element));});
        dropzoneBackground.on("removedfile", function(file) {dropzoneOptions.enable($(this.element));});

        //banner
        dropzoneBanner.on('maxfilesreached', function() {dropzoneOptions.disable($(this.element));});
        dropzoneBanner.on("removedfile", function(file) {dropzoneOptions.enable($(this.element));});

        //logo
        dropzoneLogo.on('maxfilesreached', function() {dropzoneOptions.disable($(this.element));});
        dropzoneLogo.on("removedfile", function(file) {dropzoneOptions.enable($(this.element));});  
    },

    handleSelected = function(){
        "use strict";
        var selectedField = ['evento_categoria_id','evento_tipo_id','dia_inteiro'];

        $.each(selectedField,function(k,campo){
            var v = $('select[name="'+campo+'"]').attr('data-value');
            $('select[name="'+campo+'"]').find('option[value="'+v+'"]').prop('selected',true);
        });
    },
    FormPlugins = function() {
        "use strict";
        return {
            init: function() {
                handleDatepicker(),
                handleFormTimePicker(),
                handleFormTinyMCE(),
                handleFormDropzone(),
                handleSelected()
            }
        }
    }();