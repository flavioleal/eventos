<img src="{{ $params['captchaBase64'] }}" /><br />

<form class="form-popover form-cnpj" action="" method="POST">
    <div class="form-group">
        <div class="input-group">
            <input class="input-sm form-control" type="text" name="captcha" placeholder="Informe os caracteres"/>
            <span class="input-group-addon btn btn-sm btn-primary btn-autocomplete-submit" data-classe="cnpj">Ok</i>
            </span>
        </div>
    </div>
    <input type="hidden" name="cookie" value="{{ $params['cookie'] }}" />
    <input style="margin:0; border: 0; background: #fff; font-size: 10px;" class="text-muted" type="text" readonly name="cnpj"/>
</form>