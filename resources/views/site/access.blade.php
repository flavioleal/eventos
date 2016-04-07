@extends('site/evento')
@section('page')
<div class="row conteudo-entrada">
    <div class="col-sm-6">
        <h3 class="first-title">Área Restrita</h3>
        <form class="form" method="post" action="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="username">Login</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-user"></i>
                    </span>
                    <input id="username" name="username" class="form-control input-lg" type="text"/>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Chave</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-lock"></i>
                    </span>
                    <input id="password" name="password" class="form-control input-lg" type="password"/>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="compumake-btn-orange compumake-btn btn-submit-xhr">
                    <i class="glyphicon glyphicon-log-in"></i> Acessar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection