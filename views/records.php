<?php
session_start();
include_once("../scripts/db_connection.php");
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
    <?php include("nav.php") ?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php") ?>
</div>


<div class="container active-bar">
    <div class="inner">
        <?php include("about_modal.php") ?>
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
                $select_pr_for_all_exercise =
                    /** @lang MYSQL */
                    "SELECT exercise_name,kg,reps,exerciseid
                    FROM execution
                    JOIN results ON resultid_fk = resultid
                    JOIN sessions ON sessionid_fk = sessionid
                    JOIN persons ON personid_fk = personid
                    JOIN exercise ON exerciseid_fk = exerciseid
                    WHERE personid = $_SESSION[personid]
                    GROUP BY kg,exercise_name
                    HAVING (exerciseid,kg) IN
                    (SELECT exerciseid,max(kg)
                    FROM execution
                    JOIN results ON  resultid_fk = resultid
                    JOIN exercise ON exerciseid_fk = exerciseid
                    JOIN sessions s ON sessionid_fk = s.sessionid
                    JOIN persons  ON s.personid_fk = personid
                    WHERE personid = $_SESSION[personid]
                    GROUP BY exerciseid)
                    ORDER BY kg DESC";

                $result = $conn->query($select_pr_for_all_exercise);
                if($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["exercise_name"]."</td>";
                        echo "<td>".$row["kg"]."</td>";
                        echo "<td>".$row["reps"]."</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
        <br>
        <?php
        $result = $conn->query($select_pr_for_all_exercise);
         if($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 echo '<div class="panel">';
                 echo '<div class="panel-heading borderless"><h4 style="text-align: center">'.$row["exercise_name"].'</h4></div>';
                 echo '<table class="table striped">';
                 echo '<thead><tr><th>Weight (kg)</th><th>Repetitions</th><th>Date</th></tr></thead>';
                 $select_pr_for_exercise =
                     /** @lang MYSQL */
                     "SELECT kg,reps,date
						FROM execution
                        JOIN results ON resultid_fk = resultid
                        JOIN exercise ON exerciseid_fk = exerciseid
                        JOIN sessions s ON sessionid_fk = sessionid
                        JOIN persons  ON s.personid_fk = personid
                        WHERE exerciseid = $row[exerciseid] AND personid = $_SESSION[personid]
                        GROUP BY kg,reps
                        HAVING (kg,reps) IN(
                     SELECT kg,max(reps)
                        FROM execution
                        JOIN results ON resultid_fk = resultid
                        JOIN exercise ON exerciseid_fk = exerciseid
                        JOIN sessions s ON sessionid_fk = sessionid
                        JOIN persons  ON s.personid_fk = personid
                        WHERE exerciseid = $row[exerciseid] AND personid = $_SESSION[personid]
                        GROUP BY kg)
                        ORDER BY kg DESC";
                 $result2 = $conn->query($select_pr_for_exercise);
                 if($result2->num_rows > 0) {
                     while ($row2 = $result2->fetch_assoc()) {
                         echo "<tr>";
                         echo "<td>".$row2["kg"]."</td>";
                         echo "<td>".$row2["reps"]."</td>";
                         if($row2["date"] != null){
                             echo "<td>".$row2["date"]."</td>";
                         }
                         else{
                             echo "<td>Not Registered</td>";
                         }
 
                         echo "</tr>";
                     }
                 }
                 echo "</table></div><br>";
             }
         }
        ?>



    </div>
</div>

</body>
</html>