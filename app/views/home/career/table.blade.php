<table class="table">
    <thead>
	    <tr>
		    <th>
	           <span class="hidden-xs">
		           Rank
	           </span>
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
            <td>
                #{{ $rank->rank }}
            </td>
            <td>
                {{ $rank->rankable->battletag }}
            </td>
            <td>
                <span class="paragon">{{ $rank->value }}</span>
            </td>
        </tr>
    @endforeach
</table>