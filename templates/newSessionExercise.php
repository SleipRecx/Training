<?php
session_start();
include_once("connection.php");
include ("login_required.php");

if(!empty($_POST["exerciseid"])){
    $exerciseid_fk =  $_POST["exerciseid"];
    $sessionid_fk =  $_POST["sessionid"];

    $sql = /** @lang text */
        "INSERT INTO results(exerciseid_fk,sessionid_fk)
         VALUES ('$exerciseid_fk','$sessionid_fk')";

    if($conn->query($sql) == TRUE) {
        echo "Entered data successfully\n";
        header('Location: session.php');
    }
    else{
        die('Could not enter data: ' . $conn->error);
    }
}

