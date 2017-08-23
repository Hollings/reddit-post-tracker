@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Viewing post {{$postWatcher->reddit_id}}.<a href="/r/">Go Back</a></div>

                <div class="panel-body">
                        <p>{{ $postWatcher->title }}</p>
                        @if($postWatcher->raw)
                        <img src="{{json_decode($postWatcher->raw)->thumbnail}}">
                        @endif
                      <div id="curve_chart" style="width: 100%; height: 500px"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Time', 'Comments', 'Score', {'type': 'string', 'role': 'style'}],
            @foreach ($postWatcher->posthistory as $ph)
            //{{$ph->on_front_page}}
                ['{{date_format($ph->created_at, 'n-d g:ia')}}',{{$ph->num_comments}},{{$ph->score}}
                @if ($ph->on_front_page)
                ,'point {size: 2; fill-color: green}']
                @else
                ,'point {size: 0; fill-color: green}']
                @endif
                ,
            @endforeach
        ]);

        var options = {
          title: '{{$postWatcher->reddit_id}}',
          curveType: 'linear',
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          vAxes: {
            // Adds titles to each axis.
            0: {title: 'Comments'},
            1: {title: 'Score'}
          },
          legend: { position: 'bottom' },
          pointSize: 1,
          hAxis: {
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      var timeout = setTimeout("location.reload(true);",60000);
      function resetTimeout() {
        clearTimeout(timeout);
        timeout = setTimeout("location.reload(true);",60000);
      }
    </script>
@endsection
