@extends('layouts.master')

@section('content')
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var options = {
                legend: { position: 'bottom' },
                pointSize: 2
            };
            
            <?php
            $tempData = array();
            
            $tempData['fleet'] = array();
            foreach($fleet as $item) {
                array_push($tempData['fleet'], '['.$item->getRecordJavascriptDateString().','.$item->getNonLocalisedValue().']');
            }
            $tempData['economy'] = array();
            foreach($economy as $item) {
                array_push($tempData['economy'], '['.$item->getRecordJavascriptDateString().','.$item->getNonLocalisedValue().']');
            }
            $tempData['level'] = array();
            foreach($level as $item) {
                array_push($tempData['level'], '['.$item->getRecordJavascriptDateString().','.$item->getNonLocalisedValue().']');
            }
            $tempData['experience'] = array();
            foreach($experience as $item) {
                array_push($tempData['experience'], '['.$item->getRecordJavascriptDateString().','.$item->getNonLocalisedValue().']');
            }
            $tempData['technology'] = array();
            foreach($technology as $item) {
                array_push($tempData['technology'], '['.$item->getRecordJavascriptDateString().','.$item->getNonLocalisedValue().']');
            }
            ?>
            
            var data = [];
            data['fleet'] = [<?php echo implode($tempData['fleet'], ','); ?>];
            data['economy'] = [<?php echo implode($tempData['economy'], ','); ?>];
            data['level'] = [<?php echo implode($tempData['level'], ','); ?>];
            data['experience'] = [<?php echo implode($tempData['experience'], ','); ?>];
            data['technology'] = [<?php echo implode($tempData['technology'], ','); ?>];

            _(['fleet', 'economy', 'level', 'experience', 'technology']).forEach(function(item) { 
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('date', 'date');
                dataTable.addColumn('number', item);
                dataTable.addRows(data[item]);

                var dataView = new google.visualization.DataView(dataTable);
                var dateFormatter = new google.visualization.DateFormat({ 
                    pattern: "h a"
                }); 
                dateFormatter.format(dataTable, 0);
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
                    @for($i = count($profile) - 1; $i >= 0; $i--)
                    <tr><td data-toggle="tooltip" data-placement="left" title="{{ $profile[$i]->updated_at }}">{{ $profile[$i]->updated_at->diffForHumans() }}</td><td>{{ $profile[$i]->getGuildLocalLink() }}</td><td>{{ $profile[$i]->name }}</td></tr>
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
                <div class="active" style="height: 300px;" id="fleet"></div>
                <div class="" style="height: 300px;" id="economy"></div>
                <div class="" style="height: 300px;" id="level"></div>
                <div class="" style="height: 300px;" id="experience"></div>
                <div class="" style="height: 300px;" id="technology"></div>
            </div>
        </div>
    </div>
@stop
