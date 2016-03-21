<div class="modal-formulario">
	@if ($errors->any())
	<div class="row">
		<div class="col-md-12">
			<ul class="list-unstyled alert alert-danger">
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif

	{!! Form::open(['route'=>['operador.update',$operador['id']],'method'=>'put']) !!}
	{!! Form::hidden('user_id',$operador['id'])  !!}
	<!-- Cód JOB Form input -->
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('name','Nome: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					{!! Form::text('name',$operador['name'], ['class'=>'form-control obrigatorio'])  !!}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('email','E-mail: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						@
					</div>
					{!! Form::text('email',$operador['email'], ['class'=>'form-control obrigatorio'])  !!}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('senha','Senha: ') !!}
				<span data-toggle="tooltip" data-placement="right" title="Preencha esse campo somente se desejar alterar a senha" class="glyphicon glyphicon-info-sign"></span>
				
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-lock"></span>
					</div>
					{!! Form::password('password',['class'=>'form-control'])  !!}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('senha','Confirmar de Senha: ') !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-lock"></span>
					</div>
					{!! Form::password('password_confirmation',['class'=>'form-control'])  !!}
				</div>
			</div>
		</div>
	</div>

	<div class="row form-rodape">
		<div class="col-md-12">
			<span class="obrigatorio">Campos de preenchimento obrigatório</span>
		</div>
	</div>
	<div class="row hide">
		<div class="col-md-12">
			<!-- Form submit -->
			<div class="form-group">
				{!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
	</div>

	{!! Form::close() !!}
</div>
</form>