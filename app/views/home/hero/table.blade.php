<table class="table">
	<thead>
	<tr>
        <th>
           <span class="hidden-xs">
	           Rank
           </span>
        </th>
        <th>
            Name
        </th>
        <th>
            Paragon
        </th>
        <th class="hidden-xs">
            Class
        </th>
        <th class="hidden-xs">
            Battletag
        </th>
        <th>
            Value
        </th>
	</tr>
	</thead>
	@foreach($ranks as $index => $rank)
		<tr>
			<td class="col-xs-1">
				#{{ $index + $rankMultiplier }}
			</td>
			<td class="col-xs-2">
				<a href="{{ URL::route('hero.profile', $rank->rankable->blizzard_id) }}">{{ $rank->rankable->name }}</a>
			</td>
            <td>
                <span class="paragon">({{ $rank->rankable->paragon_level }})</span>
            </td>
            <td class="hidden-xs">
                {{ $rank->rankable->klass }}
            </td>
			<td class="hidden-xs">
				{{ $rank->rankable->careerRegion->career->battletag }}
			</td>
			<td>
				{{ $rank->value }}
			</td>
		</tr>
	@endforeach
</table>