<?php
session_start();
include_once("connection.php");
include("login_required.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php")?>
</head>
<body>
<script type="text/javascript" src="../js/materialize.js"></script>

<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>
<script>

    var array =["lightseagreen","steelblue"];
    function getRandomColor(){
        var rand = Math.floor((Math.random() * array.length));
        return array[rand];
    }

    function changeColors(){
        var array = document.getElementsByClassName("chill");
        var array2 = document.getElementsByClassName("exercise");
        var lastcolor = "red";
        for(var i = 0; i < array.length; i++){
            var color =  getRandomColor();
            while(lastcolor == color){
                color =  getRandomColor();
            }
            array[i].style.backgroundColor = color;
            array2[i].style.backgroundColor = color;
            lastcolor =  array[i].style.backgroundColor;
        }

    }

    window.onload = function(){
        $('.modal-trigger').leanModal({
                dismissible: true, // Modal can be dismissed by clicking outside of the modal
                opacity: .5, // Opacity of modal background
                in_duration: 300, // Transition in duration
                out_duration: 200, // Transition out duration
                ready: function() { alert('Ready'); }, // Callback for Modal open
                complete: function() { alert('Closed'); } // Callback for Modal close
            }
        );


        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: false
        });

        changeColors();
    }

</script>
<div class="container active-bar">
    <div class="inner">
        <div class="row">
            <table class="table table-centred" style="width: 70%; margin: 0 auto">
                <form class="form" role="form" data-toggle="validator" method="POST" action="newSession.php" style="text-align: center">
                <tr>
                    <td>
                        <div class="input-field col s12">
                            <input type="date" placeholder="Pick Session Date" class="form-control datepicker" name="date"  required>
                        </div>
                        </td>
                    <td>
                        <div class="input-field col s12">
                            <input type="text" class="form-control" placeholder="Enter Session Place" name="place" required>
                        </div>
                    </td>

                </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" name="submit"  style="display: block;margin:auto;" class="btn btn-success">New Session</button>
                        </td>

                    </tr>
                </form>
            </table>
        </div>


        <br>

        <?php
        $sql= /** @lang mysql */
            "SELECT *, DATE_FORMAT(date,'%d-%m-%Y') AS niceDate
            FROM sessions
            where personid_fk = $_SESSION[personid]
            order by date desc";
        $query = mysql_query($sql);
        while ($row = mysql_fetch_array($query)) {
            $sessID = $row[sessionid];
            $sql2= /** @lang mysql */
                "select distinct exercise_name,exerciseid_fk from execution
                join exercise on exerciseid = exerciseid_fk
                where sessionid_fk = '$sessID'";
            $query2 = mysql_query($sql2);
            $exerciseid_fk = null;
            echo "<div class='chill' style='background-color:white; height: 50px;margin-left: 24px;margin-right: 24px; text-align: center'> <h5 style='color: white; padding-top: 10px;'>$row[place] - $row[niceDate]</h5></div>";
            echo "<ul class='collapsible popout' data-collapsible='accordion'>";
            while ($row = mysql_fetch_array($query2)) {
                $exerciseid_fk = $row[exerciseid_fk];
                $sql3= /** @lang mysql */
                    "select * from execution
                join exercise on exerciseid = exerciseid_fk
                where exerciseid_fk= '$row[exerciseid_fk]'
                and sessionid_fk = '$sessID'";
                echo "<li>";
                echo "<div class='collapsible-header' style='text-align: center'>$row[exercise_name]</div>";
                echo "<div class='collapsible-body' style='background-color: white'>";
                echo "<table class='table striped centered'>";
                echo '<thead><tr><th>Reps</th><th >Weight (Kg)</th><th>Belt</th></tr></thead>';
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
                echo "<table class='table centered'>";
                echo "<tr style='background-color: white; height: 30%'>";
                echo "<form class='form-horizontal' role='form' method='POST' action='newSett.php'>";
                echo "<input type='hidden' name='exerciseid' value='$exerciseid_fk'>";
                echo "<input type='hidden' name='sessID' value='$sessID'>";
                echo '<td><input class="form-control"  placeholder="Repetitions" name="reps"  type="text" style="text-align: center;"></td>';
                echo '<td><input class="form-control"  placeholder="Weight"  name="kg"  type="text" style="text-align: center;"></td>';
                echo '<td><input class="form-control"  placeholder="Belt"   name="belt"  type="text" style="text-align: center;"></td>';
                echo '<td> <button name="add" type="submit" class="btn" style="margin-left: 10px;">Add Sett</button></td>';
                echo '</form>';
                echo "</tr>";
                echo "</table>";
                echo"</div>";
                echo"</li>";

            }

            echo "<li>";
            echo "<div  class='collapsible-header' style='text-align: center;margin-bottom: 80px;'>";
            echo '<form class="form-horizontal" role="form" method="POST" action="newSessionExercise.php">';
            echo "<table class='table centered'>";
            echo '<tr>';
            echo '<td style="padding-left: 50px;">';
            echo "<input type='hidden' name ='sessionid' value='$sessID'>";
            echo '<select name="exerciseid">';
            $sql4 = "select * from exercise order by exercise_name";
            $query4 = mysql_query($sql4);
            while ($row = mysql_fetch_array($query4)) {
                echo '<option value="'.$row[exerciseid].'">'.$row[exercise_name].'</option>';
            }
            echo '</select>';
            echo '</td>';
            echo '<td>';
            echo '<button name="add" style="margin-left: 50px;" type="submit" class="btn exercise" >Add Exercise</button>';
            echo '</td>';
            echo '</tr>';
            echo "</table>";
            echo "</form>";
            echo "</div>";
            echo "</li>";
            echo "</ul>";


        }
        ?>



        <script>
            $(document).ready(function(){
                $('.collapsible').collapsible({
                    accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
                });
            });

            $(document).ready(function() {
                $('select').material_select();
            });

        </script>




    </div>
</div>

</body>
</html>