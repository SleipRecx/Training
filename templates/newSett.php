<?php
session_start();
include_once("connection.php");
include_once ("login_required.php");


if(!empty($_POST["resultid"])) {
    $reps = $_POST["reps"];
    $kg = $_POST["kg"];
    $resultid_fk = $_POST["resultid"];
    $sql = /** @lang text */
        "INSERT INTO execution(resultid_fk,reps,kg)
        VALUES ($resultid_fk,$reps,$kg)";
    $retval = mysql_query($sql);
    echo $retval;

    if(! $retval) {
        die('Could not enter data: ' . mysql_error());
    }

}
header('Location: session.php');



