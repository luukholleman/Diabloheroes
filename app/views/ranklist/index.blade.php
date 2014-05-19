@extends('layout')

@section('header')
	<h1>
		{{ $ranklist->name }}
		<small>
			Ranklists
		</small>
	</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <a href=""
            <ul class="nav nav-pills nav-stacked">
                @foreach($ranklistCategories as $ranklistCategory)
                    <li class="disabled"><a href="#">{{ $ranklistCategory->name }}</a></li>

                    @foreach($ranklistCategory->ranklists as $ranklist)
                        <li><a href="{{ URL::route('ranklist.ranklist', $ranklist->stat) }}">{{ $ranklist->name }}</a></li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        <div class="col-xs-12 col-md-10">
            {{ $ranks->links() }}

            @yield('ranks')

            {{ $ranks->links() }}
        </div>
    </div>
@stop