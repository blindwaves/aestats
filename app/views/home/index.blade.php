@extends('layouts.master')

@section('content')
    <h1>AE Stats</h1>
    <p class="lead">Temporary replacement for <a href="http://faboo.org/eddie/">Eddie</a>.</p>

    <h2>Supported Servers</h2>

    <div class="list-group">
        @foreach($supportedServers as $server)
        <a class="list-group-item" href="{{ URL::action('ServerController@getIndex', array($server)) }}">{{ $server }}</a>
        @endforeach
    </div>
@stop
