<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row" style="border: 1px solid #eee; padding: 15px;">
            <div class="col-md-3">
                <img src="{{ route('evento.fileShow', ['id' => $evento->logo_arquivo_id,'tipo' => 'logo','ext' => $evento->logo_extensao]) }}" class="img-responsive">
            </div>
            <div class="col-md-9">
                <h2 class="text-center">Pré-Inscrição</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Login de acesso: <strong>{{ $usuario->email }}</strong><br>
                        Chave de acesso: <strong>{{ $participante->chave }}</strong></p>
                    <p class="text-muted">
                        Essa é uma confirmação da pré-inscrição no <strong>{{ $evento->titulo }}</strong>. <br>
                        @if ($perfil->exigir_pagamento == 1 && $perfil->valor > 0)
                            Após o pagamento, será enviado ao seu e-mail o comprovante de inscrição.
                        @else
                            O comprovante de inscrição foi enviado para o seu e-mail.
                        @endif
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <h4>Perfil de Inscrição</h4>
                    <p>{{ $perfil->titulo }}</p>
                </div>
                <div class="col-md-4">
                    <h4>Local do evento</h4>
                    <p>
                        {{ $evento->local }}<br>
                        {{ $evento->logradouro }}, {{ $evento->numero }} {{ $evento->complemento }}<br>
                        {{ $evento->bairro }} - {{ $evento->municipio }} / {{ $evento->uf }}
                    </p>
                </div>
                <div class="col-md-4">
                    <h4>Horário</h4>
                    <p>
                        <strong>Início</strong>: {{ $evento->getDataInicio() }}<br>
                        <strong>Término</strong>: {{ $evento->getDateFim() }}
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($grupos as $grupo)
                            <div class="col-md-6">
                                <h4>{{ $grupo['titulo'] }}</h4>
                                <p>
                                    @foreach($grupo['campos'] as $campo)
                                        <strong>{{ $campo['valor'] }}</strong>: {{ $campo['resposta'] }}<br>
                                    @endforeach
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>