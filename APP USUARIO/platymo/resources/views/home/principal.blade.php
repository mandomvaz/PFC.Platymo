@extends('layout.master')

@section('content')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Información General</h4>
			</div>
			<div class="panel-body">
				<span>Temperatura media    25</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Acciones Especiales</h4>
			</div>
			<div class="panel-body">
				<a class="btn btn-default">Apagar todo</a>
				<a class="btn btn-default">Simulacion de presencia</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Escenas</h4>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Acciones Periódicas</h4>
			</div>
			<div class="panel-body">
				
			</div>
		</div>
	</div>


	@foreach($panel as $elemento)
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>{{ $elemento['habitacion']->estancia }}</h4>
				</div>
				<div class="panel-body">
					@foreach ($elemento['actuadores'] as $actuador) 
						<span>{{ $actuador->nombre }}</span>
						<div class="btn-group">
							<a href="/comando/actuador/{{ $actuador->id }}/1"
							{!! ($actuador->estado > 0)? 'class="btn btn-default disabled"' : 'class="btn btn-success"' !!}">ON</a>
							<a href="/comando/actuador/{{ $actuador->id }}/0"  
							{!! ($actuador->estado > 0)? 'class="btn btn-danger"' : 'class="btn btn-default disabled"' !!}">OFF</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@endforeach

	


@stop