<!doctype html>
<html>
    <head>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		{{ HTML::style('css/style.css') }}
	    {{ HTML::style('css/offcanvas.css') }}
		{{ HTML::style('css/colors.css') }}
	    {{ HTML::style('css/lib/fontawesome/font-awesome.min.css') }}

	    @yield('css')
    </head>
    <body>
        @include('partial.nav')
	    <div class="container">
		    <div class="page-header">
			    @yield('header')
		    </div>
		    <div class="row row-offcanvas row-offcanvas-left">
			    <div class="col-xs-12 col-sm-3 col-md-2 sidebar-offcanvas">
				    @yield('sidebar')
			    </div>
			    <div class="col-xs-12 col-sm-9 col-md-10">

				    @yield('content')
			    </div>
		    </div>
	    </div>

	    {{ HTML::script('js/lib/jquery/jquery-2.1.0.js') }}
        {{ HTML::script('js/debug.js') }}
	    {{ HTML::script('js/offcanvas.js') }}

	    @yield('js')
        {{-- HTML::script('http://cssrefresh.frebsite.nl/js/cssrefresh.js') --}}
    </body>
</html>