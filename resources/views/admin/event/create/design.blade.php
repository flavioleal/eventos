<fieldset>
    <legend class="width-full">Design</legend>
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4">
            <div    data-url="{{ array_key_exists('logo_arquivo_id', $form) && !empty($form['logo_arquivo_id']) ? route('evento.fileShow', ['tipo' => 'logo','ext' => $form['logo_extensao'],'id' => $form['logo_arquivo_id']]) : '' }}"
                    data-mime="{{ array_key_exists('logo_mime', $form) ? $form['logo_mime'] : '' }}"
                    data-size="{{ array_key_exists('logo_size', $form) ? $form['logo_size'] : '' }}"
                    data-name="{{ array_key_exists('logo_name', $form) ? $form['logo_name'] : '' }}"
                    data-id="{{ array_key_exists('logo_arquivo_id', $form) ? $form['logo_arquivo_id'] : '' }}"
                    class="form-group dropzone dropzone-logo" data-dropzone="logo" data-text='logo' data-msg='Escolha a logo do organizador.'>
                <input type="file" name="logo"/>
            </div>
        </div>
        <div class="col-md-8">
            <div    data-url="{{ array_key_exists('banner_arquivo_id', $form) && !empty($form['banner_arquivo_id']) ? route('evento.fileShow', ['tipo' => 'banner','ext' => $form['banner_extensao'],'id' => $form['banner_arquivo_id']]) : '' }}"
                    data-mime="{{ array_key_exists('banner_mime', $form) ? $form['banner_mime'] : '' }}"
                    data-size="{{ array_key_exists('banner_size', $form) ? $form['banner_size'] : '' }}"
                    data-name="{{ array_key_exists('banner_name', $form) ? $form['banner_name'] : '' }}"
                    data-id="{{ array_key_exists('banner_arquivo_id', $form) ? $form['banner_arquivo_id'] : '' }}"
                    class="form-group dropzone dropzone-banner" data-dropzone="banner" data-text='adicione uma imagem para o banner' data-msg='Escolha uma imagem que captura perfeitamente a ideia do seu evento.'>
                <input type="file" name="banner"/>
            </div>
        </div>
        <div class="col-md-12">
            <div    data-url="{{ array_key_exists('background_arquivo_id', $form) && !empty($form['background_arquivo_id']) ? route('evento.fileShow', ['tipo' => 'background','ext' => $form['bg_extensao'],'id' => $form['background_arquivo_id']]) : '' }}"
                    data-mime="{{ array_key_exists('bg_mime', $form) ? $form['bg_mime'] : '' }}"
                    data-size="{{ array_key_exists('bg_size', $form) ? $form['bg_size'] : '' }}"
                    data-name="{{ array_key_exists('bg_name', $form) ? $form['bg_name'] : '' }}"
                    data-id="{{ array_key_exists('background_arquivo_id', $form) ? $form['background_arquivo_id'] : '' }}"
                    class="form-group dropzone dropzone-background" data-dropzone="background" data-text='adicione uma imagem de fundo' data-msg='Escolha uma imagem para exibir no fundo da página.'>
                <input type="file" name="background"/>
            </div>
        </div>

        <form id="form-evento-design" action="{{ route('evento.designStore') }}"
              class="form-xhr" id="form-design" method="post" enctype="multipart/form-data"
              data-parsley-validate="true">
            <input name="id" value="{{ array_key_exists('id',$form) ? $form['id'] : ''}}" type="hidden">
            <div class="col-md-4">
                <div class="form-group block1">
                    <label>Cor dos textos</label>
                    <input  type="color" name="cor_texto" class="form-control"
                            value="{{ array_key_exists('cor_texto',$form) && !empty($form['cor_texto'])
                            ? $form['cor_texto']
                            : '#666666' }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group block1">
                    <label>Cor predominante</label>
                    <input  type="color" name="cor_predominante" class="form-control"
                            value="{{ array_key_exists('cor_predominante',$form) && !empty($form['cor_predominante'])  ? $form['cor_predominante'] : '#ff9300' }}"/>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group block1">
                    <label>Cor de fundo</label>
                    <input  type="color" name="cor_fundo" class="form-control"
                            value="{{ array_key_exists('cor_fundo',$form) && !empty($form['cor_fundo'])
                            ? $form['cor_fundo']
                            : '#005493' }}"/>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group block1">
                    <label>Facebook</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-facebook"></i>
                        </div>
                        <input  type="text" name="facebook" class="form-control"
                                value="{{ array_key_exists('facebook',$form) && !empty($form['facebook']) ? $form['facebook'] : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group block1">
                    <label>Twitter</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <input  type="text" name="twitter" class="form-control"
                                value="{{ array_key_exists('twitter',$form) && !empty($form['twitter']) ? $form['twitter'] : '' }}"/>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group block1">
                    <label>Youtube</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-youtube"></i>
                        </div>
                        <input type="text" name="youtube" class="form-control"  value="{{ array_key_exists('youtube',$form) ? $form['youtube'] : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 hide">
                <hr>
                <div class="form-group">
                    <button type="button" class="btn btn-lg btn-default pull-right">
                        <i class="fa fa-file-text"></i> Pré-Visualizar</button>
                </div>
            </div>
        </form>
    </div>
    <!-- end row -->
</fieldset>