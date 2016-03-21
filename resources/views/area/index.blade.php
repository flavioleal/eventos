@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Listagem de Áreas

				<button data-modal="modal-cadastrar-area" data-href="{{ route('area.create') }}" class="btn btn-primary pull-right btn-cadastrar-area btn-cadastrar">
					<span class="glyphicon glyphicon-education"></span> Cadastrar Nova Área
				</button>
			</h1>
		</div>

		@if ($errors->any())
		<div class="col-md-12">
			<ul class="list-unstyled alert alert-danger">
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Área</th>
					<th>Ativo</th>
					<th>Profissionais Cadastrados</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($areas as $area)
					<tr>
						<td>{{ $area->area }}</td>
						<td><span class="@if($area->ativo ) glyphicon glyphicon-ok @else glyphicon glyphicon-ban-circle @endif"></span></td>
						<td>{{ $area->totalProfissionais }}</td>
						<td>
							<button data-modal="modal-cadastrar-area" data-redirect="{{ route('area') }}" data-href="{{ route('area.edit',['id'=>$area->id]) }}" class="btn-editar btn-editar-area btn btn-xs btn-default" title="Editar Área" data-toggle="tooltip" data-placement="top">
								<span class="glyphicon glyphicon-pencil"></span>
							</button>

							<button data-mensagem="Tem certaza que deseja excluir essa Área? Essa ação não poderá ser revertida." data-redirect="{{ route('area') }}" data-excluir="{{ $area->id }}" data-href="{{ route('area.destroy',['id'=>$area->id]) }}" class="btn-excluir btn-excluir-area btn btn-xs btn-default" title="Excluir Área" data-toggle="tooltip" data-placement="top">
								<span class="glyphicon glyphicon-trash"></span>
							</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<!-- Modal Área-->
<div class="modal fade modal-cadastrar" id="modal-cadastrar-area" tabindex="-1" role="dialog" aria-labelledby="modal-cadastrar-area-titulo">
	<div class="modal-dialog" role="document">
		<div class="modal-content formulario">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal-cadastrar-area-titulo">
					<span class="glyphicon glyphicon-education"></span> Cadastro de Área
				</h4>
			</div>
			<div class="modal-body">
				<div class="loader"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button data-redirect="{{ route('area') }}" type="button" class="btn btn-primary btn-modal-save">
					<span class="glyphicon glyphicon-floppy-save"></span> Salvar
				</button>
			</div>
		</div>
	</div>
</div>
@endsection