@extends('layouts.app')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="col-md-8 col-sm-6  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Expenses Chart Graph</h2>
                            <div class="clearfix"></div>
                        </div>
                        <input type="hidden" value="{{ $expensesData }}" disabled id="myChartData" />
                        <div class="x_content">
                            <div class="col-md-6 col-sm-6  ">
                                <canvas id="myChart" width="200" height="200"></canvas>
                            </div>
                            <div class="col-md-6 col-sm-6  ">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div>
                                                    <p class="">Amount</p>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($amountData))
                                        @foreach($amountData as $amount)
                                        <tr>
                                            <td>P {{ $amount->total }}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script type="text/javascript">
    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    
    var ctx = document.getElementById('myChart');
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctx = $('#myChart');
    var ctx = 'myChart';
    var valChart = $('#myChartData').val();
    var pieData = [];
    var labelData = [];
    var colorData = [];

    $.each(JSON.parse(valChart), function( index, res ) {
        var randColor = getRandomColor();

        pieData.push(res.amount)
        labelData.push(res.category_name);
        colorData.push(randColor);
        console.log(res.amount);
        $("#"+res.category_name).css('color', randColor);
    });

    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labelData,
            datasets: [{
                label: 'Expenses Pie Chart',
                data: pieData,
                backgroundColor: colorData,
                borderColor: colorData,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@stop