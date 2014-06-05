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

@section('sidebar')
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
@stop

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h2>
				Ranks
			</h2>
			@if($hero->level == 70)

				@foreach($ranklistCategories as $ranklistCategory)
					<table class="table table-condensed">
						<thead>
							<tr>
								<th colspan="3">
									{{ $ranklistCategory->name }}
								</th>
							</tr>
						</thead>
						@foreach($ranklistCategory->ranklists as $ranklist)
							<tr>
								<td class="col-xs-4">
									{{ $ranklist->name }}
								</td>
								<td class="col-xs-2">
									{{ $hero->getRank($ranklist)->value }}
								</td>
								<td>
									# {{ $hero->getRank($ranklist)->rank }} (Top {{ round(100 / $total * $hero->getRank($ranklist)->rank) }}%)
								</td>
							</tr>
						@endforeach
					</table>
				@endforeach
			@else
				Only level 70 heroes will be ranked
			@endif
		</div>
		<div class="col-xs-12 col-md-6">
			<h2>
				Gear
			</h2>
			<div class="row gear">
				@foreach($slots as $slot)
					<div class="col-xs-4">
						@if($slot != null)
							@if($hero->getItem($slot)->id != null)
								<div class="well well-sm">
									<a href="http://eu.battle.net/d3/en/{{ $hero->getItem($slot)->tooltip_params }}" onclick="return false">
										<img src="http://media.blizzard.com/d3/icons/items/large/{{ $hero->getItem($slot)->icon }}.png">
										<br />
										{{ $hero->getItem($slot)->name; }}
									</a>
								</div>
							@else
								<div class="well well-sm">
									Empty
								</div>
							@endif
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<h2>Active Skills</h2>
			<ul>
				@foreach($hero->skillActives as $skillActive)
				<li>
					{{ $skillActive->skillActive->name }}
					@if($skillActive->hasRune())
					({{ $skillActive->rune->name }})
					@endif
				</li>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<h2>Passive Skills</h2>
			<ul>
				@foreach($hero->skillPassives as $skillPassive)
					<li>
						{{ $skillPassive->skillPassive->name }}
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@stop