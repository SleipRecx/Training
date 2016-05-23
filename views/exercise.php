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

<link rel="stylesheet" href="../css/material-table.css" property="stylesheet">
<script type="text/javascript" src="../js/datatables_min.js"></script>
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
        <div class="row">
            <div id="admin" class="col s12">
                <div class="card material-table">
                    <div class="table-header">
                        <span class="table-title">All Exercises</span>
                        <div class="actions">
                            <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                        </div>
                    </div>
                    <table id="datatable">
                        <thead>
                        <tr>
                            <th>Exercise Name</th>
                            <th>Muscle Group</th>
                            <th>Added By</th>
                            <th>Exercise ID</th>
                            <th>Date Added</th>
                        </tr>
                        </thead>
                        <tbody>
                        <script type="text/javascript" src="../js/datatable_exercise.js"></script>
                        </tbody>
                    </table>
                    <script></script>
                    <table class="table" id="addNew">
                        <tr style="padding-bottom: 50px;">
                            <td><input class="form-control"  placeholder="Exercise Name" id="exercise_name"  type="text" style="height: 33px;margin-top: 10px;"></td>
                            <td><input class="form-control"  placeholder="Muscle Group" id="muscle_group"  type="text" style="height: 33px;margin-top: 10px;"></td>
                            <td><button name="add" type="submit" id="new_exercise_button" class="btn waves-effect " style="background-color:#1f7e9a;display: block;margin: 0 auto">Add Exercise</button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>