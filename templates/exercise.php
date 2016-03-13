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

<link rel="stylesheet" href="../css/material-table.css" property="stylesheet">
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
                            <th>Added By</th>
                            <th>Date Added</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = /** @lang MYSQL */
                            "select personid,firstname,lastname,
                            exercise_name,muscle_group,
                            date_added,category,exerciseid
                            from exercise
                            join persons on personid=personid_fk";


                        $result = $conn->query($sql);
                        if($result->num_rows > 0){

                             while ($row = $result->fetch_assoc()){
                                 echo "<tr>";
                                 if($row["personid"]==$_SESSION["personid"] or $_SESSION["personid"] == 0){
                                     echo '<td>';
                                     echo '<span style="display:none">'.$row["exercise_name"].'</span>';
                                     echo '<input type="submit" data-id = "'.$row["exerciseid"].'" class="textButton" value='.'"'.$row["exercise_name"].'"'.'>';
                                     echo '</td>';

                                 }
                                 else{
                                     echo "<td>".$row["exercise_name"]."</td>";
                                 }
                                 echo "<td>".$row["muscle_group"]."</td>";
                                 echo "<td>".$row["category"]."</td>";
                                 echo "<td>".$row["firstname"]."</td>";
                                 echo "<td>".$row["date_added"]."</td>";
                                 echo "</tr>";
                             }
                        }
                        ?>
                        </tbody>
                    </table>

                            <table class="table" id="addNew">
                                <tr style="padding-bottom: 50px;">
                                    <td><input class="form-control"  placeholder="Exercise Name" id="exercise_name"  type="text" style="height: 33px;margin-top: 10px;"></td>
                                    <td><input class="form-control"  placeholder="Muscle Group" id="muscle_group"  type="text" style="height: 33px;margin-top: 10px;"></td>
                                    <td><input class="form-control" placeholder="Category" id="category" type="text" style="height: 33px;margin-top: 10px;"></td>
                                    <td><button name="add" type="submit" id="new_exercise_button" class="btn waves-effect " style="background-color:#1f7e9a;display: block;margin: 0 auto">Add Exercise</button></td>
                                </tr>
                            </table>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#new_exercise_button').on('click', function(){
                    var new_exercise_data = {
                        exercise_name: $('#exercise_name').val(),
                        muscle_group: $('#muscle_group').val(),
                        category: $('#category').val()
                    };
                    $.ajax({
                        type: 'POST',
                        url: 'newExercise.php',
                        data: new_exercise_data,
                        success: function(data){
                            var array = JSON.parse(data);
                            var t = $('#datatable').DataTable();
                            t.row.add( [
                                array[0],
                                array[1],
                                array[2],
                                array[3],
                                array[4]
                            ] ).draw( false );

                            $('#exercise_name').val("");
                            $('#muscle_group').val("");
                            $('#category').val("");

                        },
                        error: function (){
                            alert("Something went wrong adding your exercise");
                        }
                    })


                })
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.textButton').on('click', function(){
                    var remove_data = {
                        removeid: $(this).attr('data-id')
                };
                    $.ajax({
                        type: 'POST',
                        url: 'delexercise.php',
                        data: remove_data,
                        success: function(data2){
                            var t = $('#datatable').DataTable();
                            var $row = t.$("tr").find("[data-id='" + data2 + "']").closest("tr");
                            var index = t.row($row).index();
                            t.rows(index).remove().draw()
                        },
                        error: function (){
                            alert("Something went wrong adding your exercise");
                        }
                    })

                });
            });
        </script>
        <script type="text/javascript" src="../js/material-datatable.js"></script>
</div>
</body>
</html>