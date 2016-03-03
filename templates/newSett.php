<?php
session_start();
include_once("connection.php");
if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}

$reps = $_POST["reps"];
$kg = $_POST["kg"];
$belt = $_POST["belt"];
$sessID = $_POST["sessID"];
$exerciseid_fk = $_POST["exerciseid"];
if(!empty($_POST["sessID"])) {

    $sql = /** @lang text */
        "INSERT INTO execution(sessionid_fk,exerciseid_fk,reps,kg,belt)
     VALUES ('$sessID','$exerciseid_fk','$reps','$kg','$belt')";
    $retval = mysql_query($sql);

    if(! $retval) {
        die('Could not enter data: ' . mysql_error());
    }

}

header('Location: session.php#anchor'.$sessID);

