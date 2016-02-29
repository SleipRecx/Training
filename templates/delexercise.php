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
        die('Could not enter data: ' . mysql_error());
    }
    else{
        echo "Entered data successfully\n";
        header("Location: exercise.php");
    }

}
