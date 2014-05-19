@extends('layout')

@section('header')
	<h1>
		Top {{ $currentRanklist->name }}
	</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-2">
			<ul class="nav nav-pills nav-stacked">
                <li class="disabled">
                    <a href="#">
                        Playstyle
                    </a>
                </li>
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
				@foreach($ranklistCategories as $ranklistCategory)
					<li class="disabled"><a href="#">{{ $ranklistCategory->name }}</a></li>
				
					@foreach($ranklistCategory->ranklists as $ranklist)
						<li class="{{ active_class($currentRanklist->id == $ranklist->id) }}">
                            <a href="{{ URL::route('home.ranklist', [$ranklist->stat, $mode]) }}">
                                {{ $ranklist->name }}
                            </a>
                        </li>
					@endforeach
				@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-md-10">
            {{ $ranks->links('pagination::simple') }}
			@yield('ranks')
		</div>
	</div>
@stop