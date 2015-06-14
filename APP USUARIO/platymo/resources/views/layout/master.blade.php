<!DOCTYPE html>
<html>
<head>
	<title>Platy.mo{{ ' - '.$title or '' }}</title>
	<!--  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/paper/bootstrap.min.css" rel="stylesheet"> !-->
	<link rel="stylesheet" href="/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/estilo.css">
</head>
<body>
	<div class="container-fluid banner">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-xs-6">
					<a href="/" class="a-banner">
						<h1 class="clearfix">
							<img src="/imgs/Logo.png" class="logo-img">
							<span class="h1-logo hidden-xs">Platy<span class="span-logo-rasp">.</span>Mo</span>
							 {!! '<small>'.$title.'</small>'!!}
						</h1>
					</a>
				</div>
				<div class="col-md-2 col-xs-6">
					<a href="/configuracion" class="btn btn-link configuracion">Configuración</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript" src="{!! URL::asset('js/script.js'); !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/jquery.js'); !!}"></script>
	<script type="text/javascript" src="{!! URL::asset('js/bootstrap.min.js'); !!}"></script>
	<!--
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	!-->
</body>
</html>