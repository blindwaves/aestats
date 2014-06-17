@extends('layouts.master')

@section('title', '404 Not Found')
@section('content')
    
    <div class="jumbotron text-center">
        <div class="container">
            <h1>Page Not Found <small class="text-danger">Error 404</small></h1>
            <p class="lead">The page you requested could not be found.</p>
            <p><a href="{{ URL::action('HomeController@getIndex') }}" class="btn btn-large btn-info">
                <i class="glyphicon glyphicon-home"></i> Take Me Home
            </a></p>
        </div>
    </div>
@stop
