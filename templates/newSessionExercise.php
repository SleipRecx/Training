<?php
session_start();
include_once("connection.php");
if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}
if(!empty($_POST["date"])){

    $date = $_POST["date"];
    $place = $_POST["place"];
    $personid_fk = $_SESSION["personid"];

    $sql = /** @lang text */
        "INSERT INTO sessions(date,place,personid_fk)
     VALUES ('$date','$place','$personid_fk')";

    $retval = mysql_query($sql);

    if(! $retval) {
        die('Could not enter data: ' . mysql_error());
    }
}

header('Location: session.php');

