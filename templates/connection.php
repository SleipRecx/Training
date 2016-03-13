<?php
$dbhost = 'mysql.stud.ntnu.no';
$dbuser = 'markua_test';
$dbpass = '123456';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if($conn->connect_error)
{
    die('Could not connect: ' . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
mysqli_select_db($conn,"markua_trening");

