@extends('layout.master')
@section('content')
	@if(Session::has('msg'))
		<div class="row">
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ Session::pull('msg', '') }}</strong>
			</div>
		</div>
	@endif
	@foreach($panel as $elemento)
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>{{ $elemento['habitacion']->estancia }}
						<a href="/configuracion/habitacion/{{ $elemento['habitacion']->id }}" class="btn btn-default">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
						<a href="/configuracion/habitacion/delete/{{ $elemento['habitacion']->id }}" class="btn btn-default">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-4">
						<h5 class="text-center">Actuadores</h5>
						<ul class="list-group">
						@foreach($elemento['actuadores'] as $actuador)
							<li class="list-group-item">{{ $actuador->nombre }}</li>
						@endforeach
						</ul>
						<a href="/configuracion/habitacion/{{ $elemento['habitacion']->id }}" class="btn btn-default">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					</div>
					<div class="col-md-4">
						<h5 class="text-center">Escenas</h5>
						<ul class="list-group">
							@foreach($elemento['escenas'] as $escena)
								<li class="list-group-item">{{ $escena->nombre }}
									<a href="/configuracion/escena/{{ $escena->id }}" class="align-right">
										<span class="badge"><span class="glyphicon glyphicon-edit"></span></span>
									</a>
									<a href="/configuracion/escena/delete/{{ $escena->id }}" class="align-right">
										<span class="badge"><span class="glyphicon glyphicon-trash"></span></span>
									</a>
								</li>
							@endforeach
						</ul>
						<a href="/configuracion/habitacion/escena/{{ $elemento['habitacion']->id }}" class="btn btn-default">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					</div>
					<div class="col-md-4">
						<h5 class="text-center">Acciones Programadas</h5>
						@foreach($elemento['acciones'] as $accion)
							<span>{{ $accion->nombre }}</span>
						@endforeach
						<a href="/configuracion/accion/{{ $elemento['habitacion']->id }}" class="btn btn-default">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	@endforeach
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4><a class="btn btn-default" href="/configuracion/habitacion">Nueva Habitación</a></h4>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body…</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	</div>
@stop