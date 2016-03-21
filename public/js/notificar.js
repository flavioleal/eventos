var Notificar = {
	tempo: 5000,
	timeOutMessages:null,
	fixaMensagem: function() {
        var r = 20;
        var t = $('section.topo').length ? $('section.topo').offset().top + 15 : $('header').height() + 15;
        $('#messages').css('right', r);
        $('#messages').css('top', t);
    },
	sucesso: function(msg, tempo){
		this.fixaMensagem();
		if(tempo) this.tempo = tempo;
		var template = 
			'<div class="alert alert-success">'
              	+'<button type="button" class="close"><span aria-hidden="true">×</span></button>'
              	+'<ul><li>'+msg+'</li></ul>'
            +'</div>';
        $('#messages').css('visibility','visible');
        $('#messages').addClass('animated').html(template);  
        $('#messages').removeClass('flipOutX').addClass('flipInX');
        this.after();
	},
	erro: function(msg){
		this.fixaMensagem();
		var template = 
			'<div class="alert alert-error">'
              	+'<button type="button" class="close"><span aria-hidden="true">×</span></button>'
              	+'<ul><li>'+msg+'</li></ul>'
            +'</div>';
        $('#messages').css('visibility','visible');
        $('#messages').addClass('animated').html(template);  
        $('#messages').removeClass('flipOutX').addClass('flipInX');
        this.after();
	},
	informacao: function(msg,tempo){
		this.fixaMensagem();
		if(tempo) this.tempo = tempo;
		var template = 
			'<div class="alert alert-info">'
              	+'<button type="button" class="close"><span aria-hidden="true">×</span></button>'
              	+'<ul><li>'+msg+'</li></ul>'
            +'</div>';
        $('#messages').css('visibility','visible');
        $('#messages').addClass('animated').html(template);  
        $('#messages').removeClass('flipOutX').addClass('flipInX');
        this.after();
	},
	after: function(){
		$('#messages button.close').unbind('click');
		$('#messages button.close').click(function() {
            $(this).closest('#messages').removeClass('flipInX').addClass('flipOutX');
        });
		var that = this;
		clearTimeout(that.timeOutMessages);
        if ($('#messages').find('.alert-success, .alert-info').length > 0) {
            that.timeOutMessages = setTimeout(function() {
                that.hide();
            }, this.tempo);

            $('#messages').hover(function() {
                clearTimeout(that.timeOutMessages);
            }, function() {
                that.timeOutMessages = setTimeout(function() {
                    that.hide();
                }, this.tempo);
            });
        }
	},
	hide: function(){
		$('#messages').removeClass('flipInX').addClass('flipOutX');
	}
}