@extends('layouts.master')

@section('content')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        
    </script>

    <div class="row">
        <div class="col-md-4 col-md-push-8" style="margin-top: 4px;">
            <table class="table table-striped">
                <thead><tr><th>Date</th><th>Tag</th><th>Name</th></tr></thead>
                <tbody>
                    @for($i = count($profile) - 1; $i >= 0; $i--)
                    <tr><td data-toggle="tooltip" data-placement="left" title="{{ $profile[$i]->updated_at }}">{{ $profile[$i]->updated_at->diffForHumans() }}</td><td>{{ $profile[$i]->tag }}</td><td>{{ $profile[$i]->name }}</td></tr>
                    @endfor
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
                <div class="active" id="fleet"></div>
                <div class="" id="economy"></div>
                <div class="" id="level"></div>
                <div class="" id="experience"></div>
                <div class="" id="technology"></div>
            </div>
        </div>
    </div>
@stop
