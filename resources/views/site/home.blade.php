@extends('site/evento')
@section('page')
<div class="row conteudo-entrada">
    <div class="col-sm-12">
        <h3 class="first-title">Sobre o evento</h3>
        <p>
            {!! $evento->descricao !!}
        </p>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('site.inscricao', ['slug' => $evento->slug]) }}"  class="btn-lg compumake-btn-orange compumake-btn btn-submit-xhr">Inscreva-se</a>
                <a href="{{ route('site.access', ['slug' => $evento->slug]) }}"  class="btn-lg compumake-btn-orange compumake-btn btn-submit-xhr">Já sou inscrito</a>
            </div>
        </div>
    </div>
</div>
@endsection