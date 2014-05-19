@extends('layout')

@section('header')
	<h1>
		{{ $hero->name }}
		<small>
			Level {{ $hero->level }} {{ $hero->klass }}
		</small>
	</h1>
	<h2>
		{{ $hero->careerRegion->full_region }} {{ $hero->mode }} - {{ $hero->careerRegion->career->battletag }} <span class="paragon">({{ $hero->paragon_level }})</span>
	</h2>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li>
					<a href="{{ URL::route('hero.profile', $hero->blizzard_id) }}">Profile</a>
				</li>
				<li>
					<a href="{{ URL::route('hero.stats', $hero->blizzard_id) }}">Profile</a>
				</li>
				<li class="disabled">
					<a href="#">Heroes of {{ $hero->careerRegion->career->battletag }}</a>
				</li>
				@foreach($siblings as $sibling)
					<li>
						<a href="{{ URL::route('hero.profile', $sibling->blizzard_id) }}" class="{{ $sibling->klass }}">{{ $sibling->name }} {{ $sibling->level }}</a>
					</li>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-md-5">
			<h2>
				Ranks
			</h2>
			@if($hero->level == 70)

				<table class="table">
					@foreach($ranklistCategories as $ranklistCategory)
					<tr>
						<td>
							{{ $ranklistCategory->name }}
						</td>
					</tr>
						@foreach($ranklistCategory->ranklists as $ranklist)
							<tr>
								<td>
									{{ $ranklist->name }}
								</td>
								<td>
									{{ $hero->getRank($ranklist)->value }}
								</td>
								<td>
									#{{ $hero->getRank($ranklist)->rank }} (Top {{ round(100 / $total * $hero->getRank($ranklist)->rank) }}%)
								</td>
							</tr>
						@endforeach
					@endforeach
				</table>
			@else
				Only level 70 heroes will be ranked
			@endif
		</div>
		<div class="col-xs-12 col-md-5">
			<h2>
				Gear
			</h2>
			@foreach($hero->items as $item)
			<div class="well well-sm">{{ $item->name }}</div>
			@endforeach
		</div>
	</div>
@stop