<?php
session_start();
include_once("connection.php");
if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}

$query = mysql_query(
/** @lang MYSQL */
    "select personid,firstname,lastname,exercise_name,muscle_group,category,exerciseid
    from exercise
    join persons on personid=personid_fk");

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

<script>

</script>


<div class="container active-bar">
    <div class="inner">


        <div class="panel panel-default">

            <!-- Default panel contents -->
            <div class="background-blue panel-heading borderless" style="height: 80px;"><h3 style="text-align: center; margin-top: 10px;">All Exercises</h3></div>


            <!-- Table -->
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                <tr>
                    <th>Exercise Name</th>
                    <th>Muscle Group</th>
                    <th>Category</th>
                    <th>Added By</th>

                </tr>
                </thead>

                <?php
                while ($row = mysql_fetch_array($query)) {
                    echo "<tr>";
                    if($row[personid]==$_SESSION[personid] or $_SESSION[personid] == 0){
                        echo '<form action="delexercise.php"  onsubmit="return confirm(\'Are you sure you want to delete this exercise?\');" method="post">';
                        echo '<input type="hidden" name="exerciseid" value='.'"'.$row[exerciseid].'"'.'>';
                        echo '<td>';
                        echo '<span style="display: none">'.$row[exercise_name].'</span>';
                        echo '<input type="submit" class="textButton" value='.'"'.$row[exercise_name].'"'.'></td>';
                        echo '</form>';
                    }
                    else{
                        echo "<td>".$row[exercise_name]."</td>";
                    }
                    echo "<td>".$row[muscle_group]."</td>";
                    echo "<td>".$row[category]."</td>";
                    if($row[personid]==0){
                        echo "<td>".$row[firstname]."</td>";
                    }
                    else{
                        echo "<td>".$row[firstname]." ".$row[lastname]."</td>";
                    }

                    echo "</tr>";
                }
                ?>
            </table>
            <form class="form-horizontal" role="form" method="POST"  action="newExercise.php">
            <div class="panel-footer borderless">
                <table class="table" id="addNew">
                    <tr>
                        <td><input class="form-control"  placeholder="Exercise Name" name="exercise_name"  type="text" style="height: 33px;"></td>
                        <td><input class="form-control"  placeholder="Muscle Group" name="muscle_group"  type="text" style="height: 33px;"></td>
                        <td><input class="form-control" placeholder="Category" name="category" type="text" style="height: 33px;"></td>
                        <td> <button name="add" type="submit" class="btn btn-primary btn-sm" style="margin-left:15%">Add Exercise</button></td>
                       <input type="hidden" value="<?php echo $_SESSION["personid"]?>" name="personid_fk">
                    </tr>
                </table>
            </div>
         </form>
    </div>
</div>
</body>
</html>