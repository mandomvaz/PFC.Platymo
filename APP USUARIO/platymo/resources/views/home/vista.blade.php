@extends('layout.master')
@section('content')
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="h4-blanco">Escenas</span>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						@foreach($escenas as $escena)
							<li class="list-group-item clearfix">
								{{ $escena->nombre }}
								<a class="btn btn-default pull-right" href="/comando/escena/{{ $escena->id }}">Activar</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="h4-blanco">Acciones Periódicas</span>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						@foreach($acciones as $accion)
							<li class="list-group-item">
								{{ $accion['accion']->nombre }}
								<span class="badge {{ ($accion['accion']->estado != 0)? 'badge-verde' : 'badge-rojo' }}">Hora {!! substr($accion['accion']->hora, 0, 5)    !!}</span>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="row">
		<a href="/configuracion/habitacion/{{ $habitacion->id }}" class="btn btn-link">Configuración</a>
	</div>
		</div>
		<div class="col-md-6 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="h4-blanco">Actuadores</span>
				</div>	
				<div class="panel-body">
					<ul class="list-group">
						@foreach($actuadores as $actuador)
							<li class="list-group-item clearfix">{{ $actuador->nombre }}
								<div class="btn-group pull-right">
									<a href="/comando/actuador/{{ $actuador->id }}/1"
										{!! ($actuador->estado > 0)? 'class="btn btn-success disabled"' : 'class="btn btn-default"' !!}">ON
									</a>
									<a href="/comando/actuador/{{ $actuador->id }}/0"  
										{!! ($actuador->estado > 0)? 'class="btn btn-default"' : 'class="btn btn-danger disabled"' !!}">OFF
									</a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop