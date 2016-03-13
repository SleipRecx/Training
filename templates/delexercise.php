<?php
session_start();
include_once("connection.php");
include_once("login_required.php");

$deleteID = $_POST["removeid"];

$sql= /** @lang MYSQL */
    "select personid_fk,exerciseid
    from exercise
    where exerciseid = '$deleteID'";


$result = $conn->query($sql);

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $personid_fk = $row["personid_fk"];
        if($personid_fk != $_SESSION["personid"]){
            echo "<h2>You trying to hack my shit??</h2>";
            header("refresh:5;url=http://www.theworldsworstwebsiteever.com/" );

        }
        else{
            $sql = /** @lang MYSQL */
                "DELETE FROM exercise
                WHERE exerciseid = '$deleteID'";


            if($conn->query($sql) == TRUE){
                echo $_POST["removeid"];

            }
            else{
                echo "<h2 style='text-align: center'>The exercise you are trying to delete is in use</h2>";
                header("refresh:2;url=exercise.php" );
            }

        }
    }
}

