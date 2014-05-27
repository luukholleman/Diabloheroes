@extends('layout')

@section('js')
	{{ HTML::script('js/home.js') }}
@stop

@section('header')
	<h1>
		Top {{ $currentRanklist->name }}
	</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-2">
			<h2>Filters</h2>
			<ul class="nav nav-pills nav-stacked">
                <li class="disabled">
                    <a href="#" class="ranklist-filter">
                        Playstyle <i class="fa fa-plus-square-o"></i>
                    </a>
	                <ul class="nav nav-pills nav-stacked {{ (Agent::isMobile()) ? 'hidden' : '' }}">
		                <li class="{{ active_class($mode == 'softcore') }}">
			                <a href="{{ URL::route('home.ranklist', [$currentRanklist->stat, 'softcore']) }}">
				                Softcore
			                </a>
		                </li>
		                <li class="{{ active_class($mode == 'hardcore') }}">
			                <a href="{{ URL::route('home.ranklist', [$currentRanklist->stat, 'hardcore']) }}">
				                Hardcore
			                </a>
		                </li>
		                <li class="{{ active_class($mode == 'both') }}">
			                <a href="{{ URL::route('home.ranklist', [$currentRanklist->stat, 'both']) }}">
				                Both
			                </a>
		                </li>
	                </ul>
                </li>
				@foreach($ranklistCategories as $ranklistCategory)
					<li class="disabled">
						<a href="#" class="ranklist-filter">
							{{ $ranklistCategory->name }} <i class="fa fa-plus-square-o"></i>
						</a>
						<ul class="nav nav-pills nav-stacked {{ (Agent::isMobile()) ? 'hidden' : '' }}"">
							@foreach($ranklistCategory->ranklists as $ranklist)
								<li class="{{ active_class($currentRanklist->id == $ranklist->id) }}">
									<a href="{{ URL::route('home.ranklist', [$ranklist->stat, $mode]) }}">
										{{ $ranklist->name }}
									</a>
								</li>
							@endforeach
						</ul>
					</li>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-sm-10">
			@if(Agent::isMobile())
				<a name="ranks"></a>
				{{ $ranks->fragment('ranks')->links('pagination::simple') }}
			@else
				{{ $ranks->links('pagination::simple') }}
			@endif

			@yield('ranks')

			@if(Agent::isMobile())
				<a name="ranks"></a>
				{{ $ranks->fragment('ranks')->links('pagination::simple') }}
			@else
				{{ $ranks->links('pagination::simple') }}
			@endif
		</div>
	</div>
@stop