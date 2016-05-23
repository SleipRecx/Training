<?php
session_start();
include_once("db_connection.php");
include_once ("login_required.php");

if(!empty($_POST["resultid"])) {
    $reps = $_POST["reps"];
    $kg = $_POST["kg"];
    $resultid_fk = $_POST["resultid"];
    $sql = /** @lang text */
        "INSERT INTO execution(resultid_fk,reps,kg)
        VALUES ($resultid_fk,$reps,$kg)";
    
    if($conn->query($sql) == TRUE){

    }
    else{
        header('HTTP/1.0 404 not found');
    }


}




