@extends('layouts.master')

@section('content')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var options = {
                legend: { position: 'bottom' }
            };

            var data = [];
            data['fleet'] = [
                @foreach($fleet as $item)
                [{{ $item->getRecordJavascriptDateString() }}, {{ $item->getNonLocalisedValue() }}],
                @endforeach
            ];
            data['economy'] = [
                @foreach($economy as $item)
                [{{ $item->getRecordJavascriptDateString() }}, {{ $item->getNonLocalisedValue() }}],
                @endforeach
            ];
            data['level'] = [
                @foreach($level as $item)
                [{{ $item->getRecordJavascriptDateString() }}, {{ $item->getNonLocalisedValue() }}],
                @endforeach
            ];
            data['experience'] = [
                @foreach($experience as $item)
                [{{ $item->getRecordJavascriptDateString() }}, {{ $item->getNonLocalisedValue() }}],
                @endforeach
            ];
            data['technology'] = [
                @foreach($technology as $item)
                [{{ $item->getRecordJavascriptDateString() }}, {{ $item->getNonLocalisedValue() }}],
                @endforeach
            ];

            _(['fleet', 'economy', 'level', 'experience', 'technology']).forEach(function(item) { 
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('date', 'date');
                dataTable.addColumn('number', item);
                dataTable.addRows(data[item]);

                var dataView = new google.visualization.DataView(dataTable);
                var chart = new google.visualization.LineChart(document.getElementById(item));
                chart.draw(dataView, options);

                $('#' + item).addClass('tab-pane');
            });
        }
    </script>

    <div class="row">
        <div class="col-md-4 col-md-push-8" style="margin-top: 4px;">
            <table class="table table-striped">
                <thead><tr><th>Date</th><th>Guild</th><th>Name</th></tr></thead>
                <tbody>
                    @foreach($profile as $item)
                    <tr><td data-toggle="tooltip" data-placement="left" title="{{ $item->updated_at }}">{{ $item->updated_at->diffForHumans() }}</td><td>{{ $item->tag }}</td><td>{{ $item->name }}</td></tr>
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
                <div class="active" id="fleet"></div>
                <div class="" id="economy"></div>
                <div class="" id="level"></div>
                <div class="" id="experience"></div>
                <div class="" id="technology"></div>
            </div>
        </div>
    </div>
@stop
