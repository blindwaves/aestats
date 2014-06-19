@extends('layouts.master')

@section('content')
    <h1>Supported Servers</h1>

    <div class="list-group">
        @foreach($supportedServers as $server)
        <a class="list-group-item" href="{{ URL::action('ServerController@getIndex', array($server)) }}">{{ $server }}</a>
        @endforeach
    </div>
@stop
