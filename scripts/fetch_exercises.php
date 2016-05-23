<?php
session_start();
include_once("db_connection.php");
include_once("login_required.php");

$sql = /** @lang MYSQL */
    "SELECT personid,firstname,lastname,
    exercise_name,muscle_group,
    date_added,exerciseid
    FROM exercise
    JOIN persons on personid=personid_fk";


$output = array("data" => array() );
$result = $conn->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        $output['data'][] = $row;

    }

    echo json_encode($output);
    $result->close();
    $conn->close();
}