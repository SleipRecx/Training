<?php
session_start();
include_once("connection.php");
include_once("login_required.php");

if(!empty($_POST["date"])){

    $date = $_POST["date"];
    $timestamp = strtotime($date);
    $date = date('Y-m-d', $timestamp);
    $place = $_POST["place"];
    $personid_fk = $_SESSION["personid"];

    $sql = /** @lang text */
        "INSERT INTO sessions(date,place,personid_fk)
     VALUES ('$date','$place','$personid_fk')";


    if($conn->query($sql) == FALSE){
        die('Could not enter data: ' . $conn->error);
    }
    else{
        header('Location: session.php');
    }

}




