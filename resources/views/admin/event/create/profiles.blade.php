<fieldset>
    <legend class="pull-left width-full">Perfis Pré-definidos</legend>
    <!-- begin row -->
    <div class="row">
        <div class="col-md-3">
            <div class="hero-widget well well-sm">
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <div class="text">
                    <label class="text-muted">Novo Perfil</label>
                </div>
                <div class="options">
                    <a href="#" class="btn btn-primary btn-lg" data-target="#modal-perfil"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="hero-widget well well-sm">
                <div class="icon">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <div class="text">
                    <label class="text-muted">Estudante</label>
                </div>
                <div class="options">
                    <a href="#" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i> Selecionar</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="hero-widget well well-sm">
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <div class="text">
                    <label class="text-muted">Profissional</label>
                </div>
                <div class="options">
                    <a href="#" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i> Selecionar</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="hero-widget well well-sm">
                <div class="icon">
                    <i class="fa fa-building-o"></i>
                </div>
                <div class="text">
                    <label class="text-muted">Empresa</label>
                </div>
                <div class="options">
                    <a href="#" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i> Selecionar</a>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Perfis Selecionados</legend>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover grid-table grid-perfil grid-evento-perfis">
                    <thead>
                    <tr>
                        <th>Perfil</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Ativo</th>
                        <th class="grid-acoes">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evento_perfil as $perfil)
                        <tr data-id="{{ $perfil['id'] }}">
                            <td class="grid-campo-titulo">{{ $perfil['titulo'] }}</td>
                            <td class="grid-campo-quantidade">{{ $perfil['quantidade'] }}</td>
                            <td class="grid-campo-valor">R$ {{ $perfil['valor'] }}</td>
                            <td class="grid-campo-ativo">@if($perfil['ativo'] == 1) Sim @else Não @endif</td>
                            <td class="grid-acao">
                                <a href="#Configurar-Perfil" class="btn btn-default fa fa-cog" data-toggle="tooltip" data-placement="top" title="Configurar Perfil"></a>
                                <a href="#Gerenciar-Campos" data-target="#modal-perguntas" class="btn btn-default fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Gerenciar Campos"></a>
                                <a href="#Remover-Perfil" class="btn btn-default fa fa-trash-o grid-xhr-destroy" data-url="{{ url() }}/admin/evento/perfil-destroy/{{ $perfil['id'] }}" data-toggle="tooltip" data-placement="top" title="Remover Perfil"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->
</fieldset>

@include('admin.event.create.profiles.new')
@include('admin.event.create.fields.new')