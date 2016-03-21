@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Listagem dos Gestores e Operadores
				<button data-modal="modal-cadastrar-operador" data-redirect="{{ route('operador') }}" data-href="{{ route('operador.create') }}" class="btn-cadastrar btn btn-primary pull-right btn-cadastrar-operador">
					<span class="glyphicon glyphicon-user"></span> Cadastrar Gestor/Operador
				</button>
			</h1>
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
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-hover grid">
			<thead>
				<tr>
					<th>Nome</th>
					<th>E-mail</th>
					<th>Data do Cadastro</th>
					<th>Situação</th>
					<th class="acoes">Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($operadores as $operador)
					<tr>
						<td>{{ $operador->name }}</td>
						<td>{{ $operador->email }}</td>
						<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $operador->created_at)->format('d/m/Y H:i:s') }}</td>
						
						<td>@if($operador->ativo == 1) Ativo @else Inativo @endif</td>
						<td>
							<button data-modal="modal-cadastrar-operador" data-href="{{ route('operador.edit',['id'=>$operador->id]) }}" class="btn-editar btn-editar-operador btn btn-xs btn-default" title="Editar Gestor/Operador" data-toggle="tooltip" data-placement="top">
								<span class="glyphicon glyphicon-pencil"></span>
							</button>
							@if($operador->ativo == 1)
							<button data-acao="bloquear" data-mensagem="Tem certeza que deseja bloquear o Gestor/Operador?" data-redirect="{{ route('operador') }}" data-excluir="{{ $operador->id }}" data-href="{{ route('operador.destroy',['id'=>$operador->id]) }}" class="btn-excluir btn-excluir-operador btn btn-xs btn-default" title="Bloquear Gestor/Operador" data-toggle="tooltip" data-placement="top">
								<span class="fa fa-lock"></span>
							</button>
							@else
							<button data-acao="desbloquear" data-mensagem="Tem certeza que deseja desbloquear o Gestor/Operador?" data-redirect="{{ route('operador') }}" data-excluir="{{ $operador->id }}" data-href="{{ route('operador.destroy',['id'=>$operador->id]) }}" class="btn-excluir btn-excluir-operador btn btn-xs btn-default" title="Desbloquear Gestor/Operador" data-toggle="tooltip" data-placement="top">
								<span class="fa fa-unlock"></span>
							</button>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection