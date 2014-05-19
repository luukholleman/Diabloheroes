@extends('home.index')

@section('softcore')
    @include('home.career.table', ['ranks' => $softcoreCareers])
@stop

@section('hardcore')
    @include('home.career.table', ['ranks' => $hardcoreCareers])
@stop