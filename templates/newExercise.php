<?php
session_start();
include_once("connection.php");
include_once("login_required.php");
$result = 0;

if(!empty($_POST["exercise_name"])){
    $name = $_POST["exercise_name"];
    $group = $_POST["muscle_group"];
    $category = $_POST["category"];
    $personid_fk = $_SESSION["personid"];
    $date = date("Y-m-d");

    $sql = /** @lang text */
        "INSERT INTO exercise(exercise_name,muscle_group,category,personid_fk,date_added)
     VALUES ('$name','$group','$category','$personid_fk','$date')";

    if($conn->query($sql) == TRUE){
        $array = array($name, $group, $category, $_SESSION["firstname"],$date);
        echo json_encode($array);
    }
   else{
        die('Could not enter data: ' . $conn->error);
    }
}

