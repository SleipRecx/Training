<?php
session_start();
include_once("connection.php");
if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}
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
    <?php
    session_start();
    include_once("connection.php");
    $id = $_SESSION["personid"];
    $query1 = mysql_query(
    /** @lang MYSQL */
    "select exercise_name,kg,reps
    from records
    join persons on personid=personid_fk
    join exercise on exerciseid=exerciseid_fk
    where personid ='$id'
    group by kg,exercise_name
    having (exercise_name,kg) in
    (select exercise_name,max(kg) from records
    join exercise on exerciseid = exerciseid_fk
    join persons on personid = personid_fk
    where personid = '$id'
    group by exerciseid_fk)
    order by kg desc");

    $query2 = mysql_query(
    /** @lang MYSQL */
    "select kg,reps,date
    from records
    join persons on personid=personid_fk
    join exercise on exerciseid=exerciseid_fk
    left join training_session on sessionid=sessionid_fk
    where personid='$id' and exerciseid=1
    order by kg desc");

    $query3 = mysql_query(
    /** @lang MYSQL */
    "select kg,reps,date
    from records
    join persons on personid=personid_fk
    join exercise on exerciseid=exerciseid_fk
    left join training_session on sessionid=sessionid_fk
    where personid='$id' and exerciseid=2
    order by kg desc");

    $query4 = mysql_query(
    /** @lang MYSQL */
    "select kg,reps,date
    from records
    join persons on personid=personid_fk
    join exercise on exerciseid=exerciseid_fk
    left join training_session on sessionid=sessionid_fk
    where personid='$id' and exerciseid=3
    order by kg desc");
    ?>

    <div class="panel">
        <!-- Default panel contents -->
        <div class="panel-heading"><h4>Main Lifts - PR <span class="glyphicon glyphicon-star-empty" style="float: right"></span</h4></div>
        <!-- Table -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Exercise Name</th>
                <th>Weight (kg)</th>
                <th>Repetitions</th>
            </tr>
            </thead>
            <?php
            while ($row = mysql_fetch_array($query1)) {
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
    <div class="panel">
        <!-- Default panel contents -->
        <div class="panel-heading"><h4>Squat - PR</h4></div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Weight (kg)</th>
                <th>Repetitions</th>
                <th>Date</th>
            </tr>
            </thead>
            <?php
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

            ?>
        </table>
    </div>

    <br>
    <div class="panel">
        <!-- Default panel contents -->
        <div class="panel-heading"><h4>Deadlift - PR</h4></div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Weight (kg)</th>
                <th>Repetitions</th>
                <th>Date</th>
            </tr>
            </thead>
            <?php
            while ($row = mysql_fetch_array($query3)) {
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

            ?>
        </table>
    </div>


    <br>
    <div class="panel">
        <!-- Default panel contents -->
        <div class="panel-heading"><h4>Bench Press - PR</h4></div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Weight (kg)</th>
                <th>Repetitions</th>
                <th>Date</th>
            </tr>
            </thead>
            <?php
            while ($row = mysql_fetch_array($query4)) {
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
            ?>
        </table>
    </div>
    </div>
</div>

</body>
</html>