@extends('ranklist.index')

@section('ranks')
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
            <a href="{{ URL::route('hero.profile', $rank->rankable->blizzard_id) }}" class="{{ $rank->rankable->klass }}">{{ $rank->rankable->name }}</a>
        </td>
        <td>
            <span class="paragon">({{ $rank->rankable->paragon_level }})</span>
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
@stop