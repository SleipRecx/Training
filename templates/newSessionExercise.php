<?php
session_start();
include_once("connection.php");
include_once ("login_required.php");
if(!empty($_POST["exerciseid"])){
    $exerciseid_fk =  $_POST["exerciseid"];
    $sessionid_fk =  $_POST["sessionid"];

    $sql = /** @lang text */
        "INSERT INTO results(exerciseid_fk,sessionid_fk)
         VALUES ($exerciseid_fk,$sessionid_fk)";

    $retval = mysql_query($sql);

    if(! $retval) {
        die('Could not enter data: ' . mysql_error());
    }
}
header('Location: session.php');


