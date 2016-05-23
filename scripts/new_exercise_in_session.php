<?php
session_start();
include_once("db_connection.php");
include ("login_required.php");

if(!empty($_POST["exercise_name"])){
    $exercise_name = $_POST["exercise_name"];
    $exerciseid_fk =  $_POST["exerciseid"];
    $sessionid_fk =  $_POST["sessionid"];

    $sql1 = "SELECT exerciseid FROM exercise WHERE exercise_name ='$exercise_name'";
    $id = "";
    $result = $conn->query($sql1);
    if($result->num_rows > 0 ){
        while ($row = $result->fetch_assoc()){
            $id = $row["exerciseid"];
        }
    }

    $sql = /** @lang text */
        "INSERT INTO results(exerciseid_fk,sessionid_fk)
         VALUES ('$id','$sessionid_fk')";

    if($conn->query($sql) == TRUE) {
        $maks = 0;
        $sql2 = /** @lang text */
            "Select max(resultid) as maks from results";

        $result2 = $conn->query($sql2);
        if($result2->num_rows > 0 ){
            while ($row2 = $result2->fetch_assoc()){
                $maks = $row2["maks"];
            }
        }
        echo $maks;
    }
    else{
        header('HTTP/1.0 404 not found');
    }
}

