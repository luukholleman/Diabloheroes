<table class="table">
	<thead>
	<tr>
        <th>
           Rank
        </th>
        <th>
            Name
        </th>
        <th>
            Paragon
        </th>
        <th>
            Class
        </th>
        <th>
            Battletag
        </th>
        <th>
            Value
        </th>
	</tr>
	</thead>
	@foreach($ranks as $rank)
		<tr>
			<td class="col-xs-1">
				#{{ $rank->rank }}
			</td>
			<td class="col-xs-2">
				<a href="{{ URL::route('hero.profile', $rank->rankable->blizzard_id) }}">{{ $rank->rankable->name }}</a>
			</td>
            <td>
                <span class="paragon">({{ $rank->rankable->paragon_level }})</span>
            </td>
            <td>
                {{ $rank->rankable->klass }}
            </td>
			<td>
				{{ $rank->rankable->careerRegion->career->battletag }}
			</td>
			<td>
				{{ $rank->value }}
			</td>
		</tr>
	@endforeach
</table>