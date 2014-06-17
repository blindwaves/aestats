@extends('layouts.master')

@section('content')
    @foreach($history as $item)
        {{ $item }}
    @endforeach
@stop
