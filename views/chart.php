<?php
session_start();
include_once("../scripts/login_required.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php") ?>
</head>
<body>
<script type="text/javascript" src="../js/materialize.js"></script>
<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>
<div class="container active-bar">
    <div class="inner" style="">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

        <label for = "myCanvas">
            <h4>Muscle Groups</h4><br />
            <canvas id="myCanvas" width="500" height="300"></canvas>
        </label>
        <label for = "myCanvas">
            <h4>Exercises</h4><br />
            <canvas id="myCanvas2" width="1000%" height="600"></canvas>
        </label>
        <br>
        <br>
        <br>
        <br>

        <script>
            $.ajax({
                type: 'POST',
                url: '../scripts/stats_fetch.php',
                dataType:'json',
                success: function(data){
                    var data2 = [];
                    var colors = ["#df514c","#6e9ecf","#85c4b9 ","#008bba","#FDB45C","#354458"];
                    var canvas = document.getElementById("myCanvas").getContext("2d");
                    for(i = 0; i < data.length;i++){
                        console.log(data[i]);
                        var x = i;
                        if(i > colors.length-1){
                            x = x -colors.length;
                        }
                            data2.push({
                                value: data[i].number_of_sets,
                                color: colors[x],
                                label: data[i].muscle_group
                            });

                    }
                   var options =  {
                        //Boolean - Whether we should show a stroke on each segment
                        segmentShowStroke : false,
                        //String - The colour of each segment stroke
                        segmentStrokeColor : "#fff",
                        //Number - The width of each segment stroke
                        segmentStrokeWidth : 5,
                        //Number - The percentage of the chart that we cut out of the middle
                        percentageInnerCutout : 60, // This is 0 for Pie charts
                        //Number - Amount of animation steps
                        animationSteps : 50,
                        //String - Animation easing effect
                        animationEasing : "easeOutBounce",
                        //Boolean - Whether we animate the rotation of the Doughnut
                        animateRotate : true,
                        //Boolean - Whether we animate scaling the Doughnut from the centre
                        animateScale : true

                    };

                    var chart= new Chart(canvas).Doughnut(data2,options);
                },

                error: function (){
                    alert("Something went wrong fetching data");
                }
            });
            $.ajax({
                type: 'POST',
                url: '../scripts/stats_fetch2.php',
                dataType:'json',
                success: function(data1){
                    var data2 = [];
                    var labels = [];
                    var canvas2 = document.getElementById("myCanvas2").getContext("2d");
                    for(i = 0; i < data1.length;i++){
                        labels.push(data1[i].exercise_name);
                        data2.push(data1[i].number_of_sets);
                    }

                    var data = {
                        labels: labels,
                        datasets: [
                            {
                                label: "My First dataset",
                                fillColor: "rgba(151,187,205,0.5)",
                                strokeColor: "rgba(151,187,205,0.8)",
                                highlightFill: "rgba(151,187,205,0.75)",
                                highlightStroke: "rgba(151,187,205,1)",
                                data: data2
                            }
                        ]
                    };

                    var options = {
                        ///Boolean - Whether grid lines are shown across the chart
                        scaleLabel: "<%= ' ' + value%>",
                        scaleShowGridLines : false,
                        //String - Colour of the grid lines
                        scaleGridLineColor : "rgba(0,0,0,.05)",
                        //Number - Width of the grid lines
                        scaleGridLineWidth : 1,
                        //Boolean - Whether to show horizontal lines (except X axis)
                        scaleShowHorizontalLines: false,
                        //Boolean - Whether to show vertical lines (except Y axis)
                        scaleShowVerticalLines: false,
                        //Boolean - Whether the line is curved between points
                        bezierCurve : true,
                        //Number - Tension of the bezier curve between points
                        bezierCurveTension : 0.4,
                        //Boolean - Whether to show a dot for each point
                        pointDot : true,
                        //Number - Radius of each point dot in pixels
                        pointDotRadius : 3,
                        //Number - Pixel width of point dot stroke
                        pointDotStrokeWidth : 1,
                        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                        pointHitDetectionRadius : 20,
                        //Boolean - Whether to show a stroke for datasets
                        datasetStroke : false,
                        //Number - Pixel width of dataset stroke
                        datasetStrokeWidth : 2,
                        //Boolean - Whether to fill the dataset with a colour
                        datasetFill : true,
                    };

                    var myBarChart = new Chart(canvas2).Line(data,options);
                },

                error: function (){
                    alert("Something went wrong fetching data");
                }
            });

        </script>

    </div>
</div>
</body>
</html>