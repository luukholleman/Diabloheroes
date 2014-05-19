<!doctype html>
<html>
    <head>
	    <meta name="viewport" content="width=device-width">
	    <link rel="stylesheet" type="text/css" title="dark" href="/css/lib/bootstrap/bootstrap-dark.css">
	    <link rel="alternate stylesheet" type="text/css" title="light" href="/css/lib/bootstrap/bootstrap-light.css">
		{{ HTML::style('css/bootstrap-extend.css') }}
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/colors.css') }}
		{{ HTML::style('css/lib/angular/loader-bar.css') }}
    </head>
    <body ng-app="App">
	    <div class="container">
		    @include('partials.nav')

		    <div class="page-header">
			    @yield('header')
		    </div>

		    @yield('content')
	    </div>

<!--	    {{ HTML::script('js/lib/jquery/jquery-2.1.0.js') }}-->
<!--	    {{ HTML::script('js/lib/underscore/underscore-1.6.0.js') }}-->
<!--		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>-->
<!--		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-route.min.js"></script>-->
<!--		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular-animate.js"></script>-->
<!--	    {{ HTML::script('js/lib/angular/ui-bootstrap.js') }}-->
<!--	    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/restangular/1.3.1/restangular.js"></script>-->
<!--	    {{ HTML::script('js/lib/angular/loader-bar.js') }}-->
<!--        {{ HTML::script('js/app.js') }}-->
<!--        {{-- HTML::script('js/angular/hero.js') --}}-->
<!--        {{-- HTML::script('js/style_switcher.js') --}}-->

        {{ HTML::script('js/debug.js') }}
        {{-- HTML::script('http://cssrefresh.frebsite.nl/js/cssrefresh.js') --}}
    </body>
</html>