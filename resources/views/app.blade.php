<!DOCTYPE html>
<html lang="pt_br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	{{--<link href="{{ asset('/css/app.compiled.css') }}" rel="stylesheet">--}}
    <link href="{{ elixir('css/app.compiled.css') }}" rel="stylesheet">

    {{--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />--}}

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	@include('partials.nav')

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

	<!-- Scripts -->
    <script src="{{ elixir('js/app.compiled.js') }}"></script>
	{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
	{{--<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}

    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>--}}

    <script>
        //$('div.alert').not('.alert-important').delay(3000).slideUp(300);
        $('#flash-overlay-modal').modal();
    </script>

    @yield('footer')
</body>
</html>
