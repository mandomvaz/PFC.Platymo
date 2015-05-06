<!DOCTYPE html>
<html>
<head>
	<title>Platy.mo</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.4/paper/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1>Platy.Mo</h1>
		</div>
	</div>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript" src="{!! URL::asset('js/script.js'); !!}"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>