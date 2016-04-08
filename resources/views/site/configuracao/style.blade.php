<style type="">
    h1{
        line-height: 90px;
        text-align: right;
        font-family: 'Source Sans Pro' !important;
        font-weight: 100;
        color: {{ $evento->cor_texto }} !important;
    }

    @if (!empty($evento->cor_predominante))
    .wizard-card.ct-wizard-orange .nav-pills > li.active a{
        background-color: {{ $evento->cor_predominante }} !important;
    }

    .panel-primary > .panel-heading {
        background-color: {{ $evento->cor_predominante }};
        border-color: {{ $evento->cor_predominante }} !important;
    }

    .panel-primary {
        border-color: {{ $evento->cor_predominante }} !important;
    }

    .compumake-btn:hover{
        background-color: {{ $evento->cor_predominante }};
    }

    .compumake-btn.active{
        background-color: {{ $evento->cor_predominante }};
    }

    .compumake-btn {
        border-color: {{ $evento->cor_predominante }};
        color: {{ $evento->cor_predominante }};
    }

    .pagina-interna-topo .container:after {
        border-color: {{ $evento->cor_predominante }};
    }

    .pagina-interna-conteudo > h3{
        color: {{ $evento->cor_predominante }};
    }
    @endif

    .pagina-interna-conteudo .conteudo-entrada > p,
    .pagina-interna-conteudo .conteudo-entrada > span{
        font-family: 'Source Sans Pro' !important;
        line-height: 18px !important;
        color: {{ $evento->cor_texto }} !important;
    }

    @if (!empty($evento->banner_arquivo_id))
    .pagina-interna-topo .container:after {
        top: 302px;
    }
    @else
    .pagina-interna-topo .container:after {
        top: 40px;
    }
    @endif

    .rodape{
        margin-top: 0px;
    }

    .compumake-btn{
        padding: 15px 30px;
        border-radius: 10px;
        font-size: 18px;
    }


    .tooltip-inner {
        background-color: {{ $evento->cor_predominante }} !important;
        color: #FFF !important;
    }


    .tooltip.top .tooltip-inner:after {
        border-top: 11px solid {{ $evento->cor_predominante }} !important;
    }
    .tooltip.bottom .tooltip-inner:after {
        border-bottom: 11px solid {{ $evento->cor_predominante }} !important;
    }
    .tooltip.left .tooltip-inner:after {
        border-left: 11px solid {{ $evento->cor_predominante }} !important;
    }
    .tooltip.right .tooltip-inner:after {
        border-right: 11px solid {{ $evento->cor_predominante }} !important;
    }

    label.error {
        position: absolute;
        right: 0px;
        bottom: -20px;
    }

    .sk-circle {
        min-width: 20px;
        min-height: 20px;
        position: relative;
    }
    .sk-circle .sk-child {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
    }

    .sk-circle .sk-child:before {
        content: '';
        display: block;
        margin: 0 auto;
        width: 15%;
        height: 15%;
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
    }
    .btn-primary .sk-circle .sk-child:before {
        background-color: #fff;
    }
    .sk-circle .sk-circle2 {
        -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
        transform: rotate(30deg); }
    .sk-circle .sk-circle3 {
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg); }
    .sk-circle .sk-circle4 {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg); }
    .sk-circle .sk-circle5 {
        -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
        transform: rotate(120deg); }
    .sk-circle .sk-circle6 {
        -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
        transform: rotate(150deg); }
    .sk-circle .sk-circle7 {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg); }
    .sk-circle .sk-circle8 {
        -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
        transform: rotate(210deg); }
    .sk-circle .sk-circle9 {
        -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
        transform: rotate(240deg); }
    .sk-circle .sk-circle10 {
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg); }
    .sk-circle .sk-circle11 {
        -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
        transform: rotate(300deg); }
    .sk-circle .sk-circle12 {
        -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
        transform: rotate(330deg); }
    .sk-circle .sk-circle2:before {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s; }
    .sk-circle .sk-circle3:before {
        -webkit-animation-delay: -1s;
        animation-delay: -1s; }
    .sk-circle .sk-circle4:before {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s; }
    .sk-circle .sk-circle5:before {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s; }
    .sk-circle .sk-circle6:before {
        -webkit-animation-delay: -0.7s;
        animation-delay: -0.7s; }
    .sk-circle .sk-circle7:before {
        -webkit-animation-delay: -0.6s;
        animation-delay: -0.6s; }
    .sk-circle .sk-circle8:before {
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s; }
    .sk-circle .sk-circle9:before {
        -webkit-animation-delay: -0.4s;
        animation-delay: -0.4s; }
    .sk-circle .sk-circle10:before {
        -webkit-animation-delay: -0.3s;
        animation-delay: -0.3s; }
    .sk-circle .sk-circle11:before {
        -webkit-animation-delay: -0.2s;
        animation-delay: -0.2s; }
    .sk-circle .sk-circle12:before {
        -webkit-animation-delay: -0.1s;
        animation-delay: -0.1s; }

    @-webkit-keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% {
              -webkit-transform: scale(1);
              transform: scale(1);
          }
    }

    @keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% {
              -webkit-transform: scale(1);
              transform: scale(1);
          }
    }

    @if (!empty($evento->banner_arquivo_id))
    .pagina-interna-topo {
        background-size: cover;
        height: 300px;
        background-image: url('{{ route('evento.fileShow', ['id' => $evento->banner_arquivo_id,'tipo' => 'banner','ext' => $evento->banner_extensao]) }}');
        background-color: {{ $evento->cor_predominante }} !important;
    }
    @endif
</style>