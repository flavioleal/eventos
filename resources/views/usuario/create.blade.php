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

	{!! Form::open(['route'=>'operador.store']) !!}
	{!! Form::hidden('acao','adicionar')  !!}
	<!-- Cód JOB Form input -->
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('name','Nome: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					{!! Form::text('name',null, ['class'=>'form-control obrigatorio'])  !!}
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
					{!! Form::text('email',null, ['class'=>'form-control obrigatorio'])  !!}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('senha','Senha: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-lock"></span>
					</div>
					{!! Form::password('password', ['class'=>'form-control obrigatorio'])  !!}
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('senha','Confirmar de Senha: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-lock"></span>
					</div>
					{!! Form::password('password_confirmation',['class'=>'form-control obrigatorio'])  !!}
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