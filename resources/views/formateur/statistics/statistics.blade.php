@extends('layouts.Formateur')
@section('script')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <canvas id="myChart" width="100px" height="100px"></canvas>
        </div>
        <div class="col-md-5">
            <canvas id="myChart2" width="100px" height="100px"></canvas>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
    </div>
    <script>
        var ctx = document.getElementById('myChart');
        var ctx2 = document.getElementById('myChart2');
        var specData = JSON.parse(`<?php echo $data['chart_data']; ?>`);


        var myChart = new Chart(ctx, {

            type: 'doughnut',
            data: {
                labels: specData.label,
                datasets: [{
                    data: specData.data,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,

                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Nombre des étudiants par course'
                    }
                },

            }
        });

        var myChartSecond = new Chart(ctx2, {

            type: 'line',
            data: {
                labels: specData.label,
                datasets: [{
                    label: 'Profit en $',
                    data: specData.price.slice(0, 8),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1

                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Le profit des courses'
                    }
                },
                labelLength: 10,



            }
        });
    </script>
@endsection
