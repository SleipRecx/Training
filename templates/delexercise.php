<?php
session_start();
include_once("connection.php");
$deleteID = $_POST["exerciseid"];

$sql= /** @lang MYSQL */
    "select personid_fk,exerciseid
    from exercise
    where exerciseid = '$deleteID'";

$retval = mysql_query($sql);
$values = mysql_fetch_array($retval);
$personid_fk = $values["personid_fk"];

if($personid_fk != $_SESSION["personid"]){
    echo "<h2>You trying to hack my shit??</h2>";
    header("refresh:5;url=http://www.theworldsworstwebsiteever.com/" );

}
else{
    $sql = /** @lang MYSQL */
        "DELETE FROM exercise
    WHERE exerciseid = '$deleteID'";

    $retval = mysql_query($sql);
    echo $retval;
    if(! $retval) {
        echo "<h2 style='text-align: center'>The exercise you are trying to delete is in use</h2>";
        header("refresh:2;url=exercise.php" );
    }
    else{
        echo "Entered data successfully\n";
        header("Location: exercise.php");
    }

}
