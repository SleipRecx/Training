<?php
session_start();
include_once("connection.php");
$deleteID = $_POST["exerciseid"];
$sql = /** @lang MYSQL */
    "DELETE FROM exercise
    WHERE exerciseid = '$deleteID'";

$retval = mysql_query($sql);
echo $retval;
if(! $retval) {
    die('Could not enter data: ' . mysql_error());
}
else{
    echo "Entered data successfully\n";
    header("Location: exercise.php");
}
