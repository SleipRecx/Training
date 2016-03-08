<?php
session_start();
include_once("connection.php");
include("login_required.php");

$query = mysql_query(
/** @lang MYSQL */
    "select personid,firstname,lastname,exercise_name,muscle_group,date_added,category,exerciseid
    from exercise
    join persons on personid=personid_fk");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php")?>
</head>
<body>
<link rel="stylesheet" href="../css/material-table.css">
<script type="text/javascript" src="../js/datatables.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>

<div class="container active-bar">
    <div class="inner">
        <?php include("aboutModal.php")?>
        <div class="row">
            <div id="admin" class="col s12">
                <div class="card material-table">
                    <div class="table-header">
                        <span class="table-title"><h3>All Exercises</h3></span>
                        <div class="actions">
                            <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                        </div>
                    </div>
                    <table id="datatable">
                        <thead>
                        <tr>
                            <th>Exercise Name</th>
                            <th>Muscle Group</th>
                            <th>Category</th>
                            <th>Date Added</th>
                            <th>Added By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysql_fetch_array($query)) {
                            echo "<tr>";
                            if($row[personid]==$_SESSION[personid] or $_SESSION[personid] == 0){

                                echo '<td>';
                                echo '<form action="delexercise.php"  onsubmit="return confirm(\'Are you sure you want to delete this exercise?\');" method="post">';
                                echo '<span style="display: none">'.$row[exercise_name].'</span>';
                                echo '<input type="submit" class="textButton" value='.'"'.$row[exercise_name].'"'.'>';
                                echo '<input type="hidden" name="exerciseid" value='.'"'.$row[exerciseid].'"'.'>';
                                echo '</form>';
                                echo '</td>';

                            }
                            else{
                                echo "<td>".$row[exercise_name]."</td>";
                            }
                            echo "<td>".$row[muscle_group]."</td>";
                            echo "<td>".$row[category]."</td>";
                            echo "<td>$row[date_added]</td>";

                            if($row[personid]==0){
                                echo "<td>".$row[firstname]."</td>";
                            }
                            else{
                                echo "<td>".$row[firstname]." ".$row[lastname]."</td>";
                            }

                            echo "</tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                    <form class="form-horizontal" role="form" method="POST" style="padding-bottom: 20px;"  action="newExercise.php">
                            <table class="table" id="addNew">
                                <tr style="padding-bottom: 50px;">
                                    <td><input class="form-control"  placeholder="Exercise Name" name="exercise_name"  type="text" style="height: 33px;margin-top: 10px;"></td>
                                    <td><input class="form-control"  placeholder="Muscle Group" name="muscle_group"  type="text" style="height: 33px;margin-top: 10px;"></td>
                                    <td><input class="form-control" placeholder="Category" name="category" type="text" style="height: 33px;margin-top: 10px;"></td>
                                    <td> <button name="add" type="submit" class="btn waves-effect " style="background-color:#1f7e9a;display: block;margin: 0 auto">Add Exercise</button></td>
                                </tr>
                            </table>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../js/material-datatable.js"></script>

</div>
</body>
</html>