<?php
//Database connection
$dbhost = 'mysql.stud.ntnu.no';
$dbuser = 'markua_test';
$dbpass = '123456';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(!$conn )
{
    die('Could not connect: ' . mysqli_error());
}
//Databse selection
mysqli_select_db("markua_trening",$conn);

