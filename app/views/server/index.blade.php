@extends('layouts.master')

@section('content')
    @foreach($content as $item)
        {{ $item }}
    @endforeach
@stop
