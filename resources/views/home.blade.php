@extends('app')

@section('content')
<style type="text/css">
	
</style>
<div class="container">
	<h1>
		<span class="home-icone glyphicon glyphicon-th"></span>
		Home
		<a class="pull-right btn btn-md btn-primary btn-cadastrar-profissional">
			<span class="fa fa-calendar-check-o"></span>
			Cadastrar Evento
		</a>
	</h1>
	<div class="hide">
		<h1>Gráficos</h1>
		<div class="row">
			<div class="col-md-4">
				<select id="selecionar-area-grafico">
					<option>Selecine uma Área</option>
				</select>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<hr class="">
	<div id="home-info" class="row">
		<div  class="col-md-12">
			<p>
				<span class="home-info-number chart-total-profissional">21</span>
				<span class="home-info-text">eventos cadastrados(ativos)</span>
			</p>
			<p>
				<span class="home-info-number chart-profissional-expirando">386</span>
				<span class="home-info-text">média de participantes por evento</span>
			</p>
			<p>
				<span class="home-info-number chart-solicitacao-pendente">112</span>
				<span class="home-info-text">eventos concluídos</span>
			</p>
		</div>
	</div>
	<hr>

	<pre style="font-family:arial">
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempor eros at tortor placerat, eget luctus est aliquet. Sed nec vehicula nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi at luctus dolor. Phasellus accumsan dictum elit eu egestas. Duis leo massa, scelerisque nec orci pharetra, dignissim pretium mi. Praesent ut eros facilisis, ornare tellus eget, dapibus lorem. Etiam tortor nisi, lobortis id feugiat vel, aliquam sit amet orci. Integer tincidunt sit amet urna ac auctor. Vivamus posuere turpis quis metus maximus, eget consequat lacus efficitur. Fusce varius dolor a sollicitudin scelerisque. Etiam ac placerat ipsum, id cursus lacus. Sed vel turpis id magna consequat pharetra. Fusce eget velit egestas metus venenatis eleifend. Aliquam sagittis tempor venenatis.

	Aliquam suscipit fringilla dolor ac mollis. Proin nec ipsum et lacus faucibus imperdiet. Sed dapibus turpis sem, ut interdum tortor cursus et. Sed elementum a tortor at maximus. Cras vel ullamcorper nisi. Sed non felis et erat consectetur egestas eu ac massa. Morbi feugiat nibh metus, at cursus mi lacinia ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sapien eros, scelerisque id vulputate vel, sagittis eget est. Quisque tortor dolor, facilisis ut tristique imperdiet, posuere at metus. Vivamus tincidunt lacinia tellus. Maecenas a quam a orci eleifend pellentesque. Aenean sapien diam, finibus quis quam in, euismod tincidunt nulla. Morbi bibendum scelerisque leo et rhoncus.

	Nullam facilisis, lacus nec semper eleifend, purus lectus convallis nibh, sit amet aliquam lectus ante sit amet sapien. Nunc iaculis eu ipsum id ultricies. Curabitur gravida dictum nisl ut fringilla. Duis interdum sit amet sem non convallis. Praesent id purus laoreet ex accumsan tristique. Curabitur tincidunt vitae dui et mollis. Integer in neque pharetra, cursus nulla non, auctor felis. Nulla venenatis est sed lectus blandit, vel dignissim lacus sagittis. Nam commodo, urna sit amet commodo placerat, nisi lorem dignissim leo, non ultrices ipsum sem id elit.

	Phasellus congue ex sit amet justo ultrices finibus. Cras ac velit est. Praesent scelerisque enim mauris, in lobortis velit fringilla nec. Donec sollicitudin a urna id faucibus. Ut feugiat massa nec tellus suscipit hendrerit. Duis tempor convallis libero ut bibendum. Vestibulum et euismod purus. Cras auctor lacus vel nunc vehicula consequat. Curabitur sit amet ultricies nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquam quam at volutpat suscipit. Phasellus placerat diam in lorem sagittis, quis ornare orci vulputate. Praesent id orci odio.

	Integer congue, libero ut consectetur pretium, leo quam interdum nunc, venenatis sollicitudin libero eros vel risus. Curabitur pharetra fermentum posuere. Aliquam gravida at nibh ac eleifend. Suspendisse eu erat vitae erat consectetur lacinia. Fusce dolor tortor, scelerisque tempor ultrices a, rhoncus non massa. Donec sit amet purus ac odio mollis ultricies id id dui. Aenean mollis mauris nunc, et rhoncus neque dapibus vitae.


	</pre>
</div>
@endsection
