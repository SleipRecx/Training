<?php
session_start();
include_once("connection.php");
if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}
if(!empty($_POST["exerciseid"])){
    $name =  $_POST["exerciseid"];
    $id =  $_POST["sessionid"];
    echo name;
}



