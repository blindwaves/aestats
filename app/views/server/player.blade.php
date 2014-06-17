@extends('layouts.master')

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a href="#profile" data-toggle="tab">profile</a></li>
        <li><a href="#fleet" data-toggle="tab">fleet</a></li>
        <li><a href="#economy" data-toggle="tab">economy</a></li>
        <li><a href="#level" data-toggle="tab">level</a></li>
        <li><a href="#experience" data-toggle="tab">experience</a></li>
        <li><a href="#technology" data-toggle="tab">technology</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="profile">
            <table class="table table-striped">
                <thead><tr><th>Date</th><th>Guild</th><th>Name</th></tr></thead>
                <tbody>
                    @foreach($history as $item)
                    <tr><td>{{ $item->updated_at->diffForHumans() }}</td><td>{{ $item->tag }}</td><td>{{ $item->name }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="fleet"></div>
        <div class="tab-pane" id="economy"></div>
        <div class="tab-pane" id="level"></div>
        <div class="tab-pane" id="experience"></div>
        <div class="tab-pane" id="technology"></div>
    </div>
@stop
