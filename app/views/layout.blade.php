<!doctype html>
<html>
    <head>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    <link rel="stylesheet" type="text/css" title="dark" href="/css/lib/bootstrap/bootstrap-dark.css">
	    <link rel="stylesheet" type="text/css" title="dark" href="/css/lib/bootstrap/bootstrap-dark.css">
	    <link rel="alternate stylesheet" type="text/css" title="light" href="/css/lib/bootstrap/bootstrap-light.css">
		{{ HTML::style('css/bootstrap-extend.css') }}
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/colors.css') }}
	    {{ HTML::style('css/lib/fontawesome/font-awesome.min.css') }}

	    @yield('css')
    </head>
    <body>
	    <div class="container">
		    @include('partial.nav')

		    <div class="page-header">
			    @yield('header')
		    </div>

		    @yield('content')
	    </div>

	    {{ HTML::script('js/lib/jquery/jquery-2.1.0.js') }}
        {{ HTML::script('js/debug.js') }}

	    @yield('js')
        {{-- HTML::script('http://cssrefresh.frebsite.nl/js/cssrefresh.js') --}}
    </body>
</html>