@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-push-8" style="margin-top: 4px;">
            <table class="table table-striped">
                <thead><tr><th>Date</th><th>Guild</th><th>Name</th></tr></thead>
                <tbody>
                    @foreach($profile as $item)
                    <tr><td>{{ $item->updated_at->diffForHumans() }}</td><td>{{ $item->tag }}</td><td>{{ $item->name }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-8 col-md-pull-4">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#fleet" data-toggle="tab">fleet</a></li>
                <li><a href="#economy" data-toggle="tab">economy</a></li>
                <li><a href="#level" data-toggle="tab">level</a></li>
                <li><a href="#experience" data-toggle="tab">experience</a></li>
                <li><a href="#technology" data-toggle="tab">technology</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="fleet">
                    <table class="table table-striped">
                        <thead><tr><th>Date</th><th>Guild</th><th>Name</th></tr></thead>
                        <tbody>
                            @foreach($fleet as $item)
                            <tr><td>{{ $item->updated_at->diffForHumans() }}</td><td>{{ $item->tag }}</td><td>{{ $item->name }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="economy"></div>
                <div class="tab-pane" id="level"></div>
                <div class="tab-pane" id="experience"></div>
                <div class="tab-pane" id="technology"></div>
            </div>
        </div>
    </div>
@stop
