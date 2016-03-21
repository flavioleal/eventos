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

	{!! Form::open(['route'=>'area.store']) !!}
	{!! Form::hidden('acao','adicionar')  !!}
	<!-- Cód JOB Form input -->
	<div class="row">
		
		<!-- Área Form input -->
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('area','Área: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-education"></span>
					</div>
					{!! Form::text('area',null,['class'=>'form-control obrigatorio']) !!}
				</div>
			</div>
		</div>

		<!-- Ativo Form input -->
		<div class="col-md-12">
			<div class="form-group">
				{!! Form::label('ativo','Ativo: ',['class'=>'obrigatorio']) !!}
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-off"></span>
					</div>
					{!! Form::select('ativo',[1=>'Sim',0=>'Não'],1,['class'=>'form-control obrigatorio']) !!}
				</div>
				
			</div>
		</div>
	</div>

	{!! Form::close() !!}
</div>