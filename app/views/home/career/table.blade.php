<table class="table">
    <thead>
    <tr>
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