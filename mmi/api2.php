<?php
include("db_connect.php");
if($_GET["delete"]){
    $name = $_GET["delete"];
    $sql = "delete from events where name = '$name' ";
    $result = $conn->query($sql);

    echo (json_encode($result));
}

if($_GET["name"]){
    $name = $_GET["name"];
    $sql = "insert into events(name) VALUES ('$name')";
    $result = $conn->query($sql);

    echo (json_encode($result));
}
else{
    $sql = "Select name from events";
    $result = $conn->query($sql);
    $output = array("data" => array() );
    while ($row = $result->fetch_assoc()) {
        $output['data'][] = $row;
    }
    echo json_encode($output);
}