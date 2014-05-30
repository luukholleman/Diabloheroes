@extends('layout')

@section('js')
	{{ HTML::script('js/home.js') }}
@stop

@section('header')
	<h1>
		Top {{ $currentRanklist->name }}
	</h1>
@stop

@section('sidebar')
<ul class="nav nav-pills nav-stacked">
	<li class="disabled">
		<a href="#" class="ranklist-filter">
			Playstyle
		</a>
	</li>
	<li class="{{ active_class($mode->isSoftcore()) }}">
		<a href="{{ URL::route('home.ranklist', [$currentRanklist->stat, 'softcore']) }}">
			Softcore
		</a>
	</li>
	<li class="{{ active_class($mode->isHardcore()) }}">
		<a href="{{ URL::route('home.ranklist', [$currentRanklist->stat, 'hardcore']) }}">
			Hardcore
		</a>
	</li>
	<li class="{{ active_class($mode->isBoth()) }}">
		<a href="{{ URL::route('home.ranklist', [$currentRanklist->stat, 'both']) }}">
			Both
		</a>
	</li>
	@foreach($ranklistCategories as $ranklistCategory)
		<li class="disabled">
			<a href="#" class="ranklist-filter">
				{{ $ranklistCategory->name }}
			</a>
		</li>
		@foreach($ranklistCategory->ranklists as $ranklist)
			<li class="{{ active_class($currentRanklist->id == $ranklist->id) }}">
				<a href="{{ URL::route('home.ranklist', [$ranklist->stat, $mode]) }}">
					{{ $ranklist->name }}
				</a>
			</li>
		@endforeach
	@endforeach
</ul>
@stop

@section('content')
			{{ $ranks->links('pagination::simple') }}

			@yield('ranks')

			{{ $ranks->links('pagination::simple') }}
@stop