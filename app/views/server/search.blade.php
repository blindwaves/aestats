@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead><tr><th>Id</th><th>Tag</th><th>Name</th></tr></thead>
                <tbody>
                    @foreach($results as $item)
                    <tr><td>{{ $item->getPlayerId() }}</td><td>{{ $item->getGuildLocalLink() }}</td><td><a href="{{ URL::action('ServerController@getPlayer', array($serverName, $item->getPlayerId())) }}">{{ $item->name }}</a></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
