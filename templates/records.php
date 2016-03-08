<?php
session_start();
include_once("connection.php");
include("login_required.php");
$id = $_SESSION["personid"];
$sql =
/** @lang MYSQL */
    "select exercise_name,kg,reps,exerciseid
    from execution ex
    join sessions s on s.sessionid=ex.sessionid_fk
    join persons p on p.personid = s.personid_fk
    join exercise e on e.exerciseid=ex.exerciseid_fk
    where personid = '$id'
    group by kg,exercise_name
    having(exerciseid,kg) in
    (select exerciseid,max(kg)
    from execution
    join exercise on exerciseid = exerciseid_fk
    group by exerciseid)";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php")?>
</head>
<body>

<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>


<div class="container active-bar">
    <div class="inner">

    <div class="panel">
        <!-- Default panel contents -->
        <div class="panel-heading borderless"><h4 style="text-align: center">All Lifts <span class="glyphicon glyphicon-star-empty" style="float: right"></span</h4></div>
        <!-- Table -->
        <table class="table striped">
            <thead>
            <tr>
                <th>Exercise Name</th>
                <th>Weight (kg)</th>
                <th>Repetitions</th>
            </tr>
            </thead>
            <?php
            $query = mysql_query($sql);
            while ($row = mysql_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row[exercise_name]."</td>";
                echo "<td>".$row[kg]."</td>";
                echo "<td>".$row[reps]."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <br>
        <?php
        $query = mysql_query($sql);
        while ($row = mysql_fetch_array($query)) {
            echo '<div class="panel">';
            echo '<div class="panel-heading borderless"><h4 style="text-align: center">'.$row[exercise_name].'</h4></div>';
            echo '<table class="table striped">';
            echo '<thead><tr><th>Weight (kg)</th><th>Repetitions</th><th>Date</th></tr></thead>';
            $exerciseID = $row[exerciseid];
            $sql2 =
            /** @lang MYSQL */
                "select kg,reps,date
                from execution ex
                join exercise e on ex.exerciseid_fk = e.exerciseid
                join sessions s on s.sessionid = ex.sessionid_fk
                join persons p on p.personid = s.personid_fk
                where e.exerciseid ='$exerciseID' and p.personid = '$id'
                group by kg
                order by kg desc";


            $query2 = mysql_query($sql2);
            while ($row = mysql_fetch_array($query2)) {
                echo "<tr>";
                echo "<td>".$row[kg]."</td>";
                echo "<td>".$row[reps]."</td>";
                if($row[date] != null){
                    echo "<td>".$row[date]."</td>";
                }
                else{
                    echo "<td>Not Registered</td>";
                }

                echo "</tr>";
            }
            echo "</table></div><br>";
        }
            ?>

    </div>
</div>

</body>
</html>