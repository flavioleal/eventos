<div class="modal-formulario">

	{!! Form::open(['route'=>['area.update',$form['area']['id']],'method'=>'put']) !!}
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
					{!! Form::text('area',$form['area']['area'],['class'=>'form-control obrigatorio']) !!}
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
					{!! Form::select(
							'ativo',
							[1=>'Sim',0=>'Não'],
							$form['area']['ativo'],
							['class'=>'form-control obrigatorio']
						)
					!!}
				</div>
				
			</div>
		</div>
	</div>

	{!! Form::close() !!}
</div>