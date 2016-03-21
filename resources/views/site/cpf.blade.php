<form class="form-popover form-cnpj" action="" method="POST">
    <img src="{{ $params['captchaBase64'] }}" />
    <div class="form-group">
        <input class="input-sm form-control" type="text" name="captcha" placeholder="Informe os caracteres"/>
    </div>
    <div class="form-group">
        <input class="input-sm form-control" type="text" name="dataNascimento" placeholder="Data de nascimento"/>
    </div>
    <input type="hidden" name="cookie" value="{{ $params['cookie'] }}" />
    <input style="margin:0; border: 0; background: #fff; font-size: 10px;" class="text-muted" type="text" readonly name="cpf"/>
    <button data-classe="cpf" class="btn-autocomplete-submit btn btn-sm btn-primary pull-right" style="margin:0 0 5px 0">Ok</button>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('[name="dataNascimento"]').datepicker({
            language: "pt-BR",
            autoclose: true,
            format: "dd/mm/yyyy"
        });
        $('[name="dataNascimento"]').mask('00/00/0000');
    });
</script>