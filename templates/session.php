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
        <form class="form-horizontal" role="form" autocomplete="off"  data-toggle="validator" method="POST" action="newSession.php" style="text-align: center">
            <div class="form-group">
                <label class="control-label col-sm-2" for="dato">Date:</label>
                <div class="col-sm-8">
                    <input type="text"  style="background-color: white" data-date-format= "yyyy-mm-dd" class="form-control datepicker" name="date" placeholder="  Pick Exercise Date" readonly required>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="control-label col-sm-2" for="place">Place:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="place" placeholder="Enter Place" required>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-success">New Session</button>
        </form>
        <br>
        <br>


        <?php
        $sql= /** @lang mysql */
            "SELECT *, DATE_FORMAT(date,'%d-%m-%Y') AS niceDate
            FROM sessions
            where personid_fk = 1
            order by date desc";



        $query = mysql_query($sql);

        while ($row = mysql_fetch_array($query)) {
            echo '<div class="panel">';
            echo '<div class="panel-heading borderless" style="height: 90px; background-color: #466675"><h2 style="text-align: center;margin-top: 10px;">'.$row[place]." - ".$row[niceDate].'</h2></div>';
            echo '<table class="table table-striped">';
            $sessID = $row[sessionid];
            $sql2= /** @lang mysql */
                "select distinct exercise_name,exerciseid_fk from execution
                join exercise on exerciseid = exerciseid_fk
                where sessionid_fk = '$sessID'";
            $query2 = mysql_query($sql2);
            $exerciseid_fk;
            while ($row = mysql_fetch_array($query2)) {
                $exerciseid_fk = $row[exerciseid_fk];
                echo "<table class='table table-bordered table-striped' id ='anchor$sessID'>";
                echo '<div style="text-align: center; background-color: #337AB7;color:white; border-top: 1px solid #DDDDDD;border-bottom: 1px solid #DDDDDD;height: 40px;"><h6 style="margin-top: 10px;">'.$row[exercise_name].'</h6></div>';
                echo '<thead ><tr><th>Reps</th><th >Weight (Kg)</th><th>Belt</th></tr></thead>';
                $sql3= /** @lang mysql */
                    "select * from execution
                join exercise on exerciseid = exerciseid_fk
                where exerciseid_fk= '$row[exerciseid_fk]'
                and sessionid_fk = '$sessID'";
                $query3 = mysql_query($sql3);

                while ($row = mysql_fetch_array($query3)) {
                    echo "<tr>";
                    echo "<td>".$row[reps]."</td>";
                    echo "<td>".$row[kg]."</td>";
                    if($row[belt] == 0){
                        echo "<td>No</td>";
                    }
                    else{
                        echo "<td>Yes</td>";
                    }
                    echo "</tr>";

                }
                echo "</table>";
                echo "<form class='form-horizontal' role='form' method='POST' action='newSett.php'>";
                echo "<input type='hidden' name='exerciseid' value='$exerciseid_fk'>";
                echo "<input type='hidden' name='sessID' value='$sessID'>";
                echo '<div class="panel-footer borderless" style="height: 60px">';
                echo '<table class="table" id="addNew">';
                echo '<tr>';
                echo '<td><input class="form-control"  placeholder="Repetitions" name="reps"  type="text" style="height: 28px"></td>';
                echo '<td><input class="form-control"  placeholder="Weight"  name="kg"  type="text" style="height: 28px"></td>';
                echo '<td><input class="form-control"  placeholder="Belt"   name="belt"  type="text" style="height: 28px"></td>';
                echo '<td> <button name="add" type="submit" class="btn btn-primary btn-sm" style="margin-left:5%;height: 28px;">Add Sett</button></td>';
                echo '</tr>';
                echo '</table>';
                echo '</div>';
                echo '</form>';
            }

            echo "</table>";
            echo '<div style="text-align: center; background-color: #466675; height: 40px; border-top: 1px solid #DDDDDD;border-bottom: 1px solid #DDDDDD;"></div>';
            echo '<form class="form-horizontal" role="form" method="POST" action="newSessionExercise.php">';
            echo '<div class="panel-footer borderless" style="height: 90px;" ">';
            echo '<table class="table" id="addNew">';
            echo '<tr>';
            echo '<td>';
            echo '<select class="form-control" style="width: 70%; border-radius: 0px; display: inline-block">';
            $sql4 = "select * from exercise order by exercise_name";
            $query4 = mysql_query($sql4);
            while ($row = mysql_fetch_array($query4)) {
                echo '<option value="'.$row[exercise_name].'">'.$row[exercise_name].'</option>';
            }
            echo '</select>';
            echo '<button name="add" style="margin-left: 50px;" type="submit" class="btn btn-info btn-sm" >Add Exercise</button>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
            echo '</div>';
            echo '</form>';
            echo "</div><br>";
        }
        ?>
        <?php
        echo "<div id=\"hello\"></div>";
        ?>




    </div>
</div>

</body>
</html>