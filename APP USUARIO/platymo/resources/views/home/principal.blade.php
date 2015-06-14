@extends('layout.master')

@section('content')
<div class="row">
<div class="col-md-5">

	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="h4-blanco">Información General</span>
			</div>
			<div class="panel-body">
				<span>Temperatura media    25</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="h4-blanco">Acciones Especiales</span>
			</div>
			<div class="panel-body">
				<a class="btn btn-default" href="/comando/apagar">Apagar todo</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="h4-blanco">Escenas</span>
			</div>
			<div class="panel-body">
				@foreach($escenas as $escena)
					<a class="btn btn-default" href="/comando/escena/{{ $escena->id }}">
						{{ $escena->nombre }}
					</a>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="h4-blanco">Acciones Periódicas</span>
			</div>
			<div class="panel-body">
				<ul class="list-group">
					@foreach($acciones as $accion)
					<li class="list-group-item">
						{{ $accion->nombre }}
						<span class="badge {{ ($accion->estado != 0)? 'badge-verde' : 'badge-rojo' }}">Hora {{ substr($accion->hora, 0, 5) }}</span>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="col-md-6 col-md-offset-1">

	@foreach($panel as $elemento)
		<div class="row">
			<div class="panel panel-default">
			<a class="a-sin-decoracion" href="vista/{{ $elemento['habitacion']->id }}">
				<div class="panel-heading">
					<h4>{{ $elemento['habitacion']->estancia }}</h4>
				</div>
			</a>
				<div class="panel-body">
					<ul class="list-group">
					@foreach ($elemento['actuadores'] as $actuador) 
						<li class="list-group-item clearfix">
							<span>{{ $actuador->nombre }}</span>
							<div class="btn-group pull-right">
								<a href="/comando/actuador/{{ $actuador->id }}/1"
								{!! ($actuador->estado > 0)? 'class="btn btn-success disabled"' : 'class="btn btn-default"' !!}">ON</a>
								<a href="/comando/actuador/{{ $actuador->id }}/0"  
								{!! ($actuador->estado > 0)? 'class="btn btn-default"' : 'class="btn btn-danger disabled"' !!}">OFF</a>
							</div>
						</li>
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	@endforeach
</div>

	
	

</div>
@stop