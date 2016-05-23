<?php
session_start();
include_once("db_connection.php");
include_once("login_required.php");
$result = 0;

if(!empty($_POST["exercise_name"])){
    $name = $_POST["exercise_name"];
    $group = $_POST["muscle_group"];
    $personid_fk = $_SESSION["personid"];
    $date = date("Y-m-d");

    $sql = /** @lang text */
        "INSERT INTO exercise(exercise_name,muscle_group,personid_fk,date_added)
     VALUES ('$name','$group','$personid_fk','$date')";
    
    if($conn->query($sql) == TRUE){
        $array = array($name, $group ,$_SESSION["firstname"],$date);
        echo json_encode($array);
    }
   else{
        die('Could not enter data: ' . $conn->error);
    }
}

